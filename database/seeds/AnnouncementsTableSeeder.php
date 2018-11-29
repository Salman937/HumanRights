<?php

use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
            [
                'title' => 'Directorate of Human Rights',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
                'image' => 'public/uploads/announcements_images/1.jpg',
                'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'title' => 'Complaints Status',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
                'image' => 'public/uploads/announcements_images/2.jpg',
                'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
