<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\enums\DocumentStatus;

class CreateFamilyCardRenewalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_card_renewal_requests', function (Blueprint $table) {
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
            $table->string('note');
            $table->string('reason')->nullable();
            $table->string('status')->default(DocumentStatus::HOLD);
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('card_id')->constrained('stored_family_cards');
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
        Schema::dropIfExists('family_card_renewal_requests');
    }
}
