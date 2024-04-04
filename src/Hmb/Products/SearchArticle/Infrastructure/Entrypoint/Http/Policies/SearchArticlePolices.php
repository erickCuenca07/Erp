<?php

namespace Products\SearchArticle\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class SearchArticlePolices
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('productos-buscar-articulo');
    }
}
