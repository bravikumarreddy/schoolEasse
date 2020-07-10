<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\TeacherSubject::class, function (Faker $faker) {
    $teacher = \App\User::where('role',"=",'teacher' )->inRandomOrder()->first();

    return [
        //
        'subject_id' => $faker->randomElement(\App\Subjects::pluck('id')->toArray() ),
        'section_id' => $faker->randomElement(\App\Section::pluck('id')->toArray() ),
        'teacher_id' => $teacher->id,
        'teacher_name'=> $teacher->name,

    ];
});
