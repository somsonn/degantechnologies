<?php

// database/seeders/ClientSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'user_id' => 1,
            'name' => 'sewmehon engda.',
        ]);

        
    }
}
