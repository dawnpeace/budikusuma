<?php

use App\Enums\DocumentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyCardMembersSumbissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_card_members_sumbissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("family_card_id")->constrained("family_card_submissions");
            $table->string("name");
            $table->string("id_card")->nullable();
            $table->string("gender");
            $table->string("birthplace");
            $table->date("birthdate");
            $table->string("religion");
            $table->string("education");
            $table->string("profession");
            $table->string("family_relation");
            $table->string('status')->default(DocumentStatus::HOLD);
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
        Schema::dropIfExists('family_card_members_sumbissions');
    }
}
