<?php
namespace Admin\Users\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController
{
    public function index(): Response
    {
        $users = User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'permissions' => $user->permissions,
                'roles' => $user->roles,
                'created_at' => $user->created_at->format('d-m-Y | H:i:s'),
            ];
        });
        return Inertia::render('Hmb/Admin/Users/Index', [
            'users' => $users
        ]);
    }
}
