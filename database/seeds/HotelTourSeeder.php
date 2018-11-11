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
        for ($i=1; $i <= 20 ; $i++) { 
            DB::table("hotel_tour")->insert([
                [ "id_detail_tour" => $i, "id_hotel" => 1 ],
                [ "id_detail_tour" => $i, "id_hotel" => 2 ],
            ]);
        }
    }
}
