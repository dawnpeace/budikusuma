<?php

use App\Enums\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityCardSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_card_submissions', function (Blueprint $table) {
            $table->id();
            $table->string("id_card")->nullable()->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('religion');
            $table->string('marriage_status');
            $table->string('profession');
            $table->string('nationality');
            $table->softDeletes();
            $table->string("status")->default(DocumentStatus::HOLD);
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
        Schema::dropIfExists('identity_card_reprint_applications');
    }
}
