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
        // $this->call(UsersTableSeeder::class);
        DB::table("absences")->insert([
            'startdate' => '16-01-2020',
            'enddate' => '17-01-2020',
            'isapproved' => False,
            'submitter' => 1,
        ]);
    }
}
