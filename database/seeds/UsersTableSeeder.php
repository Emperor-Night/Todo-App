<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        App\User::create([
            "name"     => "Dejan",
            "email"    => "dejanstankovicle@gmail.com",
            "password" => bcrypt("123123")
        ]);

        App\User::create([
            "name"     => "John",
            "email"    => "john@gmail.com",
            "password" => bcrypt("123123")
        ]);
    }


}
