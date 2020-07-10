<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Subjects::class, function (Faker $faker) {
    return [
        //
        'class_id'=> $faker->randomElement(\App\Myclass::pluck('id')->toArray()),
        'name' => $faker->randomElement(['Maths',"Science","History","English",'Hindi','Biology','Economics','Social','Grammar','Phisycs','Computers']),

        ];
});
