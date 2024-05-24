<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                //Grupo de permisos
                $superAdminRole = Role::create(['name' => 'SuperAdmin']);
                $admin = Role::create(['name' => 'Admin']);
                //user superadmin
                $superAdmin = User::create([
                    'name' => 'SuperAdmin',
                    'email' => 'superadmin@homebed.com',
                    'password' => Hash::make('superadmin@'),
                ]);
                $superAdmin->assignRole($superAdminRole);
                /*** PERMISOS ***/
                $adminSeeUsers = Permission::create(['name' => 'admin-ver usuarios']);
                $adminEditUsers = Permission::create(['name' => 'admin-editar usuarios']);
                $adminSeePermission = Permission::create(['name' => 'admin-ver permisos']);
                $adminEditPermission = Permission::create(['name' => 'admin-editar permisos']);

                $admin->syncPermissions($adminSeeUsers);
                $admin->syncPermissions($adminEditUsers);
                $admin->syncPermissions($adminSeePermission);
                $admin->syncPermissions($adminEditPermission);
    }
}
