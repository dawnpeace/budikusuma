<?php

use Illuminate\Database\Seeder;

class IdentityCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\IdentityCard::class, 10)->create();
    }
}
