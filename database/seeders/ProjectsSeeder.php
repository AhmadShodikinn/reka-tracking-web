<?php

namespace Database\Seeders;

use App\Models\Projects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'project_code' => '612-CR',
                'project_name' => '612 Card replacement PT KAI',
                'description' => 'Penggantian kartu sistem pada unit 612 milik PT KAI.',
            ],
            [
                'project_code' => '612',
                'project_name' => 'Project 612',
                'description' => 'Proyek pengembangan sistem pada unit 612.',
            ],
        ];

        foreach ($projects as $project) {
            Projects::create($project);
        }

    }
}
