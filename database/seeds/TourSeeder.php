<?php

use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) { 
            DB::table("tour")->insert([
                [
                    "name"        => "Tour ĐÀ NẴNG - NHA TRANG - ".$i,
                    "number_days" => $i,
                    "date_created"=> now(),
                    "item_tour"   => "OK",
                    "discount"    => $i,
                    "booked"      => $i,
                    "images"      => "/images/tour".$i.".png",
                    "programs"    => "OK",
                    "note"        => "OK",
                    "deleted_at"  => false,
                    "id_type_tour"  => ($i%2)?1:2
                ],
            ]);

            DB::table("detail_tour")->insert([
                [
                    "date_depart"   => "2018-12-".$i." 12:00",
                    "price_adults"  => 100000,
                    "price_childs"  => 100000,
                    "time_depart"   => '12:00',
                    "address_depart"=> "OK",
                    "slot"          => 10,
                    "deleted_at"    => false,
                    "id_image"      => 1,
                    "id_guide"      => $i,
                    "id_hotel"      => $i,
                    "id_tour"       => $i,
                ],
            ]);
        }
    }
}
