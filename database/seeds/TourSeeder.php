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
                    "id"          => $i,
                    "name"        => "Tour ĐÀ NẴNG - NHA TRANG - ".$i,
                    "number_days" => $i,
                    "date_created"=> now(),
                    "item_tour"   => "OK",
                    "discount"    => $i."00",
                    "images"      => "/images/tour".$i.".png",
                    "programs"    => "OK",
                    "note"        => "OK",
                    "deleted_at"  => false,
                    "id_type_tour"=> ($i%2)?1:2
                ],
            ]);
        }
    }
}
