<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class createUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $references = [
            [
                'name'	=> "admin",
                'email'	=> "admin@gmail.com",
                'role' => 'admin',
                'password'	=> bcrypt('secret')
            ],
            [
                'name'	=> "employee",
                'email'	=> "employee@gmail.com",
                'role' => 'employee',
                'password'	=> bcrypt('secret')
            ]
        ];

        \DB::table('users')->insert($references);
    }
}
