<?php

use Illuminate\Database\Seeder;

class FamilyCardSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FamilyCardSubmission::class, 10)->create();
    }
}
