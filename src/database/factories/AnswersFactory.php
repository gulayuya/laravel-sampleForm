<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'gender' => $faker->numberBetween(1, 2),
        'age_id' => $faker->numberBetween(1, 6),
        'email' => $faker->email,
        'is_send_email' => $faker->numberBetween(1, 2),
        'feedback' => $faker->sentence(5),
        'created_at' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});
