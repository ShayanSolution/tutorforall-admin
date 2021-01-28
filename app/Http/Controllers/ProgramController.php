<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function programsList(){
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.program.programsList',compact('programs'));
    }
    public function programAdd(){
       return view('admin.program.programAdd');
    }
    public function programSave(Request $request){
        $request->validate([
            'name'    => 'required',
            'status'     => 'required'
        ]);
        $program = new Program();
        $program->name     =   $request->name;
        $program->note     =   $request->note;
        $program->status   =   $request->status;
        $program->save();
        return redirect()->route('programsList')->with('success','Program added Successfully');
    }
    public function programsEdit(Program $program){
        return view('admin.program.programEdit',compact('program'));
    }
    public function programUpdate(Request $request, Program $program){
        $request->validate([
            'name'    => 'required',
            'status'    => 'required'
        ]);
        $program->name = $request->name;
        $program->note     =   $request->note;
        $program->status = $request->status;
        $program->save();
        return redirect()->route('programsList')->with('success','Program Updated successfully');
    }
    public function programDelete(Program $program){
        $program->delete();
        return redirect()->route('programsList')->with('success','Program Deleted successfully');
    }

}
