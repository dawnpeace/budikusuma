<?php

use Illuminate\Database\Seeder;
use App\DeathCertificateSubmission;

class DeathCertificateSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DeathCertificateSubmission::class, 100)->create();
    }
}
