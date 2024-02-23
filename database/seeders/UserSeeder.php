<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = new User();
        $adminUser->name = 'Erick';
        $adminUser->email = 'homebeedspain@gmail.com';
        $adminUser->password = Hash::make('super2024@');
        $adminUser->save();

        $adminUser->assignRole('admin');
    }
}
