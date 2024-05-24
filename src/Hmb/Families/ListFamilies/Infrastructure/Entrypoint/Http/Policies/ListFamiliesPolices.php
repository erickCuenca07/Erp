<?php

namespace Families\ListFamilies\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class ListFamiliesPolices
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('familias-ver-lista-familias');
    }
}
