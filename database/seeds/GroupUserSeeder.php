<?php

use Illuminate\Database\Seeder;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("group_user")->insert([
            [ "id_user" => 1, "id_group" => 1],
            [ "id_user" => 2, "id_group" => 2],
        	[ "id_user" => 3, "id_group" => 3]
        ]);
    }
}
