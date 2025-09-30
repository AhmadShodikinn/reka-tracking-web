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
        Schema::create('preorder_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('preorder_id')->constrained('preorders')->onDelete('cascade');
            $table->foreignId('master_item_id')->constrained('master_items')->onDelete('restrict');
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict');

            $table->integer('qty_po');
            $table->text('information')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preorder_items');
    }
};
