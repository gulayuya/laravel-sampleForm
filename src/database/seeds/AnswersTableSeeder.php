<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('answers')->insert([
        //     'fullname' => 'john',
        //     'gender' => 1,
        //     'age_id' => 2,
        //     'email' => 'john@mail.com',
        //     'is_send_email' => 1,
        //     'feedback' => 'My Name is John',
        //     'created_at' => now(),
        // ]);

        $answers = factory(Answer::class, 100)->create();
    }
}
