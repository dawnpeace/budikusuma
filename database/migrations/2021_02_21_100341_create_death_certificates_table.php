<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\enums\DocumentStatus;

class CreateDeathCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('death_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("card_number")->nullable()->unique();
            $table->string("identity_card")->unique();
            $table->date("birthdate");
            $table->string("birthplace")->nullable();
            $table->date("deceased_at");
            $table->string("note");
            $table->softDeletes();
            $table->string("gender");
            $table->string("status")->default(DocumentStatus::HOLD);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('death_certificates');
    }
}
