<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ReportsController extends Controller
{
    public function tutorReportList(){
        $tutors = User::select('id', 'firstName', 'lastName')->whereHas('profile', function ($q){
            $q->where('is_mentor', 0);
        })->where('role_id',2)->orderBy('id', 'DESC')->get();
        $tutorList = $tutors->map(function ($tutor,$key) {
            $tutortemp = collect($tutor);
            $tutortemp->put('booked',self::getSessionsCount($tutor->id,"booked"));
            $tutortemp->put('started',self::getSessionsCount($tutor->id,"started"));
            $tutortemp->put('ended',self::getSessionsCount($tutor->id,"ended"));
            $tutortemp->put('expired',self::getSessionsCount($tutor->id,"expired"));
            $tutortemp->put('pending',self::getSessionsCount($tutor->id,"pending"));
            $tutortemp->put('reject',self::getSessionsCount($tutor->id,"reject"));
            return $tutortemp;
        });
            return view('admin.Reports.reportsList', compact('tutorList'));

    }

    public static function getSessionsCount($id,$status){
        $sessions = Session::whereHas(
            'tutor', function (Builder $query) use ($id) {
            return $query->where('tutor_id', $id);
        }
        )
            ->where('status',$status)->count();
        return $sessions!=null?$sessions:0;
    }
}
