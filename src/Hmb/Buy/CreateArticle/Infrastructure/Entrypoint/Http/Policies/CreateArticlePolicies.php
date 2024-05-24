<?php

namespace Buy\CreateArticle\Infrastructure\Entrypoint\Http\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreateArticlePolicies
{
    use HandlesAuthorization;
    public function view(User $user): bool
    {
        return $user->can('compras-crear-articulo');
    }
}
