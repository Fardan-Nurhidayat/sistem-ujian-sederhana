<?php

namespace Database\Seeders;

use App\Models\Siswa;
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
                'email' => 'teacher@gmail.com',
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

            if ($userData['role'] === 'student') {
                Siswa::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'nis' => '20260001',
                        'alamat' => 'Jl. Pendidikan No. 1',
                        'kelas' => 'X RPL 1',
                    ]
                );
            }
        }
    }
}
