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
        $this->call(LaratrustSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FakeUsersSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(BookingParticipantsTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
    }
}
