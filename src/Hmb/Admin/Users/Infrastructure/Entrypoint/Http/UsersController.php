<?php
namespace Admin\Users\Infrastructure\Entrypoint\Http;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Admin\Users\Infrastructure\Persistence\Mysql\MysqlInsertUser;
use Admin\Users\Application\Handler\UsersInsertHandler;
use Admin\Users\Domain\Service\UserInsertService;
use Admin\Users\Application\Handler\HandlerUserDelete;
use Admin\Users\Domain\Service\UserDeleteService;
use Admin\Users\Application\Handler\HandlerUserUpdate;
use Admin\Users\Domain\Service\UserUpdateService;
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
    public function createIndex(): Response
    {
        return Inertia::render('Hmb/Admin/Users/CreateUser');
    }

    public function insert(Request $request)
    {
        $data=[
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        return (new UsersInsertHandler(
            new UserInsertService(new MysqlInsertUser())
        ))->handle($data);
    }
    public function delete(Request $request)
    {
        return (new HandlerUserDelete(
            new UserDeleteService(new MysqlInsertUser())
        ))->handle( $request->input('id'));
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $rolesAssigned = [];
        foreach ($roles as $item) {
            $assigned=[
                'id' => $item->id,
                'name' => $item->name,
                'permissions' => $item->permissions->toArray(),
            ];
            $rolesAssigned[] = $assigned;
        }
        return Inertia::render('Hmb/Admin/Users/EditUser', [
            'user' => $user,
            'permissions' => Permission::all()->sortBy(['name'])->toArray(),
            'roles' => $rolesAssigned ?? []
        ]);
    }

    public function update(Request $request)
    {
        $data=[
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'permissions' => $request->input('permissions'),
            'roles' => $request->input('roles'),
        ];
        return (new HandlerUserUpdate(
            new UserUpdateService(new MysqlInsertUser())
        ))->handle($data);
    }
}
