<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;

trait TutorFilterTrait {
    public function tutorFilter(Request $request)
    {
        $query =  User::query();

        if ($request->has('filterDataArray')) {
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
                $query = $query->whereBetween('last_login', [$start_date, $end_date]);
            }
            if (isset($request->input('filterDataArray')['min_experience']) && isset($request->input('filterDataArray')['max_experience'])) {
                $query = $query->whereBetween('experience', [$request->input('filterDataArray')['min_experience'], $request->input('filterDataArray')['max_experience']]);
            }
            if (isset($request->input('filterDataArray')['min_rating']) && isset($request->input('filterDataArray')['max_rating'])) {
                $query = $query->whereHas('rating', function ($q, Request $request){
                    $q->whereBetween('rating', [$request->input('filterDataArray')['min_rating'], $request->input('filterDataArray')['max_rating']]);
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
//            if (isset($request->input('filterDataArray')['min_age']) && isset($request->input('filterDataArray')['max_age']) ) {
//                $todayDate = \Carbon\Carbon::now()->format('Y-m-d');
//                echo $todayDate.' d ';
//                $min_dob = strtotime($todayDate. ' -'.$request->input('filterDataArray')['min_age']);
//                $min_dob = date('Y-m-d',$min_dob);
//                $max_dob = strtotime($todayDate. '-'.$request->input('filterDataArray')['max_age']);
//                $max_dob = date('Y-m-d',$max_dob);
//                $query = $query->whereBetween('dob', [$min_dob, $max_dob]);
//                echo $min_dob .' d ';
//                echo $max_dob .' d ';
//                exit();
//            }
        }
        $tutors = $query->where('role_id',2)->orderBy('id', 'DESC');
        return $tutors;
    }
}
?>
