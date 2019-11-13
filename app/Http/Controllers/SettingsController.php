<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings(){
        $settings = Setting::select("slug","value","label","group_name")->get();
        return view('admin.settings.get', compact('settings'));
    }

    public function saveSettings(Request $request){
        foreach ($request->except('_token') as $key => $value){
            Setting::where('slug', $key)->update(['value'=>$value]);
        }
        return redirect()->back()->with('success', 'Application Settings Updated Successfully!');
    }
}
