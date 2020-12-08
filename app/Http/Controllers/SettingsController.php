<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings(){
        $settings = Setting::select("slug","value","label","group_name","after_value")->get();
        $newSettingsArray = [];
        foreach ($settings as $setting) {
            $newKey = ucwords(str_replace('-', ' ', $setting->group_name));
            if(!key_exists($newKey, $newSettingsArray))
                $newSettingsArray[$newKey] = [];
            array_push($newSettingsArray[$newKey], $setting) ;
        }
        return view('admin.settings.get', compact('newSettingsArray'));
    }

    public function saveSettings(Request $request){
        foreach ($request->except('_token') as $key => $value) {
            $setting = Setting::where('slug', $key)->first();
            if($setting->value != $value){
                $setting->update(['value'=>$value]);
            }
        }
        return redirect()->back()->with('success', 'Application Settings Updated Successfully!');
    }
}
