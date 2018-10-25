<?php

use Illuminate\Database\Seeder;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i <= 10; $i++) { 
	        DB::table("guide")->insert([
	        	[
	        		"id" 		=> $i,
	        		"name" 		=> "Guide ".$i,
	        		"address" 	=> "Address ".$i,
	        		"phone" 	=> "Phone ".$i,
	        		"deleted_at"=> false
	        	],
	        ]);
	    }
    }
}
