<?php

use Illuminate\Database\Seeder,
    Faker\Factory as Faker;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); //https://github.com/fzaninotto/Faker
        foreach (range(1, 20) as $index) {
            DB::table('bookings')->insert([
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
                'start_date' => $faker->date($format = 'Y-m-d', $min = '2015-01-01'),
                'end_date'   => $faker->date($format = 'Y-m-d', $max = '2018-01-01'),
                'booker_user_id'=> $faker->numberBetween($min = 1, $max = 20),
                'rm_user_id'    => $faker->numberBetween($min = 1, $max = 20),
                'type'          =>  'Workshop',
                'title'         =>  $faker->word(),
                'company'       =>  $faker->word(),
                'company_website'   =>  $faker->url(),
                'company_contact'   =>  $faker->word(),
                'client_phone'      =>  $faker->tollFreePhoneNumber(),
                'client_email'      =>  $faker->email(),
                'details'   =>  '',
                'pdpship'   =>  '',
                'noteship'   =>  '',
                'generalnote'   =>  '',
                'event_hotels'   =>  '',
                'travelnotes'   =>  '',
                'accommodations'   =>  '',
                'transfer'   =>  ''
            ]);
        }
    }
}
