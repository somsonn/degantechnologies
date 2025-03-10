<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\CompanyHistorySeeder;
use Database\Seeders\ContentSeeder;
use Database\Seeders\PortfolioSeeder;
use Database\Seeders\TeamMemberSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BlogSeeder::class,
            ClientSeeder::class,            
            CompanyHistorySeeder::class,
            ContentSeeder::class,
            PortfolioSeeder::class,
            TeamMemberSeeder::class,
        ]);
    }
}
