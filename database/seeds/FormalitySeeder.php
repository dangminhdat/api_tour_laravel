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
        	[ "name" => "Nhóm" ],
        	[ "name" => "Công ty" ]
        ]);
    }
}
