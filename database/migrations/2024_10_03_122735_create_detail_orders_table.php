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
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger("id_customer_product");
            $table->unsignedBigInteger('qty')->default(0);
            $table->unsignedBigInteger('price')->default(0);

            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_customer_product')->references('id')->on('customer_products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
