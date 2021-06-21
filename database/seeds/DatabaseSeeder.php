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
        // $this->call(UserSeeder::class);

        factory(App\OfficeOwner::class, 10)->create();
        factory(App\Marketer::class, 10)->create();
        factory(App\RealState::class, 40)->create();
        factory(App\Request::class, 40)->create();
        factory(App\image::class, 10)->create();

    }
}
