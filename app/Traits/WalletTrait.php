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

    public function wallet($id) {
        $debit      = Wallet::where('type', 'debit')
            ->where(function ($query) use ($id) {
                $query->where('from_user_id', '=', $id)
                    ->orWhere('to_user_id', '=', $id);
            })->sum('amount');

        $credit = Wallet::where('type', 'credit')
            ->where(function ($query) use ($id) {
                $query->where('from_user_id', '=', $id)
                    ->orWhere('to_user_id', '=', $id);
            })->sum('amount');

        if ($credit >= 0 && $debit >= 0) {
            $totalAmount = $credit - $debit;
            return (string)$totalAmount;
        } else {
            return (string)0;
        }
    }

}
?>
