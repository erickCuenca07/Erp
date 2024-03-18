<?php

namespace Admin\Permissions\Infrastructure\Entrypoint;

use RuntimeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionsController
{
    public function index(): Response
    {
        $permissionsGroup = Role::all()->toArray();
        foreach ($permissionsGroup as $index => $permissionGroup) {
            $permissionsGroup[$index]['permissions'] = Role::findById($permissionGroup['id'])->permissions()->pluck('name');
        }
        return Inertia::render('Hmb/Admin/Permissions/Index', [
            'permissionsGroup' => $permissionsGroup,
            'permissions' => Permission::all()->toArray(),
        ]);
    }
    public function editGroupRole(int $id): Response
    {
        $permissionsGroup = Role::findById($id);
        $permissionsGroup['permissions'] = Role::findById($id)->permissions()->get()->toArray();
        return Inertia::render('Hmb/Admin/Permissions/EditGroupRole', [
            'permissionsGroup' => $permissionsGroup,
            'permissions' => Permission::all()->sortBy(['name'])->toArray(),
        ]);
    }
    public function permissionCreate(Request $request): array
    {
        try {
            Permission::create([
                'name' => $request->get('name')
            ]);
        }catch (\Exception $e){
            throw new RuntimeException ($e->getMessage());
        }
        return ['success', 'Permiso creado correctamente.'];
    }
}
