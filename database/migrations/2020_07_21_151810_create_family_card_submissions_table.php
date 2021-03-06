<?php

use App\enums\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyCardSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_card_submissions', function (Blueprint $table) {
            $table->id();
            $table->string("id_number")->nullable()->unique();
            $table->string("householder");
            $table->string("householder_id_card")->unique();
            $table->string("rt");
            $table->string("rw");
            $table->string('address');
            $table->string("zipcode");
            $table->string("kelurahan");
            $table->string("kecamatan");
            $table->string("kabupaten");
            $table->string("provinsi");
            $table->softDeletes();
            $table->string('status')->default(DocumentStatus::HOLD);
            $table->date("published_at")->nullable();
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
        Schema::dropIfExists('family_card_submissions');
    }
}
