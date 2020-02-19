<?php

namespace App\Jobs;

use App\Helpers\Push;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class AcceptDocumentNotification extends Job
{
    use Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user, $program, $subject, $type;
    public function __construct($user, $program, $subject, $type)
    {
        $this->user = $user;
        $this->program = $program;
        $this->subject = $subject;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->user);
        $program = $this->program;
        $subject = $this->subject;
        $type = $this->type;

        if(!empty($user->device_token)){

            $title  = Config::get('user-constants.APP_NAME');
            $body   = 'Your document against '.$program.'('.$subject.') has been '.$type.'.';
            $customData = array(
                'notification_type' => 'accept_document',
            );
            Push::handle($title, $body, $customData, $user);
        }
    }
}
