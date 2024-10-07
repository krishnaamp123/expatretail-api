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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_customer_product');
            $table->bigInteger('qty')->unsigned();
            $table->boolean('is_checkout')->default(false);

            $table->foreign('id_customer')->references('id')->on('users');
            $table->foreign('id_customer_product')->references('id')->on('customer_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
