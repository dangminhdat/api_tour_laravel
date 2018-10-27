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
        	[ "id_detail_tour" => 1, "id_location" => 1 ],
        	[ "id_detail_tour" => 2, "id_location" => 1 ],
        	[ "id_detail_tour" => 3, "id_location" => 1 ],
            [ "id_detail_tour" => 4, "id_location" => 1 ],
            [ "id_detail_tour" => 1, "id_location" => 2 ],
        	[ "id_detail_tour" => 2, "id_location" => 2 ],
        ]);
    }
}
