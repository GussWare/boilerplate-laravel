<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    /**
     * Handle the User "retrieved" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function retrieved()
    {

    }

    /**
     * Handle the User "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->password = Hash::make($user->password);

        return $user;
    }
}
