<?php

use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
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
	        DB::table("hotel")->insert([
	        	[
	        		"name" 		=> "Hotel ".$i,
	        		"price_room"=> 100000,
	        		"address" 	=> "Address ".$i,
	        		"phone" 	=> "Phone ".$i,
	        		"website" 	=> "Website ".$i,
	        		"deleted_at"=> false
	        	],
	        ]);
	    }
    }
}
