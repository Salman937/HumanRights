<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ComplaintStatusTableSeeder::class);
        $this->call(AwarenessTableSeeder::class);
        $this->call(AnnouncementsTableSeeder::class);
        $this->call(PhoneDirTableSeeder::class);
    }
}
