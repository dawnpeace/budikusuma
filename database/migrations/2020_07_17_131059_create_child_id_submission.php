<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DocumentStatus;

class CreateChildIdSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_id_submission', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("family_card_number");
            $table->date("birthdate");
            $table->string("mother_identity_card_number");
            $table->string("father_identity_card_number");
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
        Schema::dropIfExists('child_id_submission');
    }
}
