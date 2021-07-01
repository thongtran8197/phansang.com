<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();
        $faker = Faker\Factory::create();
        $collection_ids = DB::table('collections')->get()->pluck('id');
        $posts = [];
        foreach ($collection_ids as $collection_id) {
            for ($i = 0; $i < 5; $i++) {
                $post = [
                    'collection_id' => $collection_id,
                    'image' => $faker->imageUrl($width = 640, $height = 480, 'cats'),
                    'description' => $faker->text,
                    'description_en' => "",
                    'description_fr' => "",
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now(),
                ];
                array_push($posts, $post);
            }
        }
        DB::table('posts')->insert($posts);
    }
}
