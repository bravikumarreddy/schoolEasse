<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\DailyAttendance::class, function (Faker $faker) {
    return [
        //
        'student_id' => $faker->randomElement(\App\User::where('role',"=",'student' )->get()->pluck('id')->toArray()),
        'date'=> $faker->dateTimeBetween('this week', 'now'),
        'session' => $faker->randomElement(['Morning','Evening']),
        'section_id'=> $faker->randomElement(\App\Section::pluck('id')->toArray()),
    ];
});
