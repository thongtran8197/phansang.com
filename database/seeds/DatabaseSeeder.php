<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(ContactSeeder::class);
//         $this->call(CollectionSeeder::class);
//         $this->call(PostSeeder::class);
//         $this->call(StudioSeeder::class);
//         $this->call(SliderImageSeeder::class);
         $this->call(UserSeeder::class);
    }
}
