<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function programsList(){
        $programs = Program::all()->sortByDesc("id");
        return view('admin.program.programsList',compact('programs'));
    }
    public function programAdd(){
       return view('admin.program.programAdd');
    }
    public function programSave(Request $request){
        $program = new Program();
        $program->name     =   $request->name;
        $program->status   =   $request->status;
        $program->save();
        return redirect()->route('programsList')->with('success','Program added Successfully');
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
