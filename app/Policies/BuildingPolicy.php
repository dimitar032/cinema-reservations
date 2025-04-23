<?php

namespace App\Policies;

use App\Building;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, Building $building)
    {
        return $user->id === $building->user_id;
    }
}
