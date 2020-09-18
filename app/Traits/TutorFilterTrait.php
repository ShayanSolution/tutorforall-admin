<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;

trait TutorFilterTrait {
    public function tutorFilter(Request $request)
    {
//        $range_date = explode('-',$request->last_login);
//        $start_date = \Carbon\Carbon::parse($range_date[0])->format('Y-m-d');
//        $end_date = \Carbon\Carbon::parse($range_date[1])->format('Y-m-d');
//        $tutors = User::whereBetween('last_login', [$start_date, $end_date])->get();

        $query =  User::query();

        if (Input::has('last_login')) {
            $range_date = explode('-',$request->last_login);
            $start_date = \Carbon\Carbon::parse($range_date[0])->format('Y-m-d');
            $end_date = \Carbon\Carbon::parse($range_date[1])->format('Y-m-d');
            $query = $query->whereBetween('last_login', [$start_date, $end_date]);
        }
        if (Input::has('min_experience') && Input::has('max_experience') ) {
            $query = $query->whereBetween('experience', [$request->min_experience, $request->max_experience]);
        }
        if (Input::has('min_rating') && Input::has('max_rating') ) {
            $query = $query->whereHas('rating', function ($q){
                $q->whereBetween('rating', [Input::get('min_rating'), Input::get('max_rating')]);
            });
        }
        $tutors = $query->get();
        return $tutors;
    }
}
?>
