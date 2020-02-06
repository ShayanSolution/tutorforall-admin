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
        return view('admin.session.sessionList', compact('sessions'));
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
        return view('admin.session.sessionList', compact('sessions'));
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
        return view('admin.session.sessionList', compact('sessions'));
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
        return view('admin.session.sessionList', compact('sessions'));
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
        return view('admin.session.sessionList', compact('sessions'));
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
        return view('admin.session.sessionList', compact('sessions'));
    }
}
