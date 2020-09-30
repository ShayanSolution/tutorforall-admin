<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Session;
use App\Models\User;
use App\Traits\SessionFilterTrait;
use Illuminate\Http\Request;
use App\Traits\LocationTrait;

class SessionController extends Controller
{
    use SessionFilterTrait;
    use LocationTrait;
    public function sessionBooked(Request $request){
        $sessionStatus = 'sessionBooked';
        $status = 'booked';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->where('status','booked');
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
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status',$status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));
    }

    public function sessionStarted(Request $request){
        $sessionStatus = 'sessionStarted';
        $status = 'started';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->where('status','started');
            }
            else
            {
                $sessions = Session::with([
                    'tutor',
                    'student',
                    'class',
                    'subject'
                ])->where('status','started');
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
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status', $status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));
    }

    public function sessionCompleted(Request $request){
        $sessionStatus = 'sessionCompleted';
        $status = 'ended';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->where('status','ended');
            }
            else
            {
                $sessions = Session::with([
                    'tutor',
                    'student',
                    'class',
                    'subject'
                ])->where('status','ended');
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
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status', $status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));
    }

    public function sessionMissed(Request $request){
        $sessionStatus = 'sessionMissed';
        $status = 'expired';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->where('status','expired');
            }
            else
            {
                $sessions = Session::with([
                    'tutor',
                    'student',
                    'class',
                    'subject'
                ])->where('status','expired');
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
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status', $status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));
    }

    public function sessionPending(Request $request){
        $sessionStatus = 'sessionPending';
        $status = 'pending';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->where('status','pending');
            }
            else
            {
                $sessions = Session::with([
                    'tutor',
                    'student',
                    'class',
                    'subject'
                ])->where('status','pending');
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
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status', $status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));
    }

    public function sessionRejected(Request $request){
        $sessionStatus = 'sessionRejected';
        $status = 'reject';
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->where('status','reject');
            }
            else
            {
                $sessions = Session::with([
                    'tutor',
                    'student',
                    'class',
                    'subject'
                ])->where('status','reject');
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
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status', $status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));
    }
    public function fetchProvince(Request $request)
    {
        $provicesHtml = $this->getProvinceByCountrySession($request);
        return $provicesHtml;
    }
    public function fetchCity (Request $request)
    {
        $citiesHtml = $this->getCityByProvinceSession($request);
        return $citiesHtml;
    }
    public function fetchArea(Request $request)
    {
        $areasHtml = $this->getAreaByCitySession($request);
        return $areasHtml;
    }
}
