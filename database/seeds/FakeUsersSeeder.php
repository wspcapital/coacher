<?php

use Illuminate\Database\Seeder;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 50)->create()->each(function ($u) {
            $u->attachRole(4);
        });
        factory(App\Models\User::class, 10)->create()->each(function ($u) {
            $u->attachRole(3);
        });
        factory(App\Models\User::class, 10)->create()->each(function ($u) {
            $u->attachRole(2);
        });
    }
}
