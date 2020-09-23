<?php

namespace App\Http\Controllers;

use App\Jobs\AcceptDocumentNotification;
use App\Models\Document;
use App\Models\Profile;
use App\Models\ProgramSubject;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $data['onlineTutors'] = User::has('profile')->where('role_id', 2)->where('is_online', 1)->count();
        $data['offlineTutors'] = User::has('profile')->where('role_id', 2)->where('is_online', 0)->count();

        $data['activeStudents'] = User::has('profile')->where('role_id', 3)->where('is_active', 1)->count();
        $data['inactiveStudents'] = User::has('profile')->where('role_id', 3)->where('is_active', 0)->count();

        $data['tutors'] = User::has('profile')->where('role_id', 2)->count();
        $data['students'] = User::has('profile')->where('role_id', 3)->count();

        $data['commercial_tutors'] = User::whereHas('profile', function ($q){
            return $q->where('is_mentor', 0);
        })->where('role_id', 2)->count();

        $data['mentor_tutors'] = User::whereHas('profile', function ($q){
            return $q->where('is_mentor', 1);
        })->where('role_id', 2)->count();

        $data['deserving_students'] = User::whereHas('profile', function ($q){
            return $q->where('is_deserving', 1);
        })->where('role_id', 3)->count();

        $data['non_deserving_students'] = User::whereHas('profile', function ($q){
            return $q->where('is_deserving', 0);
        })->where('role_id', 3)->count();

        foreach (['booked','started','ended','reject','pending','expired'] as $status)
            $data['sessions'.ucwords($status)] = Session::where('status', $status)->count();

        return view('admin.dashboard', compact('data'));
    }
    public function studentsList(){
        $students = User::where('role_id',3)->with('profile')->orderby('id','DESC')->get();
        return view('admin.student.studentsList',compact('students'));
    }
    public function deservingStudentsList(){
        $students = User::whereHas('profile', function ($query) {
            $query->where('is_deserving', 1);
        })->where('role_id', 3)->orderby('id','DESC')->get();
        return view('admin.student.studentsList',compact('students'));
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
                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q){
                    $q->where('is_mentor', 0);
                })->with('rating')->where('role_id',2)->where('is_approved',1)->orderBy('id', 'DESC');

            return datatables()->eloquent($tutors)
                ->orderColumn('firstName', function ($query, $order) {
                    $query->orderBy('status', $order);
                })
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
                ->make(true);
        }
        $mentorOrCommercial = 'Commercial';
        return view('admin.candidates',compact('mentorOrCommercial'));
//        $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'created_at')->with(['profile'=>function($q){
//            $q->select("is_mentor", "user_id");
//        }])->where('role_id', 2)->where('is_approved',0)->get();
//        return view('admin.candidates', compact('tutors'));
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
