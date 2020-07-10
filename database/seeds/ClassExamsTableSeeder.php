<?php

use Illuminate\Database\Seeder;

class ClassExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\ClassExam::class,20)->create();
    }
}
