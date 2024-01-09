<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::insert([
           [
               'name' => 'admin',
               'email' => 'admin@gmail.com',
               'password' => bcrypt('12345678'),
               'role' => 'admin',
           ],
            [
                'name' => 'test order',
                'email' => 'testorder@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'order',
            ],
            [
                'name' => 'test developer',
                'email' => 'testdeveloper@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'developer',
            ],
            [
                'name' => 'test sales',
                'email' => 'testsales@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'sales',
            ],
            [
                'name' => 'test customer',
                'email' => 'testcustomer@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'customer',
            ]
        ]);
    }
}
