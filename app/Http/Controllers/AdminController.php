<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function tutorsList(){
        $tutors = User::where('role_id',2)->get();
        return view('admin.tutor.tutorsList',compact('tutors'));
    }
    public function tutorAdd(Request $request){
        dd($request);
    }
    public function studentsList(){
        $students = User::where('role_id',3)->get();
        return view('admin.student.studentsList',compact('students'));
    }
    public function updatePasswordPage(){
        return view('admin.updatePasswordPage');
    }
}
