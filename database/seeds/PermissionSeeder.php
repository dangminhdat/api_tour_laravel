<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("permission")->insert([
        	[
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => true,
                "is_delete"     => true,
                "id_group"      => 1,
                "id_resource"   => 1,
            ],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => true,
                "is_delete"     => true,
                "id_group"      => 1,
                "id_resource"   => 2,
            ],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => true,
                "is_delete"     => true,
                "id_group"      => 1,
                "id_resource"   => 3,
            ],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => true,
                "is_delete"     => true,
                "id_group"      => 1,
                "id_resource"   => 4,
            ],
            [
        		"is_create"		=> true,
        		"is_view"		=> true,
        		"is_update"		=> true,
        		"is_delete"		=> true,
        		"id_group"		=> 1,
        		"id_resource"	=> 5,
        	],
        	[
        		"is_create"		=> true,
        		"is_view"		=> true,
        		"is_update"		=> true,
        		"is_delete"		=> true,
        		"id_group"		=> 1,
        		"id_resource"	=> 6,
        	],
        	[
        		"is_create"		=> true,
        		"is_view"		=> true,
        		"is_update"		=> true,
        		"is_delete"		=> true,
        		"id_group"		=> 1,
        		"id_resource"	=> 7,
        	],
        	[
        		"is_create"		=> false,
        		"is_view"		=> true,
        		"is_update"		=> false,
        		"is_delete"		=> false,
        		"id_group"		=> 2,
        		"id_resource"	=> 1,
        	],
        	[
        		"is_create"		=> true,
        		"is_view"		=> true,
        		"is_update"		=> true,
        		"is_delete"		=> false,
        		"id_group"		=> 2,
        		"id_resource"	=> 2,
        	],
        	[
        		"is_create"		=> true,
        		"is_view"		=> true,
        		"is_update"		=> true,
        		"is_delete"		=> false,
        		"id_group"		=> 2,
        		"id_resource"	=> 3,
        	],
        	[
        		"is_create"		=> true,
        		"is_view"		=> true,
        		"is_update"		=> true,
        		"is_delete"		=> false,
        		"id_group"		=> 2,
        		"id_resource"	=> 4,
        	],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 2,
                "id_resource"   => 5,
            ],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 2,
                "id_resource"   => 6,
            ],
            [
                "is_create"     => false,
                "is_view"       => false,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 2,
                "id_resource"   => 7,
            ],
            [
                "is_create"     => false,
                "is_view"       => false,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 3,
                "id_resource"   => 1,
            ],
            [
                "is_create"     => false,
                "is_view"       => true,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 3,
                "id_resource"   => 2,
            ],
            [
                "is_create"     => false,
                "is_view"       => true,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 3,
                "id_resource"   => 3,
            ],
            [
                "is_create"     => false,
                "is_view"       => true,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 2,
                "id_resource"   => 4,
            ],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => true,
                "is_delete"     => true,
                "id_group"      => 2,
                "id_resource"   => 5,
            ],
            [
                "is_create"     => true,
                "is_view"       => true,
                "is_update"     => true,
                "is_delete"     => true,
                "id_group"      => 2,
                "id_resource"   => 6,
            ],
            [
                "is_create"     => false,
                "is_view"       => false,
                "is_update"     => false,
                "is_delete"     => false,
                "id_group"      => 2,
                "id_resource"   => 7,
            ],
        ]);
    }
}
