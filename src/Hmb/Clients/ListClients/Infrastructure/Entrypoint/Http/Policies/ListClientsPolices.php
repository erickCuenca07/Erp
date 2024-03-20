<?php
namespace Clients\ListClients\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListClientsPolices
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can('clientes-ver clientes');
    }
}
