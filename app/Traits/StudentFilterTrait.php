<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

trait StudentFilterTrait {
    public function studentFilter(Request $request)
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
                    $query = $query->whereHas('studentSession', function ($q) use($programm_id, $subject_id){
                        $q->whereIn('programme_id', $programm_id);
                        if($subject_id && $subject_id != 'all')
                            $q->whereIn('subject_id', $subject_id);
                    });
                }
                else{
                    $query = $query->with('studentSession');
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
            // No of Session
            if (isset($request->input('filterDataArray')['min_session']) && isset($request->input('filterDataArray')['max_session'])) {
                if($request->input('filterDataArray')['min_session'] != '' && $request->input('filterDataArray')['max_session'] != '')
                {
                    $min_session = $request->input('filterDataArray')['min_session'];
                    $max_session = $request->input('filterDataArray')['max_session'];

                    $userIds = Session::select('student_id', DB::raw('count(*) as number_of_sessions'))
                        ->having('number_of_sessions', '>=' ,  $min_session)
                        ->having('number_of_sessions', '<=' ,  $max_session)
                        ->where('status','ended')
                        ->groupBy('student_id')
                        ->get()->pluck('student_id')->toArray();
                    $query = $query->whereIn('id', $userIds);
                }
            }
            if (isset($request->input('filterDataArray')['active_record'])) {
                if($request->input('filterDataArray')['active_record'] !== 'all')
                {
                    $query = $query->where('is_active',$request->input('filterDataArray')['active_record']);
                }
            }
            // Gender
            if (isset($request->input('filterDataArray')['gender_record'])) {
                if($request->input('filterDataArray')['gender_record'] !== 'all')
                {
                    $query = $query->where('gender_id',$request->input('filterDataArray')['gender_record']);
                }
            }
            // Age
            if (isset($request->input('filterDataArray')['min_age']) && isset($request->input('filterDataArray')['max_age']) ) {
                $todayDate = \Carbon\Carbon::now()->format('Y-m-d');
                $min_dob = strtotime($todayDate. ' -'.$request->input('filterDataArray')['min_age'].' year');
                $min_dob = date('Y-m-d',$min_dob);
                $max_dob = strtotime($todayDate. '-'.$request->input('filterDataArray')['max_age'].' year');
                $max_dob = date('Y-m-d',$max_dob);
                $query = $query->whereBetween('dob', [$max_dob, $min_dob]);
            }
            // Deserving
            if (isset($request->input('filterDataArray')['deserving'])) {
                if($request->input('filterDataArray')['deserving'] !== 'all')
                {
                    $deserving = $request->input('filterDataArray')['deserving'];
                    $query = $query->whereHas('profile', function ($q) use($deserving){
                        $q->where('is_deserving', $deserving);
                    });
                }
            }
        }
        return $query;
    }
}
?>
