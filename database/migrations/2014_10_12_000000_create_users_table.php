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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_group');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('customer_name', 100);
            $table->string('pic_name', 100);
            $table->string('pic_phone', 15);
            $table->string('address', 100);
            $table->timestamps();

            $table->foreign('id_group')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
