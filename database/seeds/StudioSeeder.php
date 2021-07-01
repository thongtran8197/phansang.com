<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('studios')->truncate();
        $faker = Faker\Factory::create();
        $studios = [];
        for ($i = 0; $i <5; $i++) {
            $studio = [
                'name' => $faker->name,
                'link_studio' => $faker->imageUrl($width = 640, $height = 480, 'cats'),
                'type' => rand(1,2),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ];
            array_push($studios, $studio);
        }
        DB::table('studios')->insert($studios);
    }
}
