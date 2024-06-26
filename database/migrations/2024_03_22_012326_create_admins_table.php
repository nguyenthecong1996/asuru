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
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('kata_first_name', 30);
            $table->string('kata_last_name', 30);
            $table->string('email', 100)->unique('email');
            $table->string('password', 100);
            $table->string('post_code', 30);
            $table->string('address', 255)->nullable();
            $table->string('phone', 20);
            $table->tinyInteger('role')->default(1)->comment('0:super_admin, 1:admin, 2:staff');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
