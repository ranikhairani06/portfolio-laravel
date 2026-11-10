<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Project::firstOrCreate(
                ['title' => 'Project Contoh Ke-' . $i],
                [
                    'description' => 'Ini adalah deskripsi untuk project contoh ke-' . $i . '.',
                    'status' => 'draft',
                ]
            );
        }
    }
}
