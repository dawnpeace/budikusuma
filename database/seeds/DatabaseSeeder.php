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
        $this->call(IdentityCardSeeder::class);
        $this->call(FamilyCardSeeder::class);
        $this->call(BirthCertificateSeeder::class);
        $this->call(ChildIdSeeder::class);
        $this->call(RequirementSeeder::class);
    }
}
