<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\student_instalments;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(student_instalments::class, function (Faker $faker) {
    $instalment = DB::table('instalments')->inRandomOrder()->first();

    return [
        //
        'student_id' => $faker->randomElement(\App\User::where('role',"=",'student' )->get()->pluck('id')->toArray()),
        'instalment_id'=> $instalment->id,
        'fee_structure_id'=> $instalment->fee_structure_id,
        'paid'=> $faker->randomElement([0,1])

    ];
});
