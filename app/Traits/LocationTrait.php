<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait LocationTrait {
    public function getProviceByCountry(Request $request)
    {
        $html = '<option value="all">Select Province</option>';
        $provinces = User::select('province')->where('country', $request->input('country'))->whereNotNull('province')->groupBy('province')->get();
        foreach ($provinces as $province)
        {
            $html.= '<option value="'.$province->province.'">'.$province->province.'</option>';
        }
        return $html;
    }
    public function getCityByProvince(Request $request)
    {
        $html = '<option value="all">Select City</option>';
        $cites = User::select('city')->where('province', $request->input('province'))->whereNotNull('city')->groupBy('city')->get();
        foreach ($cites as $city)
        {
            $html.= '<option value="'.$city->city.'">'.$city->city.'</option>';
        }
        return $html;
    }

    public function getAreaByCity(Request $request)
    {
        $html = '<option value="all">Select Area List</option>';
        $areas = User::select('area')->where('city', $request->input('city'))->whereNotNull('area')->groupBy('area')->get();
        foreach ($areas as $area)
        {
            $html.= '<option value="'.$area->area.'">'.$area->area.'</option>';
        }
        return $html;
    }
}
