<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use Illuminate\Support\Facades\DB;

trait TutorFilterTrait {
    public function tutorFilter(Request $request)
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
                        $q->where('program_id', $programm_id);
                        if($subject_id && $subject_id != 'all')
                            $q->where('subject_id', $subject_id);
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
                $start_date = \Carbon\Carbon::parse($range_date[0])->format('Y-m-d');
                $end_date = \Carbon\Carbon::parse($range_date[1])->format('Y-m-d');
                $query = $query->whereHas('profile', function ($q) use ($start_date , $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]);
                });
            }
//            if (isset($request->input('filterDataArray')['min_experience']) && isset($request->input('filterDataArray')['max_experience'])) {

                $min_experience = $request->input('filterDataArray')['min_experience'];
                $max_experience = $request->input('filterDataArray')['max_experience'];
//                $query .= DB::statement("select * from (select *, count(*) as total from sessions) as newTable where total between 1 and 600;");
//                $query = $query->with(['session' => function($q) use($min_experience, $max_experience)
//                {
//                    $q->groupBy('tutor_id')->count();
//                    $q->addSelect(['total_count' => Session::select('*, count(*) AS total')->groupBy('tutor_id')]);
//                    $q->whereBetween('total',[ $min_experience , $max_experience]);
//                }]);
//                $query = $query->addSelect(['total_count' => Session::select('*, count(*) AS total')->groupBy('tutor_id')])
//                    ->whereBetween('total',[$request->input('filterDataArray')['min_experience'], $request->input('filterDataArray')['max_experience']]);
//                $query .= DB::raw("select * from (SELECT *,count(*) as total from sessions group BY 'tutor_id') AS newTable where total BETWEEN 1 and 586;");
//                $query = $query->with(['session' => function ($q){
//                    $q->select("*, count(*) as total")->groupBy('tutor_id');
////                    $q->statement("select * from (SELECT *,count(*) as total from sessions group BY tutor_id) AS newTable where total BETWEEN 1 and 586;");
//                }])->whereBetween('total', [$request->input('filterDataArray')['min_experience'], $request->input('filterDataArray')['max_experience']]);
//                $query = $query->whereBetween('experience',);
//            }
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
//            if(isset($request->input('filterDataArray')['rating']))
//            {
//                if($request->input('filterDataArray')['rating'] !== 'all')
//                {
//                    $rating = $request->input('filterDataArray')['rating'];
//                    $query = $query->raw('SELECT rating from ratings having'.'(Select AVG(rating) FROM ratings GROUP BY user_id )'.'='.$rating);
////                    $query = $query->with(['rating' => function ($q) use($rating){
//
////                        $q->DB::raw('SELECT rating from ratings having'.'(Select AVG(rating) GROUP BY user_id )'.'='.$rating);
////                    }]);
//                }
//            }
        }
        $tutors = $query->where('role_id',2)->orderBy('id', 'DESC');
        return $tutors;
    }
}
?>
