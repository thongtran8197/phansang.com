<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collections')->truncate();
        $faker = Faker\Factory::create();
        $collections = [];
        for ($i = 0; $i <5; $i++) {
            $collection = [
                'name' => $faker->name,
                'description' => $faker->text,
                'description_en' => "",
                'description_fr' => "",
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ];
            array_push($collections, $collection);
        }
        DB::table('collections')->insert($collections);
    }
}
