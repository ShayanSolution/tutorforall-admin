<?php

namespace App\Http\Controllers;

use App\Jobs\DebitCreditNotification;
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
        $userId = $request->user_id;
        if ($request->role == 'student'){
            $wallet->from_user_id = $userId;
            $by = "TOOTAR";
        } else {
            $wallet->to_user_id   = $userId;
            $by = "TOOTAR TEACHER";
        }
        if ($request->type == 'credit') {
            $message = "Your wallet has been credited with PKR ".$request->amount." by ".$by;
        } else {
            $message = "Your wallet has been debited with PKR ".$request->amount." by ".$by;
        }
        $wallet->notes = "(paid_amount : $request->amount) (admin_user : $adminUserName)";
        $wallet->added_by = $adminId;
        $wallet->admin_user_name = $adminUserName;
        $wallet->reason_from_admin = $request->reason_from_admin;
        $wallet->save();

        $job = new DebitCreditNotification($userId, $message);
        $this->dispatch($job);

        return redirect()->back()->with('success', 'Wallet Updated Successfully');
    }
}
