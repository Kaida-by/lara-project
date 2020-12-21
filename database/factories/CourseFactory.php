<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $title = $faker->realText(rand(10, 40));
    $descr = $faker->realText(rand(100, 200));
    $start = $faker->dateTimeBetween('-20 days', '-1 days');
    $end = $faker->dateTimeBetween('-10 days', '-1 days');
    $created = $faker->dateTimeBetween('-30 days', '-1 days');
    $updated = $faker->dateTimeBetween('-30 days', '-1 days');

    return [
        'title' => $title,
        'teacher_id' => rand(1, 10),
        'descr' => $descr,
        'start' => $start,
        'end' => $end,
        'created_at' => $created,
        'updated_at' => $updated,
    ];
});
