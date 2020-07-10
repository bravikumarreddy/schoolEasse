<?php

use Illuminate\Database\Seeder;

class DailyAttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\DailyAttendance::class,750)->create();

    }
}
