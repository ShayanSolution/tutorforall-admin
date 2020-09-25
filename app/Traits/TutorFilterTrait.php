<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

trait TutorFilterTrait {
    public function tutorFilter(Request $request, String $mentorOrCommercial)
    {
        $query =  User::query();

        if ($request->has('filterDataArray')) {

            //Location Filter

            // Country Filter
            if (isset($request->input('filterDataArray')['country'])) {
                if($request->input('filterDataArray')['country'] !== 'all')
                {
                    $query = $query->where('country',$request->input('filterDataArray')['country']);
                }
            }
            // Province Filter
            if (isset($request->input('filterDataArray')['province'])) {
                if($request->input('filterDataArray')['province'] !== 'all')
                {
                    $query = $query->where('province',$request->input('filterDataArray')['province']);
                }
            }

            // City Filter
            if (isset($request->input('filterDataArray')['city'])) {
                if($request->input('filterDataArray')['city'] !== 'all')
                {
                    $query = $query->where('city',$request->input('filterDataArray')['city']);
                }
            }
            // Area List Filter
            if (isset($request->input('filterDataArray')['area'])) {
                if($request->input('filterDataArray')['area'] !== 'all')
                {
                    $query = $query->where('area',$request->input('filterDataArray')['area']);
                }
            }

            // End Location Filter

            //  Classes and Suject Filter

            if (isset($request->input('filterDataArray')['class'])) {
                if($request->input('filterDataArray')['class'] !== 'all')
                {
                    $programm_id = $request->input('filterDataArray')['class'];
                    $subject_id = $request->input('filterDataArray')['subject'];
                    $query = $query->whereHas('program_subject', function ($q) use($programm_id, $subject_id){
                        $q->whereIn('program_id', $programm_id);
                        if($subject_id && $subject_id != 'all')
                            $q->whereIn('subject_id', $subject_id);
                    });
                }
                else{
                    $query = $query->with('program_subject');
                }
            }

            if (isset($request->input('filterDataArray')['online_status'])) {
                if($request->input('filterDataArray')['online_status'] !== 'all')
                {
                    $query = $query->where('is_online',$request->input('filterDataArray')['online_status']);
                }
            }
            if(isset($request->input('filterDataArray')['last_login']))
            {
                $range_date = explode('-',$request->input('filterDataArray')['last_login']);
                $start_date = \Carbon\Carbon::parse($range_date[0])->format('Y-m-d'). ' 00:00:00';
                $end_date = \Carbon\Carbon::parse($range_date[1])->format('Y-m-d'). ' 23:59:00';
                $query = $query->whereHas('logins', function ($q) use ($start_date , $end_date) {
                    $q->whereDate('created_at', '>=' , $start_date);
                    $q->whereDate('created_at', '<=' , $end_date);
//                    $q->whereBetween('created_at', [$start_date, $end_date]);
                });
            }
            if (isset($request->input('filterDataArray')['min_experience']) && isset($request->input('filterDataArray')['max_experience'])) {
                if($request->input('filterDataArray')['min_experience'] != '' && $request->input('filterDataArray')['max_experience'] != '')
                {
                    $min_experience = $request->input('filterDataArray')['min_experience'];
                    $max_experience = $request->input('filterDataArray')['max_experience'];

                    $userIds = Session::select('tutor_id', DB::raw('count(*) as number_of_sessions'))
                        ->having('number_of_sessions', '>=' ,  $min_experience)
                        ->having('number_of_sessions', '<=' ,  $max_experience)
                        ->where('status','ended')
                        ->groupBy('tutor_id')
                        ->get()->pluck('tutor_id')->toArray();
                    $query = $query->whereIn('id', $userIds);
                }
            }
            if (isset($request->input('filterDataArray')['min_rating']) && isset($request->input('filterDataArray')['max_rating'])) {
                $min_rating = $request->input('filterDataArray')['min_rating'];
                $max_rating = $request->input('filterDataArray')['max_rating'];
                $query = $query->whereHas('profile', function ($q) use ($min_rating , $max_rating) {
                    if($min_rating)
                        $q->where('min_slider_value', '>=', $min_rating);
                    if($max_rating)
                        $q->where('max_slider_value', '<=', $max_rating);
                });
            }
            if (isset($request->input('filterDataArray')['active_record'])) {
                if($request->input('filterDataArray')['active_record'] !== 'all')
                {
                    $query = $query->where('is_active',$request->input('filterDataArray')['active_record']);
                }
            }
            if (isset($request->input('filterDataArray')['gender_record'])) {
                if($request->input('filterDataArray')['gender_record'] !== 'all')
                {
                    $query = $query->where('gender_id',$request->input('filterDataArray')['gender_record']);
                }
            }
            if (isset($request->input('filterDataArray')['min_age']) && isset($request->input('filterDataArray')['max_age']) ) {
                $todayDate = \Carbon\Carbon::now()->format('Y-m-d');
                $min_dob = strtotime($todayDate. ' -'.$request->input('filterDataArray')['min_age'].' year');
                $min_dob = date('Y-m-d',$min_dob);
                $max_dob = strtotime($todayDate. '-'.$request->input('filterDataArray')['max_age'].' year');
                $max_dob = date('Y-m-d',$max_dob);
                $query = $query->whereBetween('dob', [$max_dob, $min_dob]);
            }
            // Meet Point Filter
            if (isset($request->input('filterDataArray')['meet_point'])) {
                if($request->input('filterDataArray')['meet_point'] !== 'all')
                {
                    $meet_point = $request->input('filterDataArray')['meet_point'];
                    $query = $query->whereHas('profile', function ($q) use($meet_point){
                        if($meet_point == '0')
                            $q->where('call_student', 1);
                        else if($meet_point == '1')
                            $q->where('is_home', 1);
                    });
                }
            }

            // Rating Star Filter
            if(isset($request->input('filterDataArray')['rating']))
            {
                if($request->input('filterDataArray')['rating'] !== 'all')
                {
                    $userIds = Rating::select('user_id', DB::raw(' CEILING( avg(rating)) as user_rating'))
                        ->having('user_rating', '=' ,  $request->input('filterDataArray')['rating'])
                        ->groupBy('user_id')
                        ->get()->pluck('user_id')->toArray();
                    $query = $query->whereIn('id', $userIds);
                }
            }
        }
        if($mentorOrCommercial === 'reports'){
            $query = $query->whereHas('profile')
                ->where('role_id', 2)
                ->orderBy('id', 'DESC');
        }else {
            $mentorOrCommercial === 'Mentor' ?
                $query = $query->whereHas('profile', function ($q) {
                    $q->where('is_mentor', 1);
                })->where('role_id', 2)
                    ->orderBy('id', 'DESC') :
                $query = $query->whereHas('profile', function ($q) {
                    $q->where('is_mentor', 0);
                })->where('role_id', 2)
                    ->orderBy('id', 'DESC');
        }
        return $query;
    }
}
?>
