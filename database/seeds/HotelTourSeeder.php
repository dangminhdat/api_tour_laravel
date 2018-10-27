<?php

use Illuminate\Database\Seeder;

class HotelTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("hotel_tour")->insert([
        	[ "id_detail_tour" => 1, "id_hotel" => 1 ],
        	[ "id_detail_tour" => 1, "id_hotel" => 2 ],
        	[ "id_detail_tour" => 2, "id_hotel" => 1 ],
        	[ "id_detail_tour" => 2, "id_hotel" => 2 ],
        ]);
    }
}
