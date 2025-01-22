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
            $table->uuid('id')->primary();

            // Foreign key
            $table->uuid('user_id')->nullable()->comment('ID from users table (null for guests)');
            $table->uuid('product_id')->comment('ID from products table');
            $table->uuid('product_detail_id')->nullable()
                ->comment('ID from product_details table');

            $table->integer('quantity')->comment('Quantity of product in the cart');

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);

            $table->index('user_id');
            $table->index('product_id');
            $table->index('product_detail_id');
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
