<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Absence::class, function (Faker $faker) {

    $startDate = $faker->dateTimeThisYear()->format('Y-m-d');
    $endDate = $faker->dateTimeBetween($startDate, '+2 months')->format('Y-m-d');

    return [
        'startdate' => $startDate,
        'enddate' => $endDate,
        'submitter' => User::find(rand(1, count(User::all())))
    ];
});
