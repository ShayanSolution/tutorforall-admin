<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Program;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{

    public function subjectsList(){
        $subjects = Subject::all()->sortByDesc("id");
        return view('admin.subject.subjectsList',compact('subjects'));
    }
    public function subjectAdd(){
        $programs = Program::where('status',1)->get();
        return view('admin.subject.subjectAdd',compact('programs'));
    }
    public function subjectSave(Request $request){
        $subject = new Subject();
        $subject->programme_id     =   $request->program;
        $subject->name             =   $request->name;
        $subject->status           =   $request->status;
        $subject->save();
        return redirect()->route('subjectsList')->with('success','Subject added Successfully');
    }
//    public function studentsList(){
//        $students = User::where('role_id',3)->with('profile')->orderby('id','DESC')->get();
//        return view('admin.student.studentsList',compact('students'));
//    }
//    public function changeStudentDeserving(Request $request){
//        $student_id = $request->student_id;
//        $is_deserving = $request->is_deserving;
//        $profile = Profile::where('user_id', $student_id)->first();
//        if ($is_deserving == 'true'){
//            $profile->is_deserving = 1;
//            $profile->save();
//        }else{
//            $profile->is_deserving = 0;
//            $profile->save();
//        }
//    }

}
