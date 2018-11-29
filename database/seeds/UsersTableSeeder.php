<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

        	'name' 		=> 'Salman Iqbal',
        	'mobile_no' => '097987987899',
        	'cnic' 		=> '0980980980980',
        	'email' 	=> 'salman@gmail.com',
        	'city' 		=> 'swat',
        	'api_token' => str_random(60),
        	'password'  => bcrypt('salman'),

        ]);
    }
}

