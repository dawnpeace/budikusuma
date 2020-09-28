<?php

use App\BirthCertificateSubmission;
use Illuminate\Database\Seeder;

class BirthCertificateSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BirthCertificateSubmission::class, 10)->create();
    }
}
