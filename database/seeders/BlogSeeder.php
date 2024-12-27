<?php

// database/seeders/BlogSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::create([
            'user_id' => 1,
            'title' => 'First Blog Post',
            'content' => 'This is the content of the first blog post.',
        ]);

      
    }
}
