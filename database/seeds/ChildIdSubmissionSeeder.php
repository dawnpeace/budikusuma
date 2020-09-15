<?php

use App\ChildIdSubmission;
use Illuminate\Database\Seeder;

class ChildIdSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ChildIdSubmission::class, 100)->create();
    }
}
