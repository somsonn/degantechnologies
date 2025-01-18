<?php
namespace Database\Seeders;
use App\Models\CompanyHistory;
use Illuminate\Database\Seeder;
class CompanyHistorySeeder extends Seeder
{
    public function run()
    {
        CompanyHistory::create([
            'user_id' => 1,
            'year' => 2017,
            'title' => 'Degan technologies plc',
            'description' => 'Degan Technology was founded in 2017 by a group of six visionary graduates from Wollo University, Kombolcha Campus. These founders, all distinguished for their academic excellence, graduated with high honors, demonstrating a deep commitment to technology and innovation. Their shared passion for software development and problem-solving led them to create Degan Technology, a company aimed at transforming ideas into high-impact digital solutions.

               During their journey at Wollo University, the founders collaborated on several groundbreaking projects, developing a variety of mobile apps and web-based systems that addressed real-world challenges. Their academic journey was marked by intense learning, continuous development, and a drive to bring innovative solutions to the market.

               The company began as a small team, united by their shared belief in the power of technology to improve lives. With a strong foundation in software engineering, Degan Technology quickly became known for its ability to create scalable, user-friendly digital products that catered to diverse industries.',
            'image' => 'deganhistory1.jpg',
        ]);

    }
}
