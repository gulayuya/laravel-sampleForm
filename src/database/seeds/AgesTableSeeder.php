<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ages')->insert([
            'id' => 1,
            'age' => '10代以下',
            'sort' => 1,
        ]);
        DB::table('ages')->insert([
            'id' => 2,
            'age' => '20代',
            'sort' => 2,
        ]);
        DB::table('ages')->insert([
            'id' => 3,
            'age' => '30代',
            'sort' => 3,
        ]);
        DB::table('ages')->insert([
            'id' => 4,
            'age' => '40代',
            'sort' => 4,
        ]);
        DB::table('ages')->insert([
            'id' => 5,
            'age' => '50代',
            'sort' => 5,
        ]);
        DB::table('ages')->insert([
            'id' => 6,
            'age' => '60代以上',
            'sort' => 6,
        ]);
    }
}
