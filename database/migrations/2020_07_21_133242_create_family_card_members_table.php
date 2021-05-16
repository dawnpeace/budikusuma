<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyCardMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stored_family_card_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId("family_card_id")->constrained("stored_family_cards");
            $table->string("name");
            $table->string("id_card")->nullable();
            $table->string("gender");
            $table->string("birthplace");
            $table->date("birthdate");
            $table->string("religion");
            $table->string("education");
            $table->string("profession");
            $table->string("family_relation");
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
        Schema::dropIfExists('stored_family_card_members');
    }
}
