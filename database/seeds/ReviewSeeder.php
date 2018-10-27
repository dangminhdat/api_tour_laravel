<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1; $i <= 10 ; $i++) { 
        	 DB::table("review")->insert([
	        	[
	        		"score" => $i,
	        		"content" => "OK",
	        		"date_review" => now(),
	        		"id_tour" => ($i%2)?1:2,
                    "id_user" => 1
	        	]
	        ]);
        }
    }
}
