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
                    "images"      => "/images/tour".$i.".png",
                    "programs"    => "OK",
                    "note"        => "OK",
                    "deleted_at"  => false,
                    "id_type_tour"  => ($i%2)?1:2
                ],
            ]);

            for ($j=1; $j <= 3 ; $j++) { 
            
                DB::table("detail_tour")->insert([
                    [
                        "date_depart"   => "2018-12-1",
                        "price_adults"  => 100000,
                        "price_childs"  => 100000,
                        "time_depart"   => '12:00',
                        "address_depart"=> "OK",
                        "slot"          => 10,
                        "booked"        => $i,
                        "deleted_at"    => false,
                        "id_guide"      => $j,
                        "id_tour"       => $i,
                    ],
                ]);
            }
        }
    }
}
