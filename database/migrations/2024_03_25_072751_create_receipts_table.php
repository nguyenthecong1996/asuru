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
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('customer_id');
            $table->string('name', 50);
            $table->string('car_number', 50)->nullable();
            $table->date('date');
            $table->tinyInteger('status')->default(0)->comment('0:import, 1:export');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
