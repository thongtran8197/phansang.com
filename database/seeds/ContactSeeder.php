<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->truncate();
        $faker = Faker\Factory::create();
        $contacts = [];
        for ($i = 0; $i < 10; $i++) {
            $contact = [
                'message' => $faker->text,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'name' => $faker->name,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ];
            array_push($contacts, $contact);
        }
        DB::table('contacts')->insert($contacts);
    }
}
