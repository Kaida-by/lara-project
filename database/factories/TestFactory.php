<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    $question = $faker->realText(rand(10,20));
    $answer = $faker->realText(rand(10, 20));
    $created = $faker->dateTimeBetween('-30 days', '-1 days');
    $updated = $faker->dateTimeBetween('-30 days', '-1 days');

    return [
        'topics_id' => rand(1, 20),
        'question' => $question,
        'answer_1' => $answer,
        'answer_2' => $answer,
        'answer_3' => $answer,
        'answer_4' => $answer,
        'answer_5' => $answer,
        'true' => 'false',
        'created_at' => $created,
        'updated_at' => $updated,
    ];
});
