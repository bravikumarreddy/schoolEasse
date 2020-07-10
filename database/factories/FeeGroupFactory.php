<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\School;
use Faker\Generator as Faker;

$factory->define(\App\FeeGroups::class, function (Faker $faker) {
    return [
        'school_id' => 1,
        'name' => $faker->streetName
        ];
});
