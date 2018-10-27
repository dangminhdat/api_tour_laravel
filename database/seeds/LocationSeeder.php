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
        	[ "name" => "Đà Nẵng", "image" => "place1.jpg" ],
        	[ "name" => "Nha Trang", "image" => "place2.jpg" ],
        	[ "name" => "Hồ Chí Minh", "image" => "place3.jpg" ],
        	[ "name" => "Hà Nội", "image" => "place4.jpg" ],
        	[ "name" => "Sa Pa", "image" => "place5.jpg" ],
        	[ "name" => "Đà Lạt", "image" => "place6.jpg" ],
        	[ "name" => "Hội An", "image" => "place7.jpg" ],
        ]);
    }
}
