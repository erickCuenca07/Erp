<?php

namespace Suppliers\ListCreditors\Infrastructure\Entrypoint\Http\Polices;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class PolicesListCreditors
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can('proveedores-ver-lista-acreedores');
    }
}
