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

        DB::table("absences")->insert([
            'startdate' => '16-01-2020',
            'enddate' => '17-01-2020',
            'isapproved' => Null,
            'submitter' => 1,
        ]);

    }
}
