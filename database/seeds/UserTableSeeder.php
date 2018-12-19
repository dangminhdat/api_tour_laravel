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
        for($i = 1; $i < 4; $i++) {
            DB::table('users')->insert([
                'username'      => "admin".$i,
                'password'      => bcrypt('123456'),
                'active'        => true,
                'deleted_at'    => false,
                'remember_token'=> str_random(50)
            ]);

            DB::table('user_detail')->insert([
                'fullname'      => "User 0".$i,
                'email'         => "user0".$i."@gmail.com",
                'phone'         => "0123456789",
                'address'       => "Qnam",
                'deleted_at'    => false,
                'id_user'       => $i,
            ]);
        }
    }
}
