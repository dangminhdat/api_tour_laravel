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
        	[ "id" => 1, "name" => "Đà Nẵng" ],
        	[ "id" => 2, "name" => "Nha Trang" ],
        	[ "id" => 3, "name" => "Hồ Chí Minh" ],
        	[ "id" => 4, "name" => "Hà Nội" ],
        	[ "id" => 5, "name" => "Sa Pa" ],
        	[ "id" => 6, "name" => "Đà Lạt" ],
        	[ "id" => 7, "name" => "Hội An" ],
        ]);
    }
}
