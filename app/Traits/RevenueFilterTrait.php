<?php
namespace App\Traits;
use App\Models\TutorInvoice;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

trait RevenueFilterTrait {

	public function revenueFilter(Request $request, String $mentorOrCommercial) {
		$query = TutorInvoice::query();

		if ($request->has('filterDataArray')) {

			//Revenue Filter

			// Country Filter
			//			if (isset($request->input('filterDataArray')['country'])) {
			//				if($request->input('filterDataArray')['country'] !== 'all')
			//				{
			//					$query = $query->where('country',$request->input('filterDataArray')['country']);
			//				}
			//			}
			// Province Filter
			//			if (isset($request->input('filterDataArray')['province'])) {
			//				if($request->input('filterDataArray')['province'] !== 'all')
			//				{
			//					$query = $query->where('province',$request->input('filterDataArray')['province']);
			//				}
			//			}

			// City Filter
			//			if (isset($request->input('filterDataArray')['city'])) {
			//				if($request->input('filterDataArray')['city'] !== 'all')
			//				{
			//					$query = $query->where('city',$request->input('filterDataArray')['city']);
			//				}
			//			}
			// Area List Filter
			//			if (isset($request->input('filterDataArray')['area'])) {
			//				if($request->input('filterDataArray')['area'] !== 'all')
			//				{
			//					$query = $query->where('area',$request->input('filterDataArray')['area']);
			//				}
			//			}

			// End Location Filter

			//  Classes and Suject Filter

			//			if (isset($request->input('filterDataArray')['class'])) {
			//				if($request->input('filterDataArray')['class'] !== 'all')
			//				{
			//					$programm_id = $request->input('filterDataArray')['class'];
			//					$subject_id = $request->input('filterDataArray')['subject'];
			//					$query = $query->whereHas('program_subject', function ($q) use($programm_id, $subject_id){
			//						$q->whereIn('program_id', $programm_id)->where('document_id','!=',0)->where('status',1);
			//
			//						if($subject_id && $subject_id != 'all')
			//							$q->whereIn('subject_id', $subject_id);
			//					});
			//				}
			//				else{
			//					$query = $query->with('program_subject');
			//				}
			//			}

			//			if (isset($request->input('filterDataArray')['online_status'])) {
			//				if($request->input('filterDataArray')['online_status'] !== 'all')
			//				{
			//					$query = $query->where('is_online',$request->input('filterDataArray')['online_status']);
			//				}
			//			}
			//			if(isset($request->input('filterDataArray')['last_login']))
			//			{
			//				$range_date = explode('-',$request->input('filterDataArray')['last_login']);
			//				$start_date = \Carbon\Carbon::parse($range_date[0])->format('Y-m-d'). ' 00:00:00';
			//				$end_date = \Carbon\Carbon::parse($range_date[1])->format('Y-m-d'). ' 23:59:59';
			//				$query = $query->whereHas('logins', function ($q) use ($start_date , $end_date) {
			//					$q->whereDate('created_at', '>=' , $start_date);
			//					$q->whereDate('created_at', '<=' , $end_date);
			//					//                    $q->whereBetween('created_at', [$start_date, $end_date]);
			//				});
			//			}
			if (isset($request->input('filterDataArray')['min_commission']) && isset($request->input('filterDataArray')['max_commission'])) {
				if ($request->input('filterDataArray')['min_commission'] != '' && $request->input('filterDataArray')['max_commission'] != '') {
					$min_commission = $request->input('filterDataArray')['min_commission'];
					$max_commission = $request->input('filterDataArray')['max_commission'];

					//					$query = $query->where('commission', '>=', $min_commission)
					//								   ->where('commission', '<=', $max_commission);


					$userIds = TutorInvoice::select('tutor_id', DB::raw('SUM(commission) as total_commision'))
										   ->having('total_commision', '>=', $min_commission)
										   ->having('total_commision', '<=', $max_commission)
										   ->groupBy('tutor_id')
										   ->get()->pluck('tutor_id')->toArray();
					$query   = $query->whereIn('tutor_id', $userIds);
				}
			}

			if (isset($request->input('filterDataArray')['min_revenue']) && isset($request->input('filterDataArray')['max_revenue'])) {
				if ($request->input('filterDataArray')['min_revenue'] != '' && $request->input('filterDataArray')['max_revenue'] != '') {
					$min_revenue = $request->input('filterDataArray')['min_revenue'];
					$max_revenue = $request->input('filterDataArray')['max_revenue'];
					$userIds     = TutorInvoice::select('tutor_id', DB::raw('SUM(amount) as total_earning'))
											   ->having('total_earning', '>=', $min_revenue)
											   ->having('total_earning', '<=', $max_revenue)
											   ->groupBy('tutor_id')
											   ->get()->pluck('tutor_id')->toArray();
					$query       = $query->whereIn('tutor_id', $userIds);
				}
			}
			//			if (isset($request->input('filterDataArray')['min_rating']) && isset($request->input('filterDataArray')['max_rating'])) {
			//				$min_rating = $request->input('filterDataArray')['min_rating'];
			//				$max_rating = $request->input('filterDataArray')['max_rating'];
			//				$query = $query->whereHas('profile', function ($q) use ($min_rating , $max_rating) {
			//					if($min_rating)
			//						$q->where('min_slider_value', '>=', $min_rating);
			//					if($max_rating)
			//						$q->where('max_slider_value', '<=', $max_rating);
			//				});
			//			}
			//			if (isset($request->input('filterDataArray')['active_record'])) {
			//				if($request->input('filterDataArray')['active_record'] !== 'all')
			//				{
			//					$query = $query->where('is_active',$request->input('filterDataArray')['active_record']);
			//				}
			//			}

			if (isset($request->input('filterDataArray')['status_record'])) {
				if ($request->input('filterDataArray')['status_record'] !== 'all') {
					$status = $request->input('filterDataArray')['status_record'];
					$query  = $query->whereHas('tutor',
						function ($q) use ($status) {
							$q->where('is_blocked', $status);
						});
				}
			}

			//			if (isset($request->input('filterDataArray')['min_age']) && isset($request->input('filterDataArray')['max_age']) ) {
			//				$todayDate = \Carbon\Carbon::now()->format('Y-m-d');
			//				$min_dob = strtotime($todayDate. ' -'.$request->input('filterDataArray')['min_age'].' year');
			//				$min_dob = date('Y-m-d',$min_dob);
			//				$max_dob = strtotime($todayDate. '-'.$request->input('filterDataArray')['max_age'].' year');
			//				$max_dob = date('Y-m-d',$max_dob);
			//				$query = $query->whereDate('dob','>=', $min_dob)->whereDate('dob','<=',$max_dob);
			//			}
			// Meet Point Filter
			//			if (isset($request->input('filterDataArray')['meet_point'])) {
			//				if($request->input('filterDataArray')['meet_point'] !== 'all')
			//				{
			//					$meet_point = $request->input('filterDataArray')['meet_point'];
			//					$query = $query->whereHas('profile', function ($q) use($meet_point){
			//						if($meet_point == '0')
			//							$q->where('call_student', 1)->where('is_home', 0);
			//						else if($meet_point == '1')
			//							$q->where('is_home', 1)->where('call_student', 0);
			//					});
			//				}
			//			}

			// Rating Star Filter
			//			if(isset($request->input('filterDataArray')['rating']))
			//			{
			//				if($request->input('filterDataArray')['rating'] !== 'all')
			//				{
			//					$userIds = Rating::select('user_id', DB::raw(' CEILING( avg(rating)) as user_rating'))
			//									 ->having('user_rating', '=' ,  $request->input('filterDataArray')['rating'])
			//									 ->groupBy('user_id')
			//									 ->get()->pluck('user_id')->toArray();
			//					$query = $query->whereIn('id', $userIds);
			//				}
			//			}
		}
		return $query;
	}
}

?>
