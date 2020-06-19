<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\{
    Facades\DB,
    Facades\Hash,
    Str
};

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<30;$i++) {
            $random_date = date("d.m.Y", rand(strtotime("Jan 01 2015"), strtotime("Nov 01 2022")));
            DB::table('tasks')->insert([
                'title' => Str::random(12),
                'description' => Str::random(120),
                'responsible_id' => random_int(1, 10),
                'created_by' => random_int(1, 10),
                'status' => random_int(0, 1),
                'deadline' => $random_date                
            ]);
        }
    }
}
