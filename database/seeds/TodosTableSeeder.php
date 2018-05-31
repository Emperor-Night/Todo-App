<?php

use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Todo::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i = 1; $i <= 20; $i++) {

            $status = 1;
            if ($i % 2 == 0) {
                $status = 0;
            }

            \App\Todo::create([
                "name"    => "Dejan todo " . $i,
                "user_id" => 1,
                "status"  => $status
            ]);

        }

        for ($i = 1; $i <= 10; $i++) {

            $status = 0;
            if ($i % 2 == 0) {
                $status = 1;
            }

            \App\Todo::create([
                "name"    => "Bojan todo " . $i,
                "user_id" => 2,
                "status"  => $status
            ]);

        }

    }


}
