<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@gmaiil.com',
                'role' => 'teacher',
            ],
            [
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'role' => 'student',
            ],
        ];

        foreach ($users as $userData) {
            Role::firstOrCreate([
                'name' => $userData['role'],
                'guard_name' => 'web',
            ]);

            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('12345678'),
                ]
            );

            $user->syncRoles([$userData['role']]);
        }
    }
}
