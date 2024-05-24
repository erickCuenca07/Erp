<?php

namespace Admin\Users\Infrastructure\Persistence\Mysql;
use Admin\Users\Domain\Model\UserInsertRepository;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Illuminate\Support\Facades\DB;
use Shared\Domain\Service\CarbonEurope;

class MysqlInsertUser implements UserInsertRepository
{
    private string $connection='mysql';
    private string $table='users';

    public function search($data): array
    {
        $carbon = new CarbonEurope();
        $user=[
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_at' => $carbon->now(),
            'updated_at' => $carbon->now(),
        ];
        try {
             $insert = DB::connection($this->connection)->table($this->table)->insert($user);
             if (!$insert) {
                 return ['No se puedo crear el usuario', 'error'];
             }
            return ['Usuario creado correctamente', 'success'];
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    public function delete($id): mixed
    {
        try {
            $delete = DB::connection($this->connection)->table($this->table)->where('id', $id)->delete();
            if (!$delete) {
                return ['No se puedo borrar el usuario', 'error'];
            }
            return ['Usuario borrado correctamente', 'success'];
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    public function update($data): mixed
    {
        $carbon = new CarbonEurope();
        $user = User::find($data['id']);
        $dataUpdate = [
            'name' => $data['name'],
            'email' => $data['email'],
            'updated_at' => $carbon->now(),
        ];
        try {
            $update = DB::connection($this->connection)->table($this->table)->where('id', $data['id'])->update($dataUpdate);
            if (!$update) {
                return ['No se puedo actualizar el usuario', 'error'];
            }
            $user->syncPermissions($data['permissions']);
            $user->syncRoles($data['roles']);
            return ['Usuario actualizado correctamente', 'success'];
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
