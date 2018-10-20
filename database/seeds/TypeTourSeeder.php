<?php

use Illuminate\Database\Seeder;

class TypeTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("type_tour")->insert([
        	[ "id" => 1, "name" => "Du lịch trong nước" ],
        	[ "id" => 2, "name" => "Du lịch nước ngoài" ]
        ]);
    }
}
