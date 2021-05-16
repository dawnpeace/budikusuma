<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredChildrenIdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_children_ids', function (Blueprint $table) {
            $table->id();
            $table->string('card_number')->nullable()->unique();
            $table->string("name");
            $table->string("gender");
            $table->string("family_card_number");
            $table->string("birth_certificate_number");
            $table->date("birthdate");
            $table->string('birthplace');
            $table->string("address");
            $table->string("householder_name");
            $table->string("religion");
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('citizenship');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('stored_children_ids');
    }
}
