<?php

namespace App\Traits;

use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use function foo\func;

trait SessionFilterTrait
{
    public function sessionFilter(Request $request, $status = 'booked')
    {
        $query = Session::query();

        if ($request->has('filterDataArray')) {

            //Location Filter

            // Country Filter
            if (isset($request->input('filterDataArray')['country'])) {
                if ($request->input('filterDataArray')['country'] !== 'all') {
                    $query = $query->where('tutor.country', $request->input('filterDataArray')['country']);
                }
            }
            // Province Filter
            if (isset($request->input('filterDataArray')['province'])) {
                if ($request->input('filterDataArray')['province'] !== 'all') {
                    $query = $query->where('tutor.province', $request->input('filterDataArray')['province']);
                }
            }

            // City Filter
            if (isset($request->input('filterDataArray')['city'])) {
                if ($request->input('filterDataArray')['city'] !== 'all') {
                    $query = $query->where('tutor.city', $request->input('filterDataArray')['city']);
                }
            }
            // Area List Filter
            if (isset($request->input('filterDataArray')['area'])) {
                if ($request->input('filterDataArray')['area'] !== 'all') {
                    $query = $query->where('tutor.area', $request->input('filterDataArray')['area']);
                }
            }

            // End Location Filter


            //  Classes and Subject Filter

            if (isset($request->input('filterDataArray')['class'])) {
                if ($request->input('filterDataArray')['class'] !== 'all') {
                    $query = $query->whereIn('class.id', $request->input('filterDataArray')['class']);
                    $subject_id = $request->input('filterDataArray')['subject'];
                    if ($subject_id && $subject_id != 'all')
                        $query = $query->whereIn('subject.id', $subject_id);
                }
            }
            if (isset($request->input('filterDataArray')['date_range'])) {
                $range_date = explode('-', $request->input('filterDataArray')['date_range']);
                $start_date = \Carbon\Carbon::parse($range_date[0])->format('Y-m-d'). ' 00:00:00';
                $end_date = \Carbon\Carbon::parse($range_date[1])->format('Y-m-d').' 23:59:59';
                $query = $query->whereDate('started_at','>=', $start_date)
                ->whereDate('started_at','<=', $end_date);
            }
            if (isset($request->input('filterDataArray')['min_experience']) && isset($request->input('filterDataArray')['max_experience'])) {
                if ($request->input('filterDataArray')['min_experience'] != '' && $request->input('filterDataArray')['max_experience'] != '') {
                    $min_experience = $request->input('filterDataArray')['min_experience'];
                    $max_experience = $request->input('filterDataArray')['max_experience'];
                        $SessionIds = Session::selectRaw('count(*) as number_of_sessions, tutor_id, ANY_VALUE(id)')
                        ->having('number_of_sessions', '>=', $min_experience)
                        ->having('number_of_sessions', '<=', $max_experience)
                        ->where('status', 'ended')
                        ->groupBy('tutor_id')->get()->pluck('ANY_VALUE(id)')->toArray();
                    $query = $query->whereIn('id', $SessionIds);
                }
            }

            if (isset($request->input('filterDataArray')['min_rate']) && isset($request->input('filterDataArray')['max_rate'])) {
                $min_rate = $request->input('filterDataArray')['min_rate'];
                $max_rate = $request->input('filterDataArray')['max_rate'];
                $query = $query->where('hourly_rate','>=', $min_rate)
                ->where('hourly_rate','<=',$max_rate);
            }
//            Gender Session
            if (isset($request->input('filterDataArray')['gender_record'])) {
                if ($request->input('filterDataArray')['gender_record'] !== 'all') {

                    $gender_id_array = explode(',',$request->input('filterDataArray')['gender_record']);
                    $tutor_value = $gender_id_array[1];
                    $student_value = $gender_id_array[0];
                    $query = $query->whereHas('tutor', function ($q) use($tutor_value){
                        $q->where('gender_id', $tutor_value);
                    });
                    $query = $query->whereHas('student', function ($q) use($student_value){
                        $q->where('gender_id', $student_value);
                    });
                }
            }
//            Filter age
            if (isset($request->input('filterDataArray')['min_age']) && isset($request->input('filterDataArray')['max_age'])) {
                $todayDate = \Carbon\Carbon::now()->format('Y-m-d');
                $min_dob = strtotime($todayDate . ' -' . $request->input('filterDataArray')['min_age'] . ' year');
                $min_dob = date('Y-m-d', $min_dob);
                $max_dob = strtotime($todayDate . '-' . $request->input('filterDataArray')['max_age'] . ' year');
                $max_dob = date('Y-m-d', $max_dob);
                $query = $query->where('tutor.dob','>=', $max_dob)->where('tutor.dob','<=', $min_dob)->where('sessions.status',$status);
                $query = $query->where('student.dob','>=', $max_dob)->where('student.dob','<=', $min_dob)->where('sessions.status',$status);
            }
            // Meet Point Filter
            if (isset($request->input('filterDataArray')['meet_point'])) {
                if ($request->input('filterDataArray')['meet_point'] !== 'all') {
                    $query = $query->where('is_home', $request->input('filterDataArray')['meet_point']);
                }
            }

            // Rating Star Filter
            if (isset($request->input('filterDataArray')['min_rate_star']) && isset($request->input('filterDataArray')['max_rate_star'])) {
                if ($request->input('filterDataArray')['min_rate_star'] != '' && $request->input('filterDataArray')['max_rate_star'] != '') {
                    $min_rate_star = $request->input('filterDataArray')['min_rate_star'];
                    $max_rate_star = $request->input('filterDataArray')['max_rate_star'];
                    $query = $query->whereHas('rating', function ($q) use($min_rate_star , $max_rate_star) {
                        $q->where('rating' , '>=', $min_rate_star);
                        $q->where('rating' ,  '<=', $max_rate_star);
                    });
                }
            }
        }
        return $query;
    }
}

