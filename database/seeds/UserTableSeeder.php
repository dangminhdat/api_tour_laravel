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
            'username'      => "admin",
            'password'      => bcrypt('123456'),
            'active'        => true,
            'deleted_at'    => false,
            'remember_token'=> str_random(50)
        ]);

        DB::table('user_detail')->insert([
            'fullname'      => "User 01",
            'email'         => "user02@gmail.com",
            'phone'         => "0123456789",
            'address'       => "Qnam",
            'deleted_at'    => false,
            'id_user'       => 1,
        ]);
    }
}
