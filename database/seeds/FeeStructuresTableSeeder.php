<?php

use Illuminate\Database\Seeder;
use App\fee_structure;

class FeeStructuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(fee_structure::class, 50)->create();
    }
}
