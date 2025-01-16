`<?php

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
            Schema::create('products', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name', 255)->comment('Product name');
                $table->text('description')->nullable()->comment('Product description');
                $table->decimal('price', 12, 2)->comment('Product price');
                $table->integer('stock')->default(0)->comment('Product stock quantity');
                $table->string('image_url', 255)->nullable()->comment('URL for product image');
                $table->boolean('is_active')->default(true)->comment('Product availability status');

                $table->timestamps();
                $table->softDeletes();

                $table->integer('created_by')->default(0);
                $table->integer('updated_by')->default(0);
                $table->integer('deleted_by')->default(0);

                $table->index('name');
                $table->index('is_active');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('products');
        }
    };
