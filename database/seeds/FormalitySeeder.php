<?php

use Illuminate\Database\Seeder;

class FormalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("formality")->insert([
        	[ "id" => 1, "name" => "Nhóm" ],
        	[ "id" => 2, "name" => "Công ty" ]
        ]);
    }
}
