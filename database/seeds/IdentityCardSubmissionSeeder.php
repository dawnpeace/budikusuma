<?php

use Illuminate\Database\Seeder;

class IdentityCardSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\IdentityCardSubmission::class, 1)->create();
    }
}
