<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::table('travel_document', function (Blueprint $table) {
            if (Schema::hasColumn('travel_document', 'send_to_id')) {
                $table->dropForeign(['send_to_id']);
                $table->dropColumn('send_to_id');
            }
        });

        Schema::table('travel_document', function (Blueprint $table) {
            $table->unsignedBigInteger('send_to_id')->nullable()->after('date_no_travel_document');
            $table->foreign('send_to_id')->references('id')->on('partners')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_document', function (Blueprint $table) {
            $table->dropForeign(['send_to_id']);
            $table->dropColumn('send_to_id');
        });
    }
};
