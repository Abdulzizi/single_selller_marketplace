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
            $table->uuid('id')->primary();

            // Foreign key
            $table->uuid('user_id')->comment('ID from users table');
            $table->uuid('product_detail_id')->nullable()
                ->comment('ID from product_details table');

            $table->decimal('total_price', 12, 2)->comment('Total price of the order');
            $table->enum('status', ['pending', 'processing', 'shipped', 'completed', 'cancelled'])
                ->default('pending')
                ->comment('Order status');

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);

            $table->index('user_id');
            $table->index('status');
            $table->index('product_detail_id');

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
