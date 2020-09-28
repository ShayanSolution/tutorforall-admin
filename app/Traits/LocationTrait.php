<?php
namespace App\Traits;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use Illuminate\Support\Facades\DB;

trait LocationTrait {
    public function getProviceByCountry(Request $request)
    {
        $html = '<option value="all">Select Province</option>';
        $provinces = User::query()->select('province')->where('country', $request->input('country'))->where('role_id', $request->input('role_id'));
        if($request->input('role_id') == '2')
            $provinces = $provinces->where('is_approved','1');
        $provinces = $provinces->whereNotNull('province')->groupBy('province')->get();
        foreach ($provinces as $province)
            $html.= '<option value="'.$province->province.'">'.$province->province.'</option>';
        return $html;
    }
    public function getCityByProvince(Request $request)
    {
        $html = '<option value="all">Select City</option>';
        $cites = User::select('city')->where('province', $request->input('province'))->where('role_id', $request->input('role_id'));
        if($request->input('role_id') == '2')
            $cites = $cites->where('is_approved','1');
        $cites = $cites->whereNotNull('city')->groupBy('city')->get();
        foreach ($cites as $city)
        {
            $html.= '<option value="'.$city->city.'">'.$city->city.'</option>';
        }
        return $html;
    }

    public function getAreaByCity(Request $request)
    {
        $html = '<option value="all">Select Area List</option>';
        $areas = User::select('area')->where('city', $request->input('city'))->where('role_id', $request->input('role_id'));
        if($request->input('role_id') == '2')
            $areas = $areas->where('is_approved','1');
        $areas = $areas->whereNotNull('area')->groupBy('area')->get();
        foreach ($areas as $area)
        {
            $html.= '<option value="'.$area->area.'">'.$area->area.'</option>';
        }
        return $html;
    }
    public function getProvinceByCountrySession(Request $request)
    {
        $html = '<option value="all">Select Province</option>';
        $provinces = Session::select('province')->where('country', $request->input('country'))->whereNotNull('province')->where('status', $request->input('status'))->groupBy('province')->get();
        foreach ($provinces as $province)
            $html.= '<option value="'.$province->province.'">'.$province->province.'</option>';
        return $html;
    }
    public function getCityByProvinceSession(Request $request)
    {
        $html = '<option value="all">Select City</option>';
        $cities = Session::select('city')->where('province', $request->input('province'))->whereNotNull('city')->groupBy('city')->where('status', $request->input('status'))->get();
        foreach ($cities as $city)
            $html.= '<option value="'.$city->city.'">'.$city->city.'</option>';
        return $html;
    }
    public function getAreaByCitySession(Request $request)
    {
        $html = '<option value="all">Select Area</option>';
        $areas = Session::select('area')->where('city', $request->input('city'))->whereNotNull('area')->groupBy('area')->where('status', $request->input('status'))->get();
        foreach ($areas as $area)
            $html.= '<option value="'.$area->area.'">'.$area->area.'</option>';
        return $html;
    }
}
