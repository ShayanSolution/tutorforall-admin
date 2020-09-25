<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function sessionBooked(Request $request){
        $sessionStatus = 'sessionBooked';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {

            }
            else
            {
                $sessions = Session::with([
                    'tutor',
                    'student',
                    'class',
                    'subject'
                ])->where('status','booked');
            }
            return datatables()->eloquent($sessions)
                ->addColumn('studentName', function($session){
                    return $session->student ? $session->student->firstName." ". $session->student->lastName: 'N-A';
                })
                ->addColumn('tutorName', function($session){
                    return $session->tutor ? $session->tutor->firstName." ". $session->tutor->lastName: 'N-A';
                })
                ->addColumn('className', function($session){
                    return $session->class ? $session->class->name : 'N-A';
                })
                ->addColumn('subjectName', function($session){
                    return $session->subject ? $session->subject->name : 'N-A';
                })
                ->addColumn('groupSession', function($session){
                    return $session->is_group == 0 ? 'No' : ' Yes';
                })
                ->addColumn('duration', function($session){
                    return ($session->duration == "") ? "" : \Carbon\Carbon::parse($session->duration)->format('H:i:s');
                })
                ->addColumn('created_at', function($session){
                    return dateTimeConverter($session->created_at);
                })
                ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus'));
    }

    public function sessionStarted(){
        $sessionStatus = 'sessionStarted';
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','started')->get();
        return view('admin.session.sessionList', compact('sessions', 'sessionStatus'));
    }

    public function sessionCompleted(){
        $sessionStatus = 'sessionEnded';
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','ended')->get();
        return view('admin.session.sessionList', compact('sessions', 'sessionStatus'));
    }

    public function sessionMissed(){
        $sessionStatus = 'sessionMissed';
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','expired')->get();
        return view('admin.session.sessionList', compact('sessions', 'sessionStatus'));
    }

    public function sessionpending(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','pending')->get();
        return view('admin.session.sessionList', compact('sessions', 'sessionStatus'));
    }

    public function sessionRejected(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','reject')->get();
        return view('admin.session.sessionList', compact('sessions', 'sessionStatus'));
    }
}
