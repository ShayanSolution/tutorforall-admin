<?php

namespace App\Jobs;

use App\Helpers\Push;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class MasterRejectNotification extends Job
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $userId, $rejectionReason;
    public function __construct($userId, $rejectionReason)
    {
        $this->userId = $userId;
        $this->rejectionReason = $rejectionReason;
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
            $body   = $this->rejectionReason;
            $customData = array(
                'notification_type' => 'master_reject',
            );
            Push::handle($title, $body, $customData, $user);
        }
    }
}
