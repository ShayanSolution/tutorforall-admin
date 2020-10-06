<?php

namespace App\Http\Controllers;

use App\Jobs\AcceptDocumentNotification;
use App\Models\Document;
use App\Models\Profile;
use App\Models\Program;
use App\Models\ProgramSubject;
use App\Models\Session;
use App\Models\User;
use App\Traits\LocationTrait;
use App\Traits\SessionFilterTrait;
use App\Traits\StudentFilterTrait;
use App\Traits\TutorFilterTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use StudentFilterTrait;
    use TutorFilterTrait;
    use LocationTrait;
    use SessionFilterTrait;

    public function dashboard(Request $request){
        $selectedfilter="";
        if($request->ajax())
        {
            if( $request->input('selectedFilter') != '' && $request->has('selectedFilter')) {
                $selectedfilter=$request->input('selectedFilter');
            }
            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
                $data=$this->setData();
                if($selectedfilter=="tutor"){
                    $data['onlineTutors'] = $this->tutorFilter($request,"reports")->where('is_approved',1)->has('profile')->where('role_id', 2)->where('is_online', 1)->count();
                    $data['offlineTutors'] = $this->tutorFilter($request,"reports")->where('is_approved',1)->has('profile')->where('role_id', 2)->where(function($q) {
                        $q->where('is_online', '=', 0)
                            ->orWhere('is_online', null);
                    })->count();
                    $data['commercial_tutors'] =$this->tutorFilter($request,"commercial")->where('is_approved',1)->whereHas('profile', function ($q){
                        return $q->where('is_mentor', 0);
                    })->where('role_id', 2)->count();
                    $data['mentor_tutors'] = $this->tutorFilter($request,"Mentor")->where('is_approved',1)->whereHas('profile', function ($q){
                        return $q->where('is_mentor', 1);
                    })->where('role_id', 2)->count();
                }
                else if($selectedfilter=="student"){

                    $data['activeStudents'] =  $this->studentFilter($request)->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                        ->leftJoin('profiles as profile', 'users.id','=','profile.user_id')->has('profile')->where('role_id', 3)->where('is_active', 1)->count();
                    $data['inactiveStudents'] = $this->studentFilter($request)->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                        ->leftJoin('profiles as profile', 'users.id','=','profile.user_id')->has('profile')->where('role_id', 3)->where('is_active', 0)->count();
                    $data['deserving_students'] = $this->studentFilter($request)->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                        ->leftJoin('profiles as profile', 'users.id','=','profile.user_id')->whereHas('profile', function ($q){
                        return $q->where('is_deserving', 1);
                    })->count();

                    $data['non_deserving_students'] = $this->studentFilter($request)->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                        ->leftJoin('profiles as profile', 'users.id','=','profile.user_id')->whereHas('profile', function ($q){
                        return $q->where('is_deserving', 0);
                    })->where('role_id', 3)->count();
                }
                else{
                    foreach (['booked','started','ended','reject','pending','expired'] as $status)
                        $data['sessions'.ucwords($status)] = $this->sessionFilter($request,"all")->select('sessions.*', 'student.firstName as studentName', 'tutor.firstName as tutorName', 'class.name as className', 'subject.name as subjectName')
                            ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                            ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                            ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                            ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id')->where('sessions.status', $status)->count();

                }
                return response()->json($data, 200);
            }
        }
        else{
            $data=$this->setData();
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();


        return view('admin.dashboard', compact('data','countries','programs'));
    }
    private function setData(){
        $data['onlineTutors'] = User::has('profile')->where('role_id', 2)->where('is_online', 1)->where('is_approved',1)->count();
        $data['offlineTutors'] = User::has('profile')->where('role_id', 2)->where('is_approved',1)->where(function($q) {
            $q->where('is_online', '=', 0)
                ->orWhere('is_online', null);
        })->count();

        $data['activeStudents'] = User::has('profile')->where('role_id', 3)->where('is_active', 1)->count();
        $data['inactiveStudents'] = User::has('profile')->where('role_id', 3)->where('is_active', 0)->count();

        $data['tutors'] = User::has('profile')->where('role_id', 2)->where('is_approved',1)->count();
        $data['students'] = User::has('profile')->where('role_id', 3)->count();

        $data['commercial_tutors'] = User::whereHas('profile', function ($q){
            return $q->where('is_mentor', 0);
        })->where('role_id', 2)->where('is_approved',1)->count();

        $data['mentor_tutors'] = User::whereHas('profile', function ($q){
            return $q->where('is_mentor', 1);
        })->where('role_id', 2)->where('is_approved',1)->count();

        $data['deserving_students'] = User::whereHas('profile', function ($q){
            return $q->where('is_deserving', 1);
        })->where('role_id', 3)->count();

        $data['non_deserving_students'] = User::whereHas('profile', function ($q){
            return $q->where('is_deserving', 0);
        })->where('role_id', 3)->count();

        foreach (['booked','started','ended','reject','pending','expired'] as $status)
            $data['sessions'.ucwords($status)] = Session::where('status', $status)->count();
return $data;
    }
    public function studentsList(Request $request){
        $listType = 'studentsList';
        if($request->ajax())
        {
            $students = User::where('role_id',3)->with('profile');
            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
                $students = $this->studentFilter($request)->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            else{
//                $students = User::where('role_id',3)->with('profile');
                $students = User::where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            return datatables()->eloquent($students)
            ->addColumn('firstName', function($student){
                return $student->firstName ? $student->firstName : 'N-A';
            })
            ->addColumn('lastName', function($student){
                return $student->lastName ? $student->lastName : 'N-A';
            })
            ->addColumn('created_at', function($student){
                return dateTimeConverter($student->created_at);
            })
            ->addColumn('is_active', function($student){
                $is_checked = $student->is_active == 1 ? 'checked' : '';
                $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch-is_active" data-color="#99d683"'. $is_checked .'>';
                return $is_active;
            })
            ->addColumn('is_deserving', function($student){
                $is_checked = $student->profile->is_deserving ? 'checked' : '';
                $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch" data-color="#99d683"'. $is_checked .'>';
                return $is_active;
            })
            ->addColumn('delete', function($student){
                $delete_btn = '<a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" data-id="'.$student->id.'">Delete</a>';
                return $delete_btn;
            })
            ->rawColumns(['firstName','lastName','created_at','is_active','is_deserving','delete'])
            ->orderColumn('created_at', 'created_at $1')
            ->orderColumn('firstName', 'firstName $1')
            ->orderColumn('lastName', 'lastName $1')
            ->orderColumn('is_active', 'is_active $1')
            ->orderColumn('is_deserving', 'isdeserving $1')
            ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.student.studentsList',compact('countries', 'programs','listType'));
    }
    public function deservingStudentsList(Request $request){
        $listType = 'deservingStudentsList';
        if($request->ajax())
        {
            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
                $students = $this->studentFilter($request)->where('role_id',3)->whereHas('profile', function ($query) {
                    $query->where('is_deserving', 1);
                })->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            else{
                $students = User::whereHas('profile', function ($query) {
                    $query->where('is_deserving', 1);
                })->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            return datatables()->eloquent($students)
                ->addColumn('firstName', function($student){
                    return $student->firstName ? $student->firstName : 'N-A';
                })
                ->addColumn('lastName', function($student){
                    return $student->lastName ? $student->lastName : 'N-A';
                })
                ->addColumn('created_at', function($student){
                    return dateTimeConverter($student->created_at);
                })
                ->addColumn('is_active', function($student){
                    $is_checked = $student->is_active == 1 ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch-is_active" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
                ->addColumn('is_deserving', function($student){
                    $is_checked = $student->profile->is_deserving ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
                ->addColumn('delete', function($student){
                    $delete_btn = '<a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" data-id="'.$student->id.'">Delete</a>';
                    return $delete_btn;
                })
                ->rawColumns(['firstName','lastName','created_at','is_active','is_deserving','delete'])
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('firstName', 'firstName $1')
                ->orderColumn('lastName', 'lastName $1')
                ->orderColumn('is_active', 'is_active $1')
                ->orderColumn('is_deserving', 'isdeserving $1')
                ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.student.studentsList',compact('countries','programs','listType'));
    }
    public function changeStudentDeserving(Request $request){
        $student_id = $request->student_id;
        $is_deserving = $request->is_deserving;
        $profile = Profile::where('user_id', $student_id)->first();
        if ($is_deserving == 'true'){
            $profile->is_deserving = 1;
            $profile->save();
        }else{
            $profile->is_deserving = 0;
            $profile->save();
        }
    }
    public function changeStudentStatus(Request $request){
        $student_id = $request->student_id;
        $is_active = $request->is_active;
        $user = User::where('id', $student_id)->first();
        if ($is_active == 'true'){
            $user->is_active = 1;
            $user->save();
        }else{
            $user->is_active = 0;
            $user->save();
        }
    }
    public function updatePasswordPage(){
        return view('admin.updatePasswordPage');
    }

    public function studentDelete($student){
        $student = User::find($student);

        $deleted = false;

        if($student)
            $deleted = $student->forceDelete();

        if(!$deleted)
            return redirect()->route('studentsList')->with('error','Oops! Something went wrong.');

        return redirect()->route('studentsList')->with('success','Student Deleted successfully');

    }

    public function candidates(Request $request){


        if($request->ajax())
        {
//                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->with('profile')->with('rating')->where('role_id',2)->where('is_approved',0);
            $tutors = User::where('role_id',2)->where('is_approved',0)->select('users.*', 'profile.is_mentor as ismentor')
                ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            return datatables()->eloquent($tutors)
                ->addColumn('type', function($tutor){
                    return $tutor->profile->is_mentor ? 'Mentor' : 'Commercial';
                })
                ->addColumn('created_at', function($tutor){
                    return dateTimeConverter($tutor->created_at);
                })
                ->addColumn('documents', function($tutor){
                    $btn = '<a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="'.route('candidateDocuments', $tutor->id).'" alt="default">Review Documents</a>';
                    return $btn;
                })
                ->rawColumns(['type','created_at','documents'])
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('type', 'ismentor $1')
                ->make(true);
        }
        $mentorOrCommercial = 'Commercial';
        return view('admin.candidates',compact('mentorOrCommercial'));
    }

    public function candidateDocuments($id){

        $tutorDocuments = ProgramSubject::where('user_id', $id)->with('user', 'program', 'subject', 'document')->get();
//dd($tutorDocuments->toArray());
        return view('admin.documents', compact('tutorDocuments'));
    }



    public function acceptDocument($id){

        $document = ProgramSubject::where('id', $id)->with('program', 'subject')->first();

        if(!$document)
            return redirect()->back()->with('error', 'Document does not exists.');

        $updated = $document->update([
            'rejection_reason'  =>  '',
            'status'            =>  ProgramSubject::STATUS_ACCEPTED,
            'verified_by'       =>  Auth::user()->id,
            'verified_at'       =>  now()
        ]);
        //When doc accepted than approved Tutor
        User::where('id', $document->user_id)->update([
            'is_approved' => 1
        ]);

        if ($document->program->name && $document->subject->name) {
            $user = $document->user_id;
            $program = $document->program->name;
            $subject = $document->subject->name;
            $type = 'accepted';
            // send push notification of approval document
            $job = new AcceptDocumentNotification($user, $program, $subject, $type);
            $this->dispatch($job);
        }

        if(!$updated)
            return redirect()->back()->with('error','Oops! Something went wrong.');

        return redirect()->back()->with('success','Document accepted successfully.');
    }

    public function rejectDocument(Request $request){
        $document = ProgramSubject::where('id', $request->prog_sub_id)->with('program', 'subject')->first();

        if(!$document)
            return redirect()->back()->with('error', 'Document does not exists.');

        $updated = $document->update([
            'rejection_reason'  =>  $request->rejection_reason,
            'status'            =>  ProgramSubject::STATUS_REJECTED,
            'verified_by'       =>  Auth::user()->id,
            'verified_at'       =>  now()
        ]);

        if ($document->program->name && $document->subject->name) {
            $user = $document->user_id;
            $program = $document->program->name;
            $subject = $document->subject->name;
            $type = 'rejected';
            // send push notification of reject document
            $job = new AcceptDocumentNotification($user, $program, $subject, $type);
            $this->dispatch($job);
        }

        if(!$updated)
            return redirect()->back()->with('error','Oops! Something went wrong.');

        return redirect()->back()->with('success','Document rejected successfully.');
    }
}
