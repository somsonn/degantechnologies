<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    public function run()
    {
        Content::create(attributes: [
            'user_id' => 1,
            'type' => 'vision',
            'title' => 'Innovate today, lead tomorrow',
            'description' => 'To be the leading software development partner in driving the digital transformation of public and private sectors.',
            'image' => 'vision.jpg',
        ]);

        Content::create(attributes: [
            'user_id' => 1,
            'type' => 'mission',
            'title' => 'Our Mission',
            'description' => 'To deliver innovative, high-impact, and sustainable solutions that empower businesses and individuals, creating value in administration, education, healthcare, transport, agriculture, and markets.',
            'image' => 'mission.jpg',
        ]);
        Content::create(attributes: [
            'user_id' => 1,
            'type' => 'industry',
            'title' => 'education',
            'description' => 'we focus on The education industry to improve quality of education',
            'image' => 'vision.jpg',
        ]);
        Content::create(attributes: [
            'user_id' => 1,
            'type' => 'value',
            'title' => 'quality',
            'description' => 'Committed to delivering the highest quality in every product and service.',
            'image' => 'vision.jpg',
        ]);
        Content::create(attributes: [
            'user_id' => 1,
            'type' => 'value',
            'title' => 'Innovation',
            'description' => 'Embrace creativity and continually strive to deliver groundbreaking solutions.',
            'image' => 'vision.jpg',
        ]);
        Content::create([
            'user_id' => 1,
            'type' => 'value',
            'title' => 'Customer-Centric Approach',
            'description' => 'Place customer success at the core of everything we do.',
            'image' => 'vision.jpg',
        ]);
        Content::create([
            'user_id' => 1,
            'type' => 'services',
            'title' => 'Software Development Services',
            'description' => 'End-to-end development of custom software tailored to your business needs.',
            'image' => 'vision.jpg',
        ]);
        Content::create([
            'user_id' => 1,
            'type' => 'services',
            'title' => 'Tech Maintenance and Support',
            'description' => 'Ongoing technical support and system optimization to ensure seamless operations.',
            'image' => 'vision.jpg',
        ]);
        Content::create([
            'user_id' => 1,
            'type' => 'products',
            'title' => 'Enterprise Software Systems',
            'description' => 'Complex systems such as ERP, CRM, and HR management tailored for large organizations.',
            'image' => 'vision.jpg',
        ]);
        Content::create([
            'user_id' => 1,
            'type' => 'products',
            'title' => 'Mobile and Web Applications',
            'description' => 'User-friendly apps that drive customer engagement and streamline business operations.',
            'image' => 'vision.jpg',
        ]);
    }
}
