<?php

namespace Admin\Permissions\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class PermissionsPolicy
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can('admin-ver permisos');
    }
}
