<?php

use Illuminate\Database\Seeder,
    Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder
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
            DB::table('orders')->insert([
                'created_at'=>$faker->dateTime($max = 'now'),
                'updated_at'=>$faker->dateTime($max = 'now'),
                'booking_participants_id'=>$faker->numberBetween($min = 1, $max = 20),
                'order_trainer_id'=>$faker->numberBetween($min = 1, $max = 20),
                'status'=>$faker->numberBetween($min = 0, $max = 2),
                'type'=>$faker->randomElement($array = array ('Video', 'Session', 'Package')),
                'source'=>$faker->randomElement($array = array ('Bulk', 'Contract', 'Portal', 'Store')),
                'data'=>''
            ]);
        }
    }
}
