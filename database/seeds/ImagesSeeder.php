<?php

use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) { 
            DB::table('images')->insert([
                ["description" => "Tour ".$i, "url" => "/uploads/da-nang-2018-11-02.png", "id_tour" => $i],
                ["description" => "Tour ".$i, "url" => "/uploads/da-nang-2018-11-04.png", "id_tour" => $i]
            ]);
        }
    }
}
