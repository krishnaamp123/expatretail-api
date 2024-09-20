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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_customer_product');
            $table->bigInteger('qty')->unsigned();
            $table->bigInteger('total_price')->unsigned();

            $table->foreign('id_customer')->references('id')->on('users');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_customer_product')->references('id')->on('customer_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
