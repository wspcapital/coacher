<?php

use Illuminate\Database\Seeder,
    Faker\Factory as Faker;

class BookingParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('booking_participants')->insert([
                'created_at'=>$faker->dateTime($max = 'now'),
                'updated_at'=>$faker->dateTime($max = 'now'),
                'booking_id'=>$faker->numberBetween($min = 1, $max = 20),
                'booking_trainers_id'=>$faker->numberBetween($min = 1, $max = 20),
                'user_id'=>$faker->numberBetween($min = 1, $max = 20),
                'type'=>$faker->randomElement($array = array ('Bulk', 'BookingSheet')),
                'share_hash'=>$faker->regexify('[A-Za-z0-9]{256}'),
                'data'=>''
            ]);
        }
    }
}
