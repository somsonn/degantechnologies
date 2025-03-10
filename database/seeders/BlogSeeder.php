<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Blog 1
        Blog::create([
            'user_id' => 1,
            'title' => 'Revolutionizing Business with Custom Software Solutions',
            'content' => 'Discover how custom software solutions can transform your business operations, improve efficiency, and drive innovation. Learn why tailored software is a must for businesses looking to stay ahead in a competitive market.',
        ]);

        // Blog 2
        Blog::create([
            'user_id' => 1,
            'title' => 'The Future of Mobile App Development',
            'content' => 'Explore the latest trends and technologies shaping the future of mobile app development. From AI-powered features to seamless user experiences, stay ahead with insights into the world of mobile apps.',
        ]);

        // Blog 3
        Blog::create([
            'user_id' => 1,
            'title' => 'Enhancing Customer Engagement Through Digital Transformation',
            'content' => 'Learn how digital transformation strategies can enhance customer engagement. Discover tools and practices to create meaningful connections with your audience in the digital era.',
        ]);

        // Blog 4
        Blog::create([
            'user_id' => 1,
            'title' => 'Empowering Small Businesses with Scalable Software',
            'content' => 'Understand how scalable software solutions empower small businesses to compete with industry giants. Learn why scalability is key to sustainable growth.',
        ]);

        // Blog 5
        Blog::create([
            'user_id' => 1,
            'title' => 'The Role of AI in Modern Software Development',
            'content' => 'Dive into the role of artificial intelligence in shaping the future of software development. From intelligent coding assistants to predictive analytics, AI is revolutionizing the industry.',
        ]);
    }
}
