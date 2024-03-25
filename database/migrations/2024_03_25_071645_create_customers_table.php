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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('company_name', 255);
            $table->string('customer_name', 50);
            $table->string('email', 100)->unique('email');
            $table->string('post_code', 30);
            $table->string('address', 255);
            $table->string('customer_phone', 20);
            $table->string('company_phone', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
