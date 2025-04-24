<?php

namespace App\Policies;

use App\Models\Progresion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProgresionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Admin') || $user->hasRole('Docente');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Progresion $progresion): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Admin') || $user->hasRole('Docente');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Docente');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Progresion $progresion): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Docente');    
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Progresion $progresion): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Docente');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Progresion $progresion): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Admin') || $user->hasRole('Docente');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Progresion $progresion): bool
    {
        return $user->hasRole('Super Admin') || $user->hasRole('Docente');
    }
}
