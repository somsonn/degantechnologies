<?php
// database/seeders/CompanyHistorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyHistory;

class CompanyHistorySeeder extends Seeder
{
    public function run()
    {
        CompanyHistory::create([
            'user_id' => 1,
            'year' => 2017,
            'title' => 'Degan technologies plc',
            'description' => 'Our company was founded in 2000.',
            'image' => 'path/to/image.jpg',
        ]);

    }
}
