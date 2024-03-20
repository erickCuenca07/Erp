<?php
namespace Suppliers\ListSuppliers\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class PolicesListSuppliers
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can('proveedores-ver-lista-proveedores');
    }
}
