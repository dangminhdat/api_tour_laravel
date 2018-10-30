<?php

use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("resource")->insert([
        	[ "name_table" 	=> "user" ],
        	[ "name_table" 	=> "tour" ],
        	[ "name_table" 	=> "hotel" ],
        	[ "name_table"	=> "guide" ],
        	[ "name_table"  => "review" ],
        	[ "name_table"  => "person_order" ],
        	[ "name_table"  => "review" ],
        	[ "name_table"  => "permission" ]
        ]);
    }
}
