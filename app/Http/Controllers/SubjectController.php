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
        $request->validate([
            'program'    => 'required',
            'name'       => 'required',
            'status'     => 'required'
        ]);
        $subject = new Subject();
        $subject->programme_id     =   $request->program;
        $subject->name             =   $request->name;
        $subject->status           =   $request->status;
        $subject->save();
        return redirect()->route('subjectsList')->with('success','Subject added Successfully');
    }
    public function subjectsEdit(Subject $subject){
        $programs = Program::where('status','1')->get();
        return view('admin.subject.subjectEdit',compact('subject','programs'));
    }
    public function subjectUpdate(Request $request, Subject $subject){
        $request->validate([
            'name'    => 'required',
            'status'    => 'required',
            'program'    => 'required'
        ]);
        $subject->name = $request->name;
        $subject->status = $request->status;
        $subject->programme_id = $request->program;
        $subject->save();
        return redirect()->route('subjectsList')->with('success','Program Updated successfully');
    }
    public function subjectDelete(Subject $subject){
        $subject->delete();
        return redirect()->route('subjectsList')->with('success','Subject Deleted successfully');
    }

}
