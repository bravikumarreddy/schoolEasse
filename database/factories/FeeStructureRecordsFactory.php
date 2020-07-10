<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\fee_structure;
use App\fee_structure_records;


$factory->define(fee_structure_records::class, function (Faker $faker) {
    return [
        //
        'fee_structure_id' => $faker->randomElement(fee_structure::pluck('id')->toArray()),
        'name'=> $faker->word,
        'amount'=> $faker->numberBetween(1000,5000),

    ];
});
