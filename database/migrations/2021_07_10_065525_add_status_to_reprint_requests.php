<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\enums\DocumentStatus;

class AddStatusToReprintRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reprint_requests', function (Blueprint $table) {
            $table->string('status')->default(DocumentStatus::HOLD);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reprint_requests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
