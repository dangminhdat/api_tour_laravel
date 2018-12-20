<?php

use Illuminate\Database\Seeder;

class PersonOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('person_order')->insert([
            [
        		"name" 			=> "Đỗ Minh Ngọc",
        		"phone" 		=> "023-931-3213",
        		"email"			=> "tintuc.wp.96@gmail.com",
        		"address" 		=> "21 Hàn Thuyên, Hải Châu, Đà Nẵng",
                "note"          => "OK",
        		"pay" 			=> 0,
        		"num_adults" 	=> 10,
        		"num_childs" 	=> 10,
                "date_ordered"  => now(),
        		"status" 	    => 1,
        		"deleted_at" 	=> false,
        		"id_detail_tour"=> 1,
        		"id_user" 		=> 1
            ],
            [
                "name"          => "Trần Văn Hiếu",
                "phone"         => "023-381-3125",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "41 Lê Duẩn, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 1,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 2,
                "id_user"       => 1
            ],
            [
                "name"          => "Nguyễn Thị Na",
                "phone"         => "023-312-3124",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "12 Điện Biên Phủ, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 0,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 3,
                "id_user"       => 1
            ],
            [
                "name"          => "Nguyễn Kim Điền",
                "phone"         => "093-333-4124",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "76 Nguyễn Văn Linh, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 1,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 4,
                "id_user"       => 1
            ],
            [
                "name"          => "Triệu Nguyên",
                "phone"         => "0321-123-2312",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "41 Ngô Sĩ Liên, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 0,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 5,
                "id_user"       => 1
            ],
            [
                "name"          => "Huỳnh Ngọc",
                "phone"         => "012-3123-412",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "23 Nam Cao, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 1,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 6,
                "id_user"       => 1
            ],
            [
                "name"          => "Hồ Ngọc",
                "phone"         => "0123-231-2132",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "45 Lê Đình Lý, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 0,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 7,
                "id_user"       => 1
            ],
            [
                "name"          => "Võ Lâm",
                "phone"         => "0321-403-2312",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "67 Nguyễn Tất Thành, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 1,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 8,
                "id_user"       => 1
            ],
            [
                "name"          => "Triệu Linh",
                "phone"         => "0321-232-2312",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "41 Ngô Sĩ Liên, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 0,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 9,
                "id_user"       => 1
            ],

            [
                "name"          => "Triệu Nguyên",
                "phone"         => "0321-123-2312",
                "email"         => "tintuc.wp.96@gmail.com",
                "address"       => "41 Ngô Sĩ Liên, Đà Nẵng",
                "note"          => "OK",
                "pay"           => 1,
                "num_adults"    => 10,
                "num_childs"    => 10,
                "date_ordered"  => now(),
                "status"        => 1,
                "deleted_at"    => false,
                "id_detail_tour"=> 10,
                "id_user"       => 1
            ],
    	]);
    }
}
