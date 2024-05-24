<?php

namespace Products\SearchArticleMassive\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SearchArticleMassivePolices
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('productos-buscar-articulos-masivo');
    }
}
