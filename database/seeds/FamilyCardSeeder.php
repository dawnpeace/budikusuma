<?php

use Illuminate\Database\Seeder;

class FamilyCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FamilyCard::class, 10)->create();
    }
}
