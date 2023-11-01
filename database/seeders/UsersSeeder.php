<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'employee_id' => '001',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '09 234342344',
                'address' => 'Yangon',
                'nrc' => '12/BBL(N)233432',
                'gender' => 'male',
                'birthday' => now(),
                'position_id' => 1,
                'dep_id' => 1,
                'pin_code' => '0001',
                'password' => bcrypt('password'),
                'remember_token' => null,
                'join_date' => now(),
                'pw_changed_date' => now(),
                'created_at' => now(),
            ],
            [
                'employee_id' => '002',
                'name' => 'Ken',
                'email' => 'ken@gmail.com',
                'phone' => '09 234321344',
                'address' => 'Yangon',
                'nrc' => '12/BBL(N)233732',
                'gender' => 'male',
                'birthday' => now(),
                'position_id' => 2,
                'dep_id' => 2,
                'pin_code' => '0002',
                'password' => bcrypt('password'),
                'remember_token' => null,
                'join_date' => now(),
                'pw_changed_date' => now(),
                'created_at' => now(),
            ],
            [
                'employee_id' => '003',
                'name' => 'John Doe',
                'email' => 'john@gmail.com',
                'phone' => '09 232321344',
                'address' => 'Yangon',
                'nrc' => '12/BBL(N)253732',
                'gender' => 'male',
                'birthday' => now(),
                'position_id' => 3,
                'dep_id' => 3,
                'pin_code' => '0003',
                'password' => bcrypt('password'),
                'remember_token' => null,
                'join_date' => now(),
                'pw_changed_date' => now(),
                'created_at' => now(),
            ],
        ];

        User::insert($users);
    }
}
