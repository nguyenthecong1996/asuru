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
        Schema::create('store_receipts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('store_id');
            $table->integer('receipt_id');
            $table->decimal('weight_different', 7,3);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_receipts');
    }
};
