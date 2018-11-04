<?php

use Illuminate\Database\Seeder;

class LocationTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("location_tour")->insert([
        	[ "id_tour" => 1, "id_location" => 1 ],
        	[ "id_tour" => 2, "id_location" => 1 ],
        	[ "id_tour" => 3, "id_location" => 1 ],
            [ "id_tour" => 4, "id_location" => 1 ],
            [ "id_tour" => 1, "id_location" => 2 ],
        	[ "id_tour" => 2, "id_location" => 2 ],
        ]);
    }
}
