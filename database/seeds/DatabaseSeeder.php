<?php

use Illuminate\Database\Seeder;
use App\Absence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Artisan::call('adldap:import', [
            '--no-interaction' => true,
            '--restore' => true,
            '--delete' => true,
            '--filter' => '(objectclass=user)'
        ]);

        factory(Absence::class, 25)->create();
    }
}
