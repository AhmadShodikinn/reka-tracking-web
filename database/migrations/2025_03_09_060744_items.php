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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_document_id')->constrained('travel_document'); // Foreign key ke travel_document
            $table->string('item_code');
            $table->string('item_name');
            $table->integer('qty_send');
            $table->integer('total_send');
            $table->integer('qty_po');
            $table->string('unit');
            $table->text('description');
            $table->text('information')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
