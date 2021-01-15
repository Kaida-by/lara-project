<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create();
        factory(\App\Course::class, 10)->create();
        factory(\App\Topic::class, 20)->create();
        factory(\App\Test::class, 80)->create();
    }
}
