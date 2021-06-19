<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyCardRenewalMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_card_renewal_members', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("id_card")->nullable();
            $table->string("gender");
            $table->string("birthplace");
            $table->date("birthdate");
            $table->string("religion");
            $table->string("education");
            $table->string("profession");
            $table->string("family_relation");
            $table->foreignId("request_id")->constrained("family_card_renewal_requests");
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
        Schema::dropIfExists('family_card_renewal_members');
    }
}
