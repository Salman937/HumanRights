<?php

use Illuminate\Database\Seeder;

class PhoneDirTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_dir')->insert([

            [
                'name' => 'Salman Iqbal',
                'designation' => 'Web Developer',
                'office_number' => '09809809809',
            ],
            [
                'name' => 'Bilal Sabir',
                'designation' => 'Android Developer',
                'office_number' => '09809809',
            ],

        ]);
    }
}
