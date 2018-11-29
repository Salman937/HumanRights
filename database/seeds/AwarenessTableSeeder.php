<?php

use Illuminate\Database\Seeder;

class AwarenessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('awareness')->insert([

        	'title' => 'Human Rights Voilation',
        	'image' => 'public/uploads/awareness_images/1.jpg',
        	'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        	'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
