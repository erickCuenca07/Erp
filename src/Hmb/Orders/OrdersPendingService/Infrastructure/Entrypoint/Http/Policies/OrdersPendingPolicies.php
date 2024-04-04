<?php

namespace Orders\OrdersPendingService\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class OrdersPendingPolicies
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('pedidos-ver-pedidos-pendientes');
    }
}
