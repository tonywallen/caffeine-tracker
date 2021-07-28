<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Add the master administrator, user id of 1
        $users = [
            [
                'user_name' => 'john_tester',
                'email' => 'john@test.com',
                'password' =>app('hash')->make('1234')
            ],
            [
                'user_name' => 'sara_tester',
                'email' => 'sara@test.com',
                'password' => app('hash')->make('1234')
            ],
        ];

        DB::table('users')->insert($users);
    }
}
