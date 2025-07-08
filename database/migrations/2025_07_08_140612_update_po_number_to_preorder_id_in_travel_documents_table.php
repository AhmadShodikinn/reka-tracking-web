<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('travel_document', function (Blueprint $table) {
            $table->dropColumn('po_number');

            $table->foreignId('preorder_id')
                  ->nullable()
                  ->after('send_to_id')
                  ->constrained('preorders')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('travel_document', function (Blueprint $table) {
            $table->dropForeign(['preorder_id']);
            $table->dropColumn('preorder_id');

            $table->string('po_number')->after('project_id');
        });
    }
};
