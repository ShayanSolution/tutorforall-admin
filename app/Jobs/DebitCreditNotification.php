<?php

namespace App\Jobs;

use App\Helpers\Push;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class DebitCreditNotification extends Job
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $userId, $message;
    public function __construct($userId, $message)
    {
        $this->userId = $userId;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->userId);

        if(!empty($user->device_token)){
            $title  = Config::get('user-constants.APP_NAME');
            $body   = $this->message;
            $customData = array(
                'notification_type' => 'debit_credit_wallet',
            );
            Push::handle($title, $body, $customData, $user);
        }
    }
}
