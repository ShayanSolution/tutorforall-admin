<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class TutorController extends Controller
{
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
            'experience' => 'required',
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
            'experience.required' => 'Select experience',
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

        $subjects = $request->subject_id;
        foreach ($subjects as $subject) {
            $sub = Subject::where('id',$subject)->first();
            $prosub = new ProgramSubject();
            $prosub->user_id =    $user->id;
            $prosub->program_id = $sub->programme_id;
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
    public function tutorsList(){
        $tutors = User::where('role_id',2)->orderBy('id', 'DESC')->get();
        return view('admin.tutor.tutorsList',compact('tutors'));
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
       foreach ($subjects as $subject){
            $prosub = new ProgramSubject();
            $sub = Subject::where('id',$subject)->first();
            $prosub->program_id  = $sub->programme_id;
            $prosub->subject_id  = $subject;
            $prosub->user_id  = $user_id;
            $prosub->save();
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
}
