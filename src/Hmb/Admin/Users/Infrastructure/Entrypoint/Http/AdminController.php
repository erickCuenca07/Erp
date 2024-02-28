<?php
namespace Admin\Users\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;

class AdminController
{
    public function index(): Response
    {
        $users = User::all();
        return Inertia::render('Hmb/Admin/Users/Index', [
            'users' => $users
        ]);
    }
}