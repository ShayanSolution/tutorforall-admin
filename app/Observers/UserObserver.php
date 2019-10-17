<?php

namespace App\Observers;

use App\Models\PhoneCode;
use App\Models\Profile;
use App\Models\Session;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }


    /**
     * Handle the user "deleting" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        if($user->role_id == 3)
            $this->deletingStudentRelatingRecords($user);
        else
            $this->deletingTutorRelatingRecords($user);

        $phone = $user->phone;

        $phoneWithoutCode = substr($phone,-10);

        PhoneCode::where('phone', 'like', '%'.$phoneWithoutCode)->delete();

        Profile::where('user_id', $user->id)->forceDelete();
    }

    private function deletingStudentRelatingRecords($user){
        Session::where('student_id', $user->id)->delete();
    }

    private function deletingTutorRelatingRecords($user){
        Session::where('tutor_id', $user->id)->delete();
    }

}
