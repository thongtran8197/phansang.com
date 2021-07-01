<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slider_images')->truncate();
        $faker = Faker\Factory::create();
        $slider_images = [];
        for ($i = 0; $i < 5; $i++) {
            $slider_image = [
                'image' => $faker->imageUrl($width = 640, $height = 480, 'cats'),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ];
            array_push($slider_images, $slider_image);
        }
        DB::table('slider_images')->insert($slider_images);
    }
}
