<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portfolio::create([
            'user_id' => 1,
            'title' => 'Tech Solutions',
            'description' => 'A custom solution developed for a global tech company.',
            'file' => 'path/to/project-image.jpg',
        ]);
    }
}
