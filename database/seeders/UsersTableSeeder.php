<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'name1',
            'email' => 'name1@test.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'name2',
            'email' => 'name2@test.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'name3',
            'email' => 'name3@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
