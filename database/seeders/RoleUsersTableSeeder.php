<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_users')->insert([
            [
                'id' => 1,
                'name' => 'FINANCE',
                'status' => 'ACTIVE',
                'created_at' => '2023-09-06 22:48:06',
                'updated_at' => '2023-09-06 22:48:06',
            ],
            [
                'id' => 2,
                'name' => 'STAFF',
                'status' => 'ACTIVE',
                'created_at' => '2023-09-06 22:48:06',
                'updated_at' => '2023-09-06 22:48:06',
            ],
            [
                'id' => 3,
                'name' => 'DIRECTOR',
                'status' => 'ACTIVE',
                'created_at' => '2023-09-06 22:48:06',
                'updated_at' => '2023-09-06 22:48:06',
            ],
        ]);
    }
}
