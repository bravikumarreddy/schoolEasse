<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ClassExam::class, function (Faker $faker) {
    return [
        //
        'class_id'=> $faker->randomElement(\App\Myclass::pluck('id')->toArray()),
        'exam_name' => $faker->randomElement(['Unit-Test 1',"Unit-Test 2","Final-Exam 1","Final-Exam 2",'Supplement-1','Supplement-2','Pre-Final 1','Pre-Final 2','Pre-Final 4','Pre-Final 3','Pre-Final 5']),

    ];
});
