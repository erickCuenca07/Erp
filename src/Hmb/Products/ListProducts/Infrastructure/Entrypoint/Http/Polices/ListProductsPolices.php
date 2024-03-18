<?php
namespace Products\ListProducts\Infrastructure\Entrypoint\Http\Polices;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class ListProductsPolices
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('productos-ver-lista-productos');
    }
}
