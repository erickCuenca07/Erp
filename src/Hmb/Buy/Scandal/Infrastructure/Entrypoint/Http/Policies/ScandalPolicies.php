<?php

namespace Buy\Scandal\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class ScandalPolicies
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can('escandallo-crear-escandallo');
    }
}
