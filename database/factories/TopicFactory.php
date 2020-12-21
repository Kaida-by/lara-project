<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $title = $faker->realText(rand(10,40));
    $descr = $faker->realText(rand(100, 200));
    $time = \Carbon\Carbon::createFromTime('0', '0', '30');
    $created = $faker->dateTimeBetween('-30 days', '-1 days');
    $updated = $faker->dateTimeBetween('-30 days', '-1 days');


    return [
        'title_top' => $title,
        'descr_top' => $descr,
        'courses_id' => rand(1, 10),
        'deadline' => $time,
        'active' => 'true',
        'created_at' => $created,
        'updated_at' => $updated,
    ];
});
