<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait TutorFilterTrait {
    public function tutorFilter(Request $request, String $mentorOrCommercial)
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
                $min_rating = $request->input('filterDataArray')['min_rating'];
                $max_rating = $request->input('filterDataArray')['max_rating'];
                $query = $query->whereHas('rating', function ($q) use ($min_rating , $max_rating) {
                    $q->whereBetween('rating', [ $max_rating , $min_rating ]);
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
        }
        $mentorOrCommercial === 'Mentor'?
            $tutors =
                $query->whereHas('profile', function ($q){
                        $q->where('is_mentor', 1);
                    })->where('role_id',2)
                    ->where('is_approved',1)
                    ->orderBy('id', 'DESC') :
            $tutors =
                $query->whereHas('profile', function ($q){
                    $q->where('is_mentor', 0);
                    })->where('role_id',2)
                    ->where('is_approved',1)
                    ->orderBy('id', 'DESC');
        return $tutors;
    }
}
?>
