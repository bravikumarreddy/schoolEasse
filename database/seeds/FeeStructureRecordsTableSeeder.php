<?php

use Illuminate\Database\Seeder;
use App\fee_structure;

class FeeStructureRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        for($i=0;$i<300;$i++) {
            DB::table('instalments')->insert(
                [
                    'fee_structure_id' => $faker->randomElement(fee_structure::pluck('id')->toArray()),
                    'number' => $faker->numberBetween(1, 5),
                    'due_date' => $faker->date('d-m-y'),
                    'amount' => $faker->numberBetween(1000, 5000),
                ]
            );
        }
        factory(\App\fee_structure_records::class, 250)->create();
    }
}
