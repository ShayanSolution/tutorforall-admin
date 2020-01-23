<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Profile;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){

        $data['activeTutors'] = User::where('role_id', 2)->where('is_active', 1)->count();
        $data['inactiveTutors'] = User::where('role_id', 2)->where('is_active', 0)->count();

        $data['activeStudents'] = User::where('role_id', 3)->where('is_active', 1)->count();
        $data['inactiveStudents'] = User::where('role_id', 3)->where('is_active', 0)->count();

        $data['tutors'] = User::where('role_id', 2)->count();
        $data['students'] = User::where('role_id', 3)->count();

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

    public function candidates(){
        $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone')->with(['profile'=>function($q){
            $q->select("is_mentor", "user_id");
        }])->where('role_id', Document::STATUS_PENDING)->get();
        return view('admin.candidates', compact('tutors'));
    }

    public function candidateDocuments($id){
        $tutor =  User::with(['documents', 'program_subject.subject:id,name', 'program_subject.program:id,name'])
            ->select(['id', 'firstName', 'lastName'])
            ->find($id);

        foreach ($tutor->program_subject as $key=>$programSubject){
            $program = $programSubject->program->name;
            $subject = $programSubject->subject->name;
            unset(
                $programSubject["id"],
                $programSubject["program_id"],
                $programSubject["subject_id"],
                $programSubject["user_id"],
                $programSubject["created_at"],
                $programSubject["updated_at"],
                $programSubject["subject"],
                $programSubject["program"]
            );
            $programSubject["program"] = $program;
            $programSubject["subject"] = $subject;
        }

        return view('admin.documents', compact('tutor'));
    }



    public function acceptDocument($id){

        $document = Document::find($id);

        if(!$document)
            return redirect()->back()->with('error', 'Document does not exists.');

        $updated = $document->update([
            'rejection_reason'  =>  '',
            'status'            =>  Document::STATUS_ACCEPTED,
            'verified_by'       =>  Auth::user()->id,
            'verified_at'       =>  now()
        ]);

        if(!$updated)
            return redirect()->back()->with('error','Oops! Something went wrong.');

        return redirect()->back()->with('success','Document accepted successfully.');
    }

    public function rejectDocument(Request $request){

        $document = Document::find($request->document_id);

        if(!$document)
            return redirect()->back()->with('error', 'Document does not exists.');

        $updated = $document->update([
            'rejection_reason'  =>  $request->rejection_reason,
            'status'            =>  Document::STATUS_REJECTED,
            'verified_by'       =>  Auth::user()->id,
            'verified_at'       =>  now()
        ]);

        if(!$updated)
            return redirect()->back()->with('error','Oops! Something went wrong.');

        return redirect()->back()->with('success','Document rejected successfully.');
    }
}
