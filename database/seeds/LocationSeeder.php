<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("location")->insert([
        	[ "name" => "Đà Nẵng", "image" => "uploads/da-nang.jpg" ],
        	[ "name" => "Nha Trang", "image" => "uploads/nha-trang.jpg" ],
        	[ "name" => "Hồ Chí Minh", "image" => "uploads/ho-chi-minh.jpg" ],
        	[ "name" => "Hà Nội", "image" => "uploads/ha-noi.jpg" ],
        	[ "name" => "Sa Pa", "image" => "uploads/sa-pa.jpg" ],
        	[ "name" => "Đà Lạt", "image" => "uploads/da-lat.jpg" ],
            [ "name" => "London", "image" => "uploads/london.jpg" ],
            [ "name" => "Amsterdam", "image" => "uploads/amsterdam.jpg" ],
            [ "name" => "Japan", "image" => "uploads/japan.jpg" ],
            [ "name" => "Italy", "image" => "uploads/italy.jpg" ],
            [ "name" => "Paris", "image" => "uploads/paris.jpg" ],
        ]);
    }
}
