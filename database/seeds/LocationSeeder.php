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
        	[ "id" => 1, "name" => "Đà Nẵng", "image" => "place1.jpg" ],
        	[ "id" => 2, "name" => "Nha Trang", "image" => "place2.jpg" ],
        	[ "id" => 3, "name" => "Hồ Chí Minh", "image" => "place3.jpg" ],
        	[ "id" => 4, "name" => "Hà Nội", "image" => "place4.jpg" ],
        	[ "id" => 5, "name" => "Sa Pa", "image" => "place5.jpg" ],
        	[ "id" => 6, "name" => "Đà Lạt", "image" => "place6.jpg" ],
        	[ "id" => 7, "name" => "Hội An", "image" => "place7.jpg" ],
        ]);
    }
}
