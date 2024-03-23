<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Muhamad Ramdhani Akbar',
                'username' => 'ramdhaniakbar',
                'password' => bcrypt('admin@123'),
                'profile_image' => null,
                'role' => 'Admin',
            ],
            [
                'name' => 'Gonalu Kaler',
                'username' => 'gonalukaler',
                'password' => bcrypt('kaler@123'),
                'profile_image' => null,
                'role' => 'Manager',
            ],
            [
                'name' => 'Udin GG',
                'username' => 'udingg',
                'password' => bcrypt('udin@123'),
                'profile_image' => null,
                'role' => 'Kasir',
            ],
            [
                'name' => 'Eren Jaeger',
                'username' => 'erenjaeger',
                'password' => bcrypt('eren@123'),
                'profile_image' => null,
                'role' => 'Admin',
            ],
            [
                'name' => 'fjkladflka',
                'username' => 'mikasa',
                'password' => bcrypt('mikasa@123'),
                'profile_image' => null,
                'role' => 'Kasir',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
