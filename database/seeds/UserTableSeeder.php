<?php

use Illuminate\Database\Seeder,
    App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('123456');
        $user->passtext = '123456';
        $user->company = 'Bineks';
        $user->save();
        $user->attachRole(1);   //  add admin role


        $user = new User();
        $user->first_name = 'user';
        $user->email = 'user@mail.com';
        $user->password = bcrypt('123456');
        $user->passtext = '123456';
        $user->company = 'Bineks';
        $user->save();
        $user->attachRole(4);   //  add user role
    }
}
