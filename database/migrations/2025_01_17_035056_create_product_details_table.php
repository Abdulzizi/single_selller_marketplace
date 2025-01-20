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
        Schema::create('product_details', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Foreign key
            $table->uuid('product_id')->comment('ID from products table');

            $table->string('type')
                ->comment('Fill with type of detail product');
            $table->string('description', 255)
                ->comment('Fill with description of detail product, ex : L sized tshirt');
            $table->double('price')->default(0)
                ->comment('Fill price of product details');

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);

            $table->index('product_id');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
