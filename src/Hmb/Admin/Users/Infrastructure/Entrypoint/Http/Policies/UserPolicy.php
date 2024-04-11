<?php

namespace Admin\Users\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('admin-ver usuarios');
    }
}
