<?php

namespace App\Jobs;

use App\Helpers\Push;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class SendNotificationFromAdminPanel extends Job
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user, $title, $message;
    public function __construct($user, $title, $message)
    {
        $this->user = $user;
        $this->program = $title;
        $this->subject = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->user);
        $title = $this->title;
        $message = $this->message;

        if(!empty($user->device_token)){
            $title  = $title;
            $body   = $message;
            $customData = array(
                'notification_type' => 'accept_document',
            );
            Push::handle($title, $body, $customData, $user);
        }
    }
}
