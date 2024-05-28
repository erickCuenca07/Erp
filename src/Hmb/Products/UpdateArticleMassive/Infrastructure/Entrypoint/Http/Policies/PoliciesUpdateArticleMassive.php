<?php

namespace Products\UpdateArticleMassive\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoliciesUpdateArticleMassive
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('productos-actualizar-articulos-masivo');
    }
}
