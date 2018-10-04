<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TutorController extends Controller
{
    public function tutorAdd(){
        return view('admin.tutor.tutorAdd');
    }

    public function tutorSave(Request $request){
//        dd($request->all());
        request()->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'phone' => 'required|min:10|numeric|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20',
            'confirm_password' => 'required|min:6|max:20|same:password',
            'dob' => 'required',
            'gender_id' => 'required',
        ], [
            'firstName.required' => 'Name is required',
            'firstName.min' => 'Name must be at least 2 characters.',
            'firstName.max' => 'Name should not be greater than 50 characters.',
            'lastName.required' => 'Name is required',
            'lastName.min' => 'Name must be at least 2 characters.',
            'lastName.max' => 'Name should not be greater than 50 characters.',
            'dob.required' => 'Date of birth is required.',
            'phone.required' => 'Phone number is required.',
            'gender_id.required' => 'Select gender',
        ]);

        $input = request()->except('password','confirm_password');
        $user=new User($input);
        $user->password=bcrypt(request()->password);
        $user->uid = str_random(32);
        $user->is_active = 1;
        $user->role_id = 2;
        $user->save();
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
    public function tutorView(User $user){
        return view('admin.tutor.tutorProfile',compact('user'));
    }
}
