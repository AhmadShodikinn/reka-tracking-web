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
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['item_code', 'item_name', 'description']);
            $table->unsignedBigInteger('master_item_id')->after('travel_document_id');

            $table->foreign('master_item_id')->references('id')->on('master_items');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
        $table->dropForeign(['master_item_id']);
        $table->dropColumn('master_item_id');

        $table->string('item_code')->nullable();
        $table->string('item_name')->nullable();
        $table->text('description')->nullable();
    });
    }
};
