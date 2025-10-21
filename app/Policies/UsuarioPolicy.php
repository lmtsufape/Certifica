<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuarioPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Usuario $usuario)
    {
        //
    }

    /**
     * Só admins podem ver tokens de qualquer usuário.
     */
    public function viewTokens(User $authUser): bool
    {
        return $authUser->perfil_id === 1;
    }

    /**
     * Só admins podem criar tokens, e apenas para contas de serviço.
     */
    public function createToken(User $authUser, User $targetUser): bool
    {
        return $authUser->perfil_id === 1 && $targetUser->is_service_account;
    }

    /**
     * Só admins podem revogar tokens, e apenas de contas de serviço.
     */
    public function revokeToken(User $authUser, User $targetUser): bool
    {
        return $authUser->perfil_id === 1 && $targetUser->is_service_account;
    }
}
