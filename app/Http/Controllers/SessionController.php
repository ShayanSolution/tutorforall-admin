<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function sessionBooked(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','booked')->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionBooked', compact('sessions'));
    }

    public function sessionStarted(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','started')->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionStarted', compact('sessions'));
    }

    public function sessionCompleted(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','ended')->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionCompleted', compact('sessions'));
    }

    public function sessionMissed(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','expired')->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionMissed', compact('sessions'));
    }

    public function sessionpending(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','pending')->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionPending', compact('sessions'));
    }

    public function sessionRejected(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->where('status','reject')->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionRejected', compact('sessions'));
    }
}
