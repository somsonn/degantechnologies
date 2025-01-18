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
            'title' => 'freindships in campus life',
            'description' => 'We are the founders of Degan Technology, a team of six friends who graduated from Wollo University, Kombolcha Campus, in 2017. Our journey started with a shared vision, a deep sense of commitment, and a strong bond of friendship. Over the years, we’ve worked together on numerous mobile apps and web systems, continuously striving to bring innovative solutions to the world. Today, we are proud to lead Degan Technology, a company dedicated to developing mobile apps, websites, ERP systems, CRM solutions, and much more. Our work is a testament to the power of friendship, commitment, and the belief in our shared goals.',
            'file' => 'deganportfolio4.jpg',
        ]);
        Portfolio::create([
            'user_id' => 1,
            'title' => 'graduation date',
            'description' => 'We are proud to share that our hard work and dedication during our time at Wollo University, Kombolcha Campus, paid off in remarkable ways. As we graduated in 2017, our commitment to excellence was recognized, and we were honored with prestigious awards. Some of us received the Gold Medal for outstanding academic performance, while others were awarded Medals and Certificates for our achievements. These honors reflect the hard work, passion, and dedication that each of us brought to our studies and projects. Our academic success fueled our drive to continue building Degan Technology, where we apply the same level of commitment to everything we do.',
            'file' => 'deganportfolio2.jpg',
        ]);
        Portfolio::create([
            'user_id' => 1,
            'title' => 'freindships in campus life',
            'description' => 'We are the founders of Degan Technology, a team of six friends who graduated from Wollo University, Kombolcha Campus, in 2017. Our journey started with a shared vision, a deep sense of commitment, and a strong bond of friendship. Over the years, we’ve worked together on numerous mobile apps and web systems, continuously striving to bring innovative solutions to the world. Today, we are proud to lead Degan Technology, a company dedicated to developing mobile apps, websites, ERP systems, CRM solutions, and much more. Our work is a testament to the power of friendship, commitment, and the belief in our shared goals.',
            'file' => 'deganportfolio1.jpg',
        ]);
        Portfolio::create([
            'user_id' => 1,
            'title' => 'freindships in campus life',
            'description' => 'We are the founders of Degan Technology, a team of six friends who graduated from Wollo University, Kombolcha Campus, in 2017. Our journey started with a shared vision, a deep sense of commitment, and a strong bond of friendship. Over the years, we’ve worked together on numerous mobile apps and web systems, continuously striving to bring innovative solutions to the world. Today, we are proud to lead Degan Technology, a company dedicated to developing mobile apps, websites, ERP systems, CRM solutions, and much more. Our work is a testament to the power of friendship, commitment, and the belief in our shared goals.',
            'file' => 'deganportfolio3.jpg',
        ]);
    }
}
