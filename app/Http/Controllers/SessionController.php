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

    public function sessionLogs(Request $request){
        if ($request->path() == "admin/session/booked"){
            $sessionStatus = 'sessionBooked';
            $status = 'booked';
        }
        if ($request->path() == "admin/session/started"){
            $sessionStatus = 'sessionStarted';
            $status = 'started';
        }
        if ($request->path() == "admin/session/completed"){
            $sessionStatus = 'sessionCompleted';
            $status = 'ended';
        }
        if ($request->path() == "admin/session/missed"){
            $sessionStatus = 'sessionMissed';
            $status = 'expired';
        }
        if ($request->path() == "admin/session/pending"){
            $sessionStatus = 'sessionPending';
            $status = 'pending';
        }
        if ($request->path() == "admin/session/rejected"){
            $sessionStatus = 'sessionRejected';
            $status = 'reject';
        }
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->select('sessions.*', 'student.firstName as studentName', 'tutor.firstName as tutorName', 'class.name as className', 'subject.name as subjectName')
                    ->where('sessions.status','=',$status)
                    ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                    ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                    ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                    ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id');
            }
            else
            {
                $sessions = Session::select('sessions.*', 'student.firstName as studentName', 'tutor.firstName as tutorName', 'class.name as className', 'subject.name as subjectName')
                    ->where('sessions.status','=',$status)
                    ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                    ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                    ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                    ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id');
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
                ->addColumn('sessionType', function($session){
                    return $session->is_hourly?"Hourly Session":"Monthly Session";
                })
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->orderColumn('studentName', 'studentName $1')
                ->orderColumn('tutorName', 'tutorName $1')
                ->orderColumn('className', 'className $1')
                ->orderColumn('subjectName', 'subjectName $1')
                ->orderColumn('sessionType', 'is_hourly $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status',$status)->groupBy('country')->get();
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
                $sessions = $this->sessionFilter($request, $status)->select('sessions.*', 'student.firstName as studentName','payment.transaction_platform as payment', 'tutor.firstName as tutorName', 'class.name as className', 'subject.name as subjectName')
                    ->where('sessions.status','=',$status)
                    ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                    ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                    ->leftJoin('session_payments as payment', 'sessions.id','=','payment.session_id')
                    ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                    ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id');
            }
            else
            {
                $sessions = Session::select('sessions.*', 'student.firstName as studentName', 'tutor.firstName as tutorName', 'class.name as className','payment.transaction_platform as payment', 'subject.name as subjectName')
                    ->where('sessions.status','=',$status)
                    ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                    ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                    ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                    ->leftJoin('session_payments as payment', 'sessions.id','=','payment.session_id')
                    ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id');
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
                ->addColumn('paymentMethod', function($session){
                    return $session->payment!=null ? $session->payment: "Cash";
                })
                ->addColumn('sessionType', function($session){
                    return $session->is_hourly?"Hourly Session":"Monthly Session";
                })
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->orderColumn('studentName', 'studentName $1')
                ->orderColumn('tutorName', 'tutorName $1')
                ->orderColumn('className', 'className $1')
                ->orderColumn('subjectName', 'subjectName $1')
                ->orderColumn('sessionType', 'is_hourly $1')
                ->orderColumn('paymentMethod', 'payment $1')
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

    public function sessionCancelled(Request $request) {

        if ($request->path() == "admin/session/cancelled/tutor"){
            $sessionStatus = 'sessionCancelledTutor';
            $status = 'cancelled';
            $cancelledFrom = 'tutor';
        }
        if ($request->path() == "admin/session/cancelled/student"){
            $sessionStatus = 'sessionCancelledStudent';
            $status = 'cancelled';
            $cancelledFrom = 'student';
        }
        if($request->ajax())
        {
            if($request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $sessions = $this->sessionFilter($request, $status)->select('sessions.*', 'student.firstName as studentName', 'tutor.firstName as tutorName', 'class.name as className', 'subject.name as subjectName')
                    ->where('sessions.status','=',$status)
                    ->where('sessions.cancelled_from','=',$cancelledFrom)
                    ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                    ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                    ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                    ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id');
            }
            else
            {
                $sessions = Session::select('sessions.*', 'student.firstName as studentName', 'tutor.firstName as tutorName', 'class.name as className', 'subject.name as subjectName')
                    ->where('sessions.status','=',$status)
                    ->where('sessions.cancelled_from','=',$cancelledFrom)
                    ->leftJoin('users as student', 'sessions.student_id','=','student.id')
                    ->leftJoin('users as tutor', 'sessions.tutor_id','=','tutor.id')
                    ->leftJoin('programmes as class', 'sessions.programme_id','=','class.id')
                    ->leftJoin('subjects as subject', 'sessions.subject_id','=','subject.id');
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
                ->addColumn('sessionType', function($session){
                    return $session->is_hourly?"Hourly Session":"Monthly Session";
                })
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('duration', 'duration $1')
                ->orderColumn('groupSession', 'is_group $1')
                ->orderColumn('studentName', 'studentName $1')
                ->orderColumn('tutorName', 'tutorName $1')
                ->orderColumn('className', 'className $1')
                ->orderColumn('subjectName', 'subjectName $1')
                ->orderColumn('sessionType', 'is_hourly $1')
                ->make(true);
        }
        $countries = Session::select('country')->whereNotNull('country')->where('status',$status)->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();

        return view('admin.session.sessionList', compact('countries', 'sessionStatus','programs','status'));

    }
}
