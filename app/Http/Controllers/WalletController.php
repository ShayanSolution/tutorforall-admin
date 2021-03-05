<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function financialAspects(Request $request) {

        $admin = Auth::user();
        $adminUserName = $admin->username;
        $adminId = $admin->id;
        $wallet = new Wallet();
        $wallet->amount = $request->amount;
        $wallet->type = $request->type;
        if ($request->role == 'student'){
            $wallet->from_user_id = $request->user_id;
        } else {
            $wallet->to_user_id   = $request->user_id;
        }
        $wallet->notes = "(paid_amount : $request->amount) (admin_user : $adminUserName)";
        $wallet->added_by = $adminId;
        $wallet->admin_user_name = $adminUserName;
        $wallet->reason_from_admin = $request->reason_from_admin;
        $wallet->save();

        return redirect()->back()->with('success', 'Wallet Updated Successfully');
    }
}
