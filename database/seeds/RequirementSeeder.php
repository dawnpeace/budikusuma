<?php

use App\enums\Document;
use Illuminate\Database\Seeder;
use App\Requirement;
use Faker\Generator as Faker;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        foreach(Document::ALL as $doc){
            Requirement::create([
                "document" => $doc,
                "description" => "<ul><li>Peraturan 1</li><li>Peraturan 2</li><li>Peraturan 3</li><li>Peraturan 4</li><li><strong>Peraturan 5</strong></li></ul>"
            ]);
        }
    }
}
