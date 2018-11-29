<?php

use Illuminate\Database\Seeder;

class ComplaintStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('complaint_status')->insert([
        	[
                'complaint_status' => 'Pending',
                'created_at' => date("Y-m-d H:i:s"),
        		'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
        		'complaint_status' => 'Completed',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
        		'complaint_status' => 'In Progress',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
        		'complaint_status' => 'Irrelevant',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        	],
        	[
        		'complaint_status' => 'Not Understandable',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
        	]
    	]);
    }
}
