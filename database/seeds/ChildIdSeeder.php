<?php

use Illuminate\Database\Seeder;

class ChildIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ChildIdentityCard::class, 10)->create();
    }
}
