<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ExamMarks::class, function (Faker $faker) {
    return [
        //
        'subject_id' => $faker->randomElement(\App\Subjects::pluck('id')->toArray() ),
        'exam_id' => $faker->randomElement(\App\ClassExam::pluck('id')->toArray() ),
        'marks'=>$faker->numberBetween(10,100),
        'max_marks' => 100,
        'student_id' => $faker->randomElement(\App\User::where('role',"=",'student' )->get()->pluck('id')->toArray()),
        'teacher_name'=> $faker->name,
    ];
});
