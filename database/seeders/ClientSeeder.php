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
            'name' => 'ministry of education.',
            'logo'=>'deganclient1.jpg',
        ]);
        Client::create([
            'user_id' => 1,
            'name' => 'Woldia university.',
            'logo'=>'deganclient2.jpg',
        ]);
        Client::create([
            'user_id' => 1,
            'name' => 'wollo university.',
            'logo'=>'deganclient3.jpg',
        ]);

        
    }
}
