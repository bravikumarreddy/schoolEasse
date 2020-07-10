<?php

use Illuminate\Database\Seeder;

class StudentInstalmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\student_instalments::class,1000)->create();
    }
}
