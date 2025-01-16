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
        Schema::create('order_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id')->comment('ID from orders table');
            $table->uuid('product_id')->comment('ID from products table');
            $table->integer('quantity')->comment('Quantity of product ordered');
            $table->decimal('price', 12, 2)->comment('Price of the product at the time of order');
            $table->decimal('total', 12, 2)->comment('Total price for this product line');

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);

            $table->index('order_id');
            $table->index('product_id');

            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
