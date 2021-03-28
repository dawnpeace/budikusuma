<?php

use App\DeathCertificate;
use Illuminate\Database\Seeder;

class DeathCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DeathCertificate::class, 100)->create();
    }
}
