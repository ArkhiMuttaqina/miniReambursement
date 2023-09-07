<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'arkhi',
                'email' => 'arkhi@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$riBzI3y/BFqqefLp.7enQOS4vKX4h1C9vq6TSQgGut98y6Hm.4OgO',
                'status' => 'ACTIVE',
                'nip' => '1200',
                'role_id' => 1,
                'remember_token' => null,
                'created_at' => '2023-09-07 09:34:47',
                'updated_at' => '2023-09-07 09:34:47',
            ],
            [
                'id' => 2,
                'name' => 'DONI',
                'email' => 'doni@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$6RLtGFvhMWgFTJtUFuY.cO9vP/QWoh9M4IS0ezFXPjcLW07BhYhl.',
                'status' => 'ACTIVE',
                'nip' => '1234',
                'role_id' => 3,
                'remember_token' => null,
                'created_at' => '2023-09-07 09:34:47',
                'updated_at' => '2023-09-07 09:34:47',
            ],
            [
                'id' => 4,
                'name' => 'DONO',
                'email' => 'dono@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$RVNotMrQZIR6fxrdYPZ93erSmyXgvC.1PZGL3IgYoguaMZ3FBTyDq',
                'status' => 'ACTIVE',
                'nip' => '1235',
                'role_id' => 1,
                'remember_token' => null,
                'created_at' => '2023-09-07 09:34:47',
                'updated_at' => '2023-09-07 09:34:47',
            ],
            [
                'id' => 5,
                'name' => 'DONA',
                'email' => 'dona@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$10$MdSpoi.CUSghdbk./GuhsuowAciSgfq452rSFT4HGc4wxJN5.z6gC',
                'status' => 'ACTIVE',
                'nip' => '1236',
                'role_id' => 2,
                'remember_token' => null,
                'created_at' => '2023-09-07 09:34:47',
                'updated_at' => '2023-09-07 09:34:47',
            ],
        ]);
    }
}
