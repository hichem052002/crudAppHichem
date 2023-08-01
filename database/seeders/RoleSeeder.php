<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Role::factory()->count(10)->create();
        $roles=[[
            'name'=>'Admin',
        ],[
            'name'=>'Visitor',
        ],
        
        ];
        DB::table('roles')->insert($roles);
    }
}
