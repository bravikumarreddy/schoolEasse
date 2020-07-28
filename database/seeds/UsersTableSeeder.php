<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => "admin",
            'email'    => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'role'     => 'master',
            'active'   => 1,
            'verified' => 1,
        ]);

        factory(User::class, 1)->states('admin')->create();
        factory(User::class, 1)->states('accountant')->create();
        factory(User::class, 1)->states('librarian')->create();
        factory(User::class, 2)->states('teacher')->create();
        factory(User::class, 5)->states('student')->create();
    }
}
