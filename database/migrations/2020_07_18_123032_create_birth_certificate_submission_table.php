<?php

use App\Enums\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthCertificateSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birth_certificate_submission', function (Blueprint $table) {
            $table->id();
            $table->string("id_card")->nullable()->unique();
            $table->string("name");
            $table->string("gender");
            $table->string("mother_identity_card_number");
            $table->string("mother_name");
            $table->string("father_identity_card_number");
            $table->string("father_name");
            $table->date("birthdate");
            $table->string("birthplace");
            $table->string("status")->default(DocumentStatus::HOLD);
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
        Schema::dropIfExists('birth_certificate_submission');
    }
}
