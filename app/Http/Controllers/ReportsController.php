<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Session;
use App\Models\User;
use App\Traits\TutorFilterTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ReportsController extends Controller
{
    use TutorFilterTrait;
    public function tutorReportList(Request $request)
    {
        if ($request->ajax()) {
            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray'))
            {
                $tutors = $this->tutorFilter($request,'reports')->where('is_approved',1);
            }else{
                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q) {
                    $q->where('is_mentor', 0);
                })->with('rating')->where('role_id', 2)->orderBy('id', 'DESC');
            }
            return datatables()->eloquent($tutors)
                ->addColumn('booked', function ($tutor) {
                    return self::getSessionsCount($tutor->id, "booked");
                })
                ->addColumn('started', function ($tutor) {
                    return self::getSessionsCount($tutor->id, "started");
                })
                ->addColumn('completed', function ($tutor) {
                    return self::getSessionsCount($tutor->id, "ended");
                })
                ->addColumn('missed', function ($tutor) {
                    return self::getSessionsCount($tutor->id, "expired");
                })
                ->addColumn('pending', function ($tutor) {
                    return self::getSessionsCount($tutor->id, "pending");
                })
                ->addColumn('rejected', function ($tutor) {
                    return self::getSessionsCount($tutor->id, "reject");
                })
                ->rawColumns(['booked', 'started', 'completed', 'missed', 'pending', 'rejected'])
                ->make();
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();

        return view('admin.Reports.reportsList',compact('countries','programs'));

    }

    public static function getSessionsCount($id, $status)
    {
        $sessions = Session::whereHas(
            'tutor', function (Builder $query) use ($id) {
            return $query->where('tutor_id', $id);
        }
        )
            ->where('status', $status)->count();
        return $sessions != null ? $sessions : 0;
    }
}
