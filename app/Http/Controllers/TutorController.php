<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Program;
use App\Models\ProgramSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

use App\Traits\TutorFilterTrait;
use App\Traits\LocationTrait;
use Illuminate\Support\Facades\Input;

class TutorController extends Controller
{
    use TutorFilterTrait;
    use LocationTrait;
    public function tutorAdd(){
        $classes = Program::where('status',1)->get();
        return view('admin.tutor.tutorAdd',compact('classes'));
    }
    public function getSubjects($class_id){
        $subjects = Subject::where('programme_id',$class_id)->get();
        return response()->json([
            'subjects' => $subjects,
        ]);
    }

    public function tutorSave(Request $request){
//        dd($request->all());
        request()->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'fatherName' => 'required|min:2|max:50',
            'phone' => 'required|min:10|numeric|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'dob' => 'required',
            'gender_id' => 'required',
            'qualification' => 'required',
            'cnic_no' => 'required',
            'subject_id' => 'required',
        ], [
            'firstName.required' => 'Name is required',
            'firstName.min' => 'Name must be at least 2 characters.',
            'firstName.max' => 'Name should not be greater than 50 characters.',
            'lastName.required' => 'Name is required',
            'lastName.min' => 'Name must be at least 2 characters.',
            'fatherName.required' => 'Name is required',
            'fatherName.min' => 'Name must be at least 2 characters.',
            'fatherName.max' => 'Name should not be greater than 50 characters.',
            'dob.required' => 'Date of birth is required.',
            'phone.required' => 'Phone number is required.',
            'gender_id.required' => 'Select gender',
            'qualification.required' => 'Qualification is required',
            'cnic_no.required' => 'Enter CNIC number',
            'subject_id.required' => 'Select subject',
        ]);

        $input = request()->except('password','confirm_password');
        $user=new User($input);
        $user->password=bcrypt(request()->password);
        $user->uid = str_random(32);
        $user->is_active = 1;
        $user->role_id = 2;
        $user->save();

        //Create profile table entry
        $profile = Profile::create(
                        [
                            'is_mentor'=>0,
                            'is_deserving' => 0,
                            'one_on_one' => 0,
                            'call_tutor' => 0,
                            'call_student' => 0,
                            'is_home' => 0,
                            'is_group' => 0,
                            'subject_id' => 0,
                            'programme_id' => 0,
                            'meeting_type_id' => 0,
                            'user_id' => $user->id
                        ]);

        $subjects = $request->subject_id;
        foreach ($subjects as $subject) {
            $sub = Subject::where('id',$subject)->first();
            $prosub = new ProgramSubject();
            $prosub->user_id =    $user->id;
            $prosub->program_id = $sub->programme_id;
            $prosub->document_id = 0;
            $prosub->subject_id = $subject;
            $prosub->save();
        }
        return redirect()->route('tutorsList')->with('success','Tutor added Successfully');
    }

    public function changeTutorStatus(Request $request){
        request()->validate([
            'tutor_id' => 'required',
            'is_active' => 'required'
        ]);
        $tutor_id = $request->tutor_id;
        $is_active = $request->is_active;

        $tutor = User::where('id',$tutor_id)->first();
        if ($is_active == 'true'){
            $tutor->is_active = 1;
            $tutor->save();
        }else
        {
            $tutor->is_active = 0;
            $tutor->save();
        }
    }

    public function changeTutorApprovedStatus(Request $request){
        request()->validate([
            'tutor_id' => 'required',
            'is_approved' => 'required'
        ]);
        $tutor_id = $request->tutor_id;
        $is_approved = $request->is_approved;

        $tutor = User::where('id',$tutor_id)->first();
        if ($is_approved == 'true'){
            $tutor->is_approved = 1;
            $tutor->save();
        }else
        {
            $tutor->is_approved = 0;
            $tutor->save();
        }
    }

    public function tutorsList(Request $request){
        $mentorOrCommercial = 'Commercial';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $tutors = $this->tutorFilter($request,$mentorOrCommercial)->where('is_approved',1);
            }
            else
            {
                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q){
                    $q->where('is_mentor', 0);
                })->with('rating')->where('role_id',2)->where('is_approved',1)->orderBy('id', 'DESC');
            }
            return datatables()->eloquent($tutors)
                ->addColumn('rating', function($tutor){
                    return round($tutor->rating->avg('rating'),1);
                })
                ->addColumn('created_at', function($tutor){
                    return dateTimeConverter($tutor->created_at);
                })
                ->addColumn('last_login', function($tutor){
                    return $tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login);
                })
                ->addColumn('is_active', function($tutor){
                    $is_checked = $tutor->is_active == 1 ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-tutor-id="'.$tutor->id.'" data-url="'.url('/').'" class="js-switch" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
//                ->addColumn('is_approve', function($tutor){
//                    $is_checked = $tutor->is_approved == 1 ? 'checked' : '';
//                    $is_approve = '<input type="checkbox" data-tutor-id="'.$tutor->id.'" data-url="'.url('/').'" class="is_approved_by_admin" data-color="#99d683"'.$is_checked.'>';
//                    return $is_approve;
//                })
                ->addColumn('edit', function($tutor){
                    $btn = '<a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="'.route('tutorProfile',$tutor->id).'" alt="default">View</a>';
                    return $btn;
                })
                ->addColumn('delete', function($tutor){
                    $delete_btn = '<a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" data-id="'.$tutor->id.'">Delete</a>';
                    return $delete_btn;
                })
                ->rawColumns(['rating','created_at','last_login','is_active','edit','delete'])
                ->orderColumn('firstName', 'email $1')
                ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        $mentorOrCommercial = 'Commercial';
        return view('admin.tutor.tutorsList',compact('mentorOrCommercial','countries', 'programs'));
    }
    public function tutorsArchiveList(){
        $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q){
            $q->where('is_mentor', 0);
        })->with('rating')->onlyTrashed()->orderBy('id', 'DESC')->get();
        $mentorOrCommercial = 'Commercial';
        return view('admin.tutor.tutorsArchiveList',compact('tutors', 'mentorOrCommercial'));
    }
    public function mentorsList(Request $request){
        $mentorOrCommercial = 'Mentor';

        if($request->ajax())
        {

            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $tutors = $this->tutorFilter($request,$mentorOrCommercial);
            }
            else
            {
                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q){
                    $q->where('is_mentor', 1);
                })->with('rating')->where('role_id',2)->where('is_approved',1)->orderBy('id', 'DESC');
            }
            return datatables()->eloquent($tutors)
                ->orderColumn('firstName', function ($query, $order) {
                    $query->orderBy('status', $order);
                })
                ->addColumn('rating', function($tutor){
                    return round($tutor->rating->avg('rating'),1);
                })
                ->addColumn('created_at', function($tutor){
                    return dateTimeConverter($tutor->created_at);
                })
                ->addColumn('last_login', function($tutor){
                    return $tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login);
                })
                ->addColumn('is_active', function($tutor){
                    $is_checked = $tutor->is_active == 1 ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-tutor-id="'.$tutor->id.'" data-url="'.url('/').'" class="js-switch" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
//                ->addColumn('is_approve', function($tutor){
//                    $is_checked = $tutor->is_approved == 1 ? 'checked' : '';
//                    $is_approve = '<input type="checkbox" data-tutor-id="'.$tutor->id.'" data-url="'.url('/').'" class="is_approved_by_admin" data-color="#99d683"'.$is_checked.'>';
//                    return $is_approve;
//                })
                ->addColumn('edit', function($tutor){
                    $btn = '<a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="'.route('tutorProfile',$tutor->id).'" alt="default">View</a>';
                    return $btn;
                })
                ->addColumn('delete', function($tutor){
                    $delete_btn = '<a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" data-id="'.$tutor->id.'">Delete</a>';
                    return $delete_btn;
                })
                ->rawColumns(['rating','created_at','last_login','is_active','edit','delete'])
                ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();

        return view('admin.tutor.tutorsList',compact('mentorOrCommercial','countries', 'programs'));
//        $tutors = User::whereHas('profile', function ($q){
//            $q->where('is_mentor', 1);
//        })->where('role_id',2)->orderBy('id', 'DESC')->get();
//        $mentorOrCommercial = 'Mentor';
//        return view('admin.tutor.tutorsList',compact('tutors', 'mentorOrCommercial'));
    }
    public function tutorProfile(User $user){
        $programs_subjects = ProgramSubject::where('user_id',$user->id)->with('program', 'subject')->get();
        $programs = Program::where('status',1)->get();
        return view('admin.tutor.tutorProfile',compact('user','programs_subjects','programs'));
    }
    public function tutorSubjectsUpdate(Request $request)
    {
       $user_id = $request->user_id;
       ProgramSubject::where('user_id',$user_id)->delete();
       $subjects = $request->subject_id;
        if($subjects != null){
           foreach ($subjects as $subject){
                $prosub = new ProgramSubject();
                $sub = Subject::where('id',$subject)->first();
                $prosub->program_id  = $sub->programme_id;
                $prosub->subject_id  = $subject;
                $prosub->user_id  = $user_id;
                $prosub->save();
           }
        }
        return redirect()->route('tutorProfile',$user_id)->with('success','Tutor subjects updated Successfully');
    }
    public function tutorsEdit(User $user){
        return view('admin.tutor.profileEdit',compact('user'));
    }
    public function tutorUpdate(Request $request,User $user){
        $request->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'fatherName' => 'required|min:2|max:50',
//            'email' =>  [
//                'required',
//                'min:2',
//                'regex:',
//                Rule::unique('users')->ignore($user->id),
//            ],
//            'phone' =>  [
//                'required',
//                Rule::unique('users')->ignore($user->id),
//            ],
            'password' => 'min:6|max:20|nullable',
            'confirm_password' => 'min:6|max:20|same:password|nullable',
            'dob' => 'required',
            'gender_id' => 'required',
            'experience' => 'required',
            'qualification' => 'required',
            'cnic_no' => 'required',
        ], [
            'firstName.required' => 'Name is required',
            'firstName.min' => 'Name must be at least 2 characters.',
            'firstName.max' => 'Name should not be greater than 50 characters.',
            'lastName.required' => 'Name is required',
            'lastName.min' => 'Name must be at least 2 characters.',
            'fatherName.required' => 'Name is required',
            'fatherName.min' => 'Name must be at least 2 characters.',
            'fatherName.max' => 'Name should not be greater than 50 characters.',
            'dob.required' => 'Date of birth is required.',
//            'phone.required' => 'Phone number is required.',
            'gender_id.required' => 'Select gender',
            'experience.required' => 'Select experience',
            'qualification.required' => 'Qualification is required',
            'cnic_no.required' => 'Enter CNIC number',
        ]);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->fatherName = $request->fatherName;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->gender_id = $request->gender_id;
        $user->experience = $request->experience;
        $user->qualification = $request->qualification;
        $user->cnic_no = $request->cnic_no;
        $user->email = $request->email;

        if ($request->password){
            $user->password = bcrypt($request->password);
            $user->save();
        }
