<?php

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
        //
        DB::table('users')->insert([
            'username' => "admin",
            'password' => bcrypt('123456'),
            'active' => true,
            'remember_token' => str_random(50)
        ]);
    }
}
