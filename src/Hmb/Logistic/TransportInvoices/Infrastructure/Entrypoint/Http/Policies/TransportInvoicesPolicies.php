<?php

namespace Logistic\TransportInvoices\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class TransportInvoicesPolicies
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('logistica-ver-facturas-transporte');
    }
}
