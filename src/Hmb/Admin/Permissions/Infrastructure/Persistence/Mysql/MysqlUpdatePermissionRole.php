<?php

namespace Admin\Permissions\Infrastructure\Persistence\Mysql;

use Admin\Permissions\Domain\Model\UpdatePermissionsRole;
use Exception;
use Spatie\Permission\Models\Role;
use RuntimeException;

class MysqlUpdatePermissionRole implements UpdatePermissionsRole
{
    public function search($data): array
    {
        $role = Role::find($data['id']);
        try {
            $role->update(['name' => $data['name']]);
            $role->syncPermissions($data['permission']);
            return ['Rol actualizado correctamente', 'success'];
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

}
