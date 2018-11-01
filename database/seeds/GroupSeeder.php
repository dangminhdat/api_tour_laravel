<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("groups")->insert([
        	[ "name" => "ADMIN" ],
            [ "name" => "MOD" ],
        	[ "name" => "CUSTOMER" ],
        ]);
    }
}
