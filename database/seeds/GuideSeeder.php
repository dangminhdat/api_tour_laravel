<?php

use Illuminate\Database\Seeder;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("guide")->insert([
        	[
        		"name" 		=> "Đỗ Ngọc Minh",
        		"address" 	=> "12 Hàn Thuyên, Hải Châu, Đà Nẵng",
        		"phone" 	=> "023-654-6564",
        		"deleted_at"=> false
        	],
            [
                "name"      => "Lưu Ngọc Lan",
                "address"   => "K865 Tôn Đức Thắng, Liên Chiểu, Đà Nẵng",
                "phone"     => "023-345-4334",
                "deleted_at"=> false
            ],
            [
                "name"      => "Trân Hồng Ánh",
                "address"   => "678 Sơn Trà, An Hải Bắc, Đà Nẵng",
                "phone"     => "045-353-4547",
                "deleted_at"=> false
            ],
            [
                "name"      => "Lê Ngọc Sang",
                "address"   => "12 Cao Thắng, Thạnh Thành, Quy Nhơn",
                "phone"     => "078-978-5654",
                "deleted_at"=> false
            ],
            [
                "name"      => "Trần Quý Anh",
                "address"   => "89 Lê Đại Hành, Sầm Sơn, Hà Nội",
                "phone"     => "089-564-7565",
                "deleted_at"=> false
            ],
            [
                "name"      => "Nguyễn Tất Đạt",
                "address"   => "34 Lý Thái Tổ, Hòa Cầm, Đà Nẵng",
                "phone"     => "089-676-8778",
                "deleted_at"=> false
            ],
            [
                "name"      => "Nguyễn Phước Nguyên",
                "address"   => "Tân Bình Thạnh, Quận 4, HCM",
                "phone"     => "023-435-3432",
                "deleted_at"=> false
            ],
            [
                "name"      => "Đỗ Như Trọng",
                "address"   => "Tổ 4, An Hải Tây, Quận 1, HCM",
                "phone"     => "056-565-6565",
                "deleted_at"=> false
            ],
            [
                "name"      => "Hà Như Ngọc",
                "address"   => "Ngô Quyền, Sơn Trà, Đà Nẵng",
                "phone"     => "087-878-6878",
                "deleted_at"=> false
            ],
            [
                "name"      => "Hà Văn Ngo",
                "address"   => "Sơn Trà, Đà Nẵng",
                "phone"     => "093-212-3122",
                "deleted_at"=> false
            ],
        ]);
    }
}
