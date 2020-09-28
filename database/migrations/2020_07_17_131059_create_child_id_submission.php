<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\enums\DocumentStatus;

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
            $table->string("status")->default(DocumentStatus::HOLD);
            $table->softDeletes();
            $table->date("published_at")->nullable();
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
