<?php

namespace Buy\Scandal\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class ScandalPolices
{
    public function view(User $user): bool
    {
        return $user->can('compras-crear-escandallo');
    }
}
