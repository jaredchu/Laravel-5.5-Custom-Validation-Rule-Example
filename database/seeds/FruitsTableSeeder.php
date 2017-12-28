<?php

use Illuminate\Database\Seeder;

class FruitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $i){
            $fruit = new \App\Fruits();
            $fruit->save();
        }
    }
}
