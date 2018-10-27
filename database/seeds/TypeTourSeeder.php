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
        	[ "name" => "Du lịch trong nước" ],
        	[ "name" => "Du lịch nước ngoài" ]
        ]);
    }
}
