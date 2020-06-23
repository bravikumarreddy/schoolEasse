<?php

use App\StudentInfo;
use Illuminate\Database\Seeder;
use App\User;

class StudentinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::student()->pluck('id')->toArray();
        for($i=0 ;$i<count($users);$i++)
            factory(StudentInfo::class)->create(['student_id'=> $users[$i]]);

    }
}
