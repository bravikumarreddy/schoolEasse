<?php

use Illuminate\Database\Seeder;

class FeeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\FeeGroups::class, 10)->create();
    }
}
