<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_family_cards', function (Blueprint $table) {
            $table->id();
            $table->string("id_card")->unique();
            $table->string("householder");
            $table->string("householder_id_card")->unique();
            $table->string("address");
            $table->string("rt");
            $table->string("rw");
            $table->string("zip_code");
            $table->string("kelurahan");
            $table->string("kecamatan");
            $table->string("kabupaten");
            $table->string("provinsi");
            $table->foreignId('user_id')->constrained('users');
            $table->softDeletes();
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
        Schema::dropIfExists('stored_family_cards');
    }
}
