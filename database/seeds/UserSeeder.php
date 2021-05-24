<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function() {
            User::create([
                "name" => "Alan Budikusuma",
                "email" => "alan@budikusuma.com",
                "identity_number" => "6101092812930002",
                "address" => "Sanatab. Sambas, Kalimantan Barat",
                "phone" => "081522668282",
                "type" => "common",
                "password" => bcrypt("password12"),
            ]);

            User::create([
                "name" => "Admin Alan Budikusuma",
                "email" => "admin@budikusuma.com",
                "identity_number" => "6101092812930003",
                "address" => "Sanatab. Sambas, Kalimantan Barat",
                "phone" => "081522668282",
                "type" => "admin",
                "password" => bcrypt("password12"),
            ]);
        });
    }
}
