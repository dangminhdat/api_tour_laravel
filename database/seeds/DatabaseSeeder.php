<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(TypeTourSeeder::class);
        $this->call(FormalitySeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(GuideSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(TourSeeder::class);
        $this->call(LocationTourSeeder::class);
        $this->call(HotelTourSeeder::class);
    }
}
