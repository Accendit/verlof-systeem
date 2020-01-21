<?php

namespace App\Policies;

use App\Absence;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsencePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any absences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the absence.
     *
     * @param  \App\User  $user
     * @param  \App\Absence  $absence
     * @return mixed
     */
    public function view(User $user, Absence $absence)
    {
        // TODO: change to identical operator (===) but submitter is of type string
        return ($user->isManager() or $absence->submitter == $user->id);
    }

    /**
     * Determine whether the user can create absences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the absence.
     *
     * @param  \App\User  $user
     * @param  \App\Absence  $absence
     * @return mixed
     */
    public function update(User $user, Absence $absence)
    {
        //
        return ($absence->submitter == $user->id and $absence->isapproved === null);
    }

    /**
     * Determine whether the user can delete the absence.
     *
     * @param  \App\User  $user
     * @param  \App\Absence  $absence
     * @return mixed
     */
    public function delete(User $user, Absence $absence)
    {
        //
        return $user->isManager();
    }

    /**
     * Determine whether the user can restore the absence.
     *
     * @param  \App\User  $user
     * @param  \App\Absence  $absence
     * @return mixed
     */
    public function restore(User $user, Absence $absence)
    {
        //
        return $user->isManager();
    }

    /**
     * Determine whether the user can permanently delete the absence.
     *
     * @param  \App\User  $user
     * @param  \App\Absence  $absence
     * @return mixed
     */
    public function forceDelete(User $user, Absence $absence)
    {
        //
        return $user->isManager();
    }

    /**
     * Determine whether the user can approve the absence.
     * 
     * @param \App\User $user
     * 
     * @return boolean
     */
    public function approve(User $user, Absence $absence)
    {
        return $user->isManager() and !$absence->isapproved;
    }
}