//        else{
//            $user->password = $user->password;
//            $user->save();
//        }
        $user->save();
//        dd('saved');
        return redirect()->route('tutorsList')->with('success','Tutor updated Successfully');
    }

    public function tutorDelete($tutor){
        User::where('id', $tutor)->delete();
        return redirect()->route('tutorsList')->with('success','Tutor Deleted successfully');
    }
    public function tutorRestore($tutor){
        /*dd($tutor);*/
        User::withTrashed()->find($tutor)->restore();
        return redirect()->route('tutorsArchiveList')->with('success','Tutor Restored successfully');
    }
    public function profileUpdate(Request $request){

        $userProfile = Profile::where('user_id', $request->user_id)->first();

        if($request->group_tutor_or_one_on_one == 'group_tutor'){
            $userProfile->is_group = 1;
            $userProfile->one_on_one = 0;
        }

        if($request->group_tutor_or_one_on_one == 'one_on_one'){
            $userProfile->is_group = 0;
            $userProfile->one_on_one = 1;
        }

        if($request->group_tutor_or_one_on_one == 'no_pref'){
            $userProfile->is_group = 1;
            $userProfile->one_on_one = 1;
        }


        if($request->call_student_or_go_home == 'call_student'){
            $userProfile->call_student = 1;
            $userProfile->is_home = 0;
        }

        if($request->call_student_or_go_home == 'go_home'){
            $userProfile->call_student = 0;
            $userProfile->is_home = 1;
        }

        if($request->call_student_or_go_home == 'no_pref'){
            $userProfile->call_student = 1;
            $userProfile->is_home = 1;
        }

        if($request->who_would_you_like_to_teach == 'male'){
            $userProfile->teach_to = 1;
        }
        if($request->who_would_you_like_to_teach == 'female'){
            $userProfile->teach_to = 2;
        }
        if($request->who_would_you_like_to_teach == 'no_preference'){
            $userProfile->teach_to = 0;
        }


        if($request->commercial_or_mentor == 'commercial'){
            $userProfile->is_mentor = 0;
        }
        if($request->commercial_or_mentor == 'mentor'){
            $userProfile->is_mentor = 1;
        }

        $userProfile->save();


        return redirect()->back()->with('success', 'Updated Successfully!');
    }


    public function getCoordinatesOfTutors(){
        $tutors = User::select('latitude as lat', 'longitude as lng', 'firstName', 'lastName', 'phone')
            ->where('role_id', 2)
            ->where('is_online', 1)
            ->where('latitude', '!=', null)
            ->where('longitude', '!=', null)
            ->get();
        return view('admin.tutor.map', compact('tutors'));
    }
    public function fetchProvince(Request $request)
    {
        $provicesHtml = $this->getProviceByCountry($request);
        return $provicesHtml;
    }
    public function fetchCity(Request $request)
    {
        $citesHtml = $this->getCityByProvince($request);
        return $citesHtml;
    }
    public function fetchArea(Request $request)
    {
        $areaHtml = $this->getAreaByCity($request);
        return $areaHtml;
    }
    public function fetchSubjects(Request $request)
    {
        $where_array = explode(',', $request->input('class'));
        $html = '<option value="all">Select Subjects</option>';
        $subjects = Subject::where('status', '!=', '2')->whereIn('programme_id', $where_array)->get();
        foreach ($subjects as $subject)
        {
            $html.= '<option value="'.$subject->id.'">'.$subject->name.'</option>';
        }
        return $html;
    }

}
