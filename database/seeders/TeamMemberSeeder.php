<?php

// database/seeders/TeamMemberSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {
        TeamMember::create([
            'user_id' => 1,
            'name' => 'Haregewoin Menberu',
            'position' => 'CEO',
            'photo' => 'path/to/photo.jpg',
        ],[ 'user_id' => 1,
            'name' => 'Sewmehon engda ',
            'position' => 'DEveloper',
            'photo' => 'path/to/photo.jpg',
        ],[
            'user_id' => 1,
            'name' => 'Abiyot Ashebir',
            'position' => 'DEveloper',
            'photo' => 'path/to/photo.jpg',
        ],[
            'user_id' => 1,
            'name' => 'Hailemariam kebede',
            'position' => 'DEveloper',
            'photo' => 'path/to/photo.jpg',
        ],[
            'user_id' => 1,
            'name' => 'getahun negash',
            'position' => 'DEveloper',
            'photo' => 'path/to/photo.jpg',
        ],
        [
            'user_id' => 1,
            'name' => 'biniam lamesgin',
            'position' => 'DEveloper',
            'photo' => 'path/to/photo.jpg',
        ],
    );

    }
}
