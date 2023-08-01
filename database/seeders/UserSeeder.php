<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[[
            'name'=>'user1',
            'password'=>'$2y$10$91tFhszKiUkJwFBLPp864ezqwzdWfWQ0cF2uFy/mgDDgt3c.dDrmy',
            'email'=>'user1@gmail.com',
            'phone_number'=>'12345678'
        ],[
            'name'=>'user2',
            'password'=>'$2y$10$91tFhszKiUkJwFBLPp864ezqwzdWfWQ0cF2uFy/mgDDgt3c.dDrmy',
            'email'=>'user2@gmail.com',
            'phone_number'=>'12345677'
        ]];
        DB::table('users')->insert($users);
    }
}
