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
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('customer_id');
            $table->string('name', 50);
            $table->integer('quantity');
            $table->integer('quantity_remind');
            $table->tinyInteger('status')->default(0)->comment('0:stock, 1:out_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
