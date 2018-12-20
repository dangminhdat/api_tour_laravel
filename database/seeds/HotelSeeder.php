<?php

use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("hotel")->insert([
        	[
        		"name" 		=> "Hyatt Regency Danang Resort and Spa",
        		"price_room"=> 100000,
        		"address" 	=> "Đường Trường sa, phường Hòa Hải, quận Ngũ Hành Sơn",
        		"phone" 	=> "0511-3891234",
        		"website" 	=> "www.danang.regency.hyatt.com",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn Mercure Danang",
        		"price_room"=> 100000,
        		"address" 	=> "Lô A1 - Khu biệt thự Đảo xanh Đà Nẵng",
        		"phone" 	=> "0511.3797777",
        		"website" 	=> "http://www.mercure-danang.com",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn Daesco",
        		"price_room"=> 100000,
        		"address" 	=> "155 Trần Phú, Quận Hải Châu, Thành phố Đà Nẵng",
        		"phone" 	=> "0511 892988",
        		"website" 	=> "www.daescohotel.com.vn ",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Red Beach Resort & Spa - Khu du lịch Xuân Thiều",
        		"price_room"=> 100000,
        		"address" 	=> "Đường Nguyễn Tất Thành, Phường Hoà Hiệp Nam, Quận Liên Chiểu, Thành phố Đà Nẵng",
        		"phone" 	=> "0511. 3842.767",
        		"website" 	=> "www.xuantrieu.com.vn",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn Mộc Lan",
        		"price_room"=> 100000,
        		"address" 	=> "06 Lê Lợi , Thành phố Đà Nẵng",
        		"phone" 	=> "0511 3849501",
        		"website" 	=> "www.moclan.com.vn",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Silversea",
        		"price_room"=> 100000,
        		"address" 	=> "Biển Mỹ Khê, đường Sơn Trà Điện Ngọc, Quận Ngũ Hành Sơn–Đà Nẵng",
        		"phone" 	=> "0511 3848663",
        		"website" 	=> "www.silversea.com",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn Galaxy",
        		"price_room"=> 100000,
        		"address" 	=> "95 Hồ Xuân Hương, Đà Nẵng",
        		"phone" 	=> "0511 3848848",
        		"website" 	=> "http://galaxyhotel.vn",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn Ngọc Minh",
        		"price_room"=> 100000,
        		"address" 	=> "Lô 9, 10B2.3KTĐC Thanh Lộc Đán",
        		"phone" 	=> "0511.3760.776",
        		"website" 	=> "danangngocminhhotelplaza.com",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn Như Phương",
        		"price_room"=> 100000,
        		"address" 	=> "Tổ 41 Phường Hòa Hải ",
        		"phone" 	=> "0511.3847.439",
        		"website" 	=> "http://nhuphuong.vn",
        		"deleted_at"=> false
        	],
        	[
        		"name" 		=> "Khách sạn The Moon",
        		"price_room"=> 100000,
        		"address" 	=> "19 Nguyễn Tất Thành",
        		"phone" 	=> "0511.3760.776",
        		"website" 	=> "www.themoonhotel.com",
        		"deleted_at"=> false
        	],
        ]);
    }
}
