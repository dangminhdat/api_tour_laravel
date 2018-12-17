<?php

use Illuminate\Database\Seeder;

class PersonOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i <= 10; $i++) { 
        	DB::table('person_order')->insert([
        		"name" 			=> "Order ".$i,
        		"phone" 		=> "09999999".$i,
        		"email"			=> "dangminhdat@gmail.com",
        		"address" 		=> "Address ".$i,
        		"note" 			=> "OK".$i,
        		"num_adults" 	=> $i,
        		"num_childs" 	=> $i,
                "date_ordered"  => now(),
        		"status" 	=> 1,
        		"deleted_at" 	=> false,
        		"id_detail_tour"=> $i,
        		"id_user" 		=> 1
        	]);
        }
    }
}
