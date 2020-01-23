<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function sessionList(){
        $sessions = Session::all();
        $sessions = Session::with([
            'tutor',
            'student',
            'class',
            'subject'
        ])->get();
//        dd($sessions->toArray());
        return view('admin.session.sessionList', compact('sessions'));
    }
}
