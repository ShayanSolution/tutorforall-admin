<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use App\Models\User;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public $tootarTeacherUserRoleId = 2;
    public $tootarUserRoleId = 3;

    public function getTootarTC(Request $request){
        $termCond = CMS::where('user_role_id', $this->tootarUserRoleId)->first();
        return view('admin.cms.tootar', compact('termCond'));
    }

    public function postTootarTC(Request $request){
        $termCond = CMS::where('user_role_id', $this->tootarUserRoleId)->first();
        $termCond->update([
           'content' => $request->contentText
        ]);
        return redirect()->back()->with('success', 'Terms & Conditions Updated Successfully!');
    }

    public function getTootarTeacherTC(Request $request){
        $termCond = CMS::where('user_role_id', $this->tootarTeacherUserRoleId)->first();
        return view('admin.cms.tootarTeacher', compact('termCond'));
    }

    public function postTootarTeacherTC(Request $request){
        $termCond = CMS::where('user_role_id', $this->tootarTeacherUserRoleId)->first();
        $termCond->update([
            'content' => $request->contentText
        ]);
        return redirect()->back()->with('success', 'Terms & Conditions Updated Successfully!');
    }

    public function resetTC(Request $request){
        $userRoleId = $request->id;
        $userUpdate = User::where('role_id', $userRoleId)->update([
            'term_and_condition' => 0
        ]);
        if ($userUpdate) {
            $data = 'success';
            return response()->json($data);
        } else {
            $data = 'error';
            return response()->json($data);
        }
    }
}
