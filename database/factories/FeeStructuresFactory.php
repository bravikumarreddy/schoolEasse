<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\fee_structure;
use App\FeeGroups;
use Faker\Generator as Faker;

$factory->define(fee_structure::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->word,
        'fee_group_id' => $faker->randomElement(FeeGroups::pluck('id')->toArray()),
        'total_amount' => $faker->numberBetween(1000,10000),
        'total_instalments' => $faker->numberBetween(1,6),


    ];
});
