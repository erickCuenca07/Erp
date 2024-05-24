<?php
namespace Products\HistoryListProducts\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class HistoryListProductsPolices
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('productos-ver-hitorial-productos');
    }
}
