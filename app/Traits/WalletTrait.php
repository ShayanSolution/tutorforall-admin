<?php
namespace App\Traits;
use App\Models\Wallet;
use Cassandra\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Session;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

trait WalletTrait {

    public function wallet($id, $role) {
        if ($role == 'student'){
            $studentId = $id;
            list($debit, $credit) = $this->studentWallet($studentId);

        } else {
            $tutorId = $id;
            list($debit, $credit) = $this->tutorWallet($tutorId);
        }

        if ($credit >= 0 && $debit >= 0) {
            $totalAmount = $credit - $debit;
            return $totalAmount;
        } else {
            return 0;
        }

    }

    public function studentWallet($studentId) {
        $debit      = Wallet::where('type', 'debit')
            ->where(function ($query) use ($studentId) {
                $query->where('from_user_id', '=', $studentId)
                    ->orWhere('to_user_id', '=', $studentId);
            })->sum('amount');

        $credit = Wallet::where('type', 'credit')
            ->where(function ($query) use ($studentId) {
                $query->where('from_user_id', '=', $studentId)
                    ->orWhere('to_user_id', '=', $studentId);
            })->sum('amount');

        return [$debit, $credit];
    }

    public function tutorWallet($tutorId) {
        $debit      = Wallet::where('type', 'debit')
            ->where(function ($query) use ($tutorId) {
                $query->Where('to_user_id', '=', $tutorId)
                    ->whereNotNull('added_by');
            })->sum('amount');

        $credit = Wallet::where('type', 'credit')
            ->where(function ($query) use ($tutorId) {
                $query->Where('to_user_id', '=', $tutorId)
                    ->whereNotNull('added_by');
            })->sum('amount');

        return [$debit, $credit];
    }

}
?>
