<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects=[[
            'name'=>'project_1',
        ],[
            'name'=>'project_2',
        ]];
        DB::table('projects')->insert($projects);
    }
}
