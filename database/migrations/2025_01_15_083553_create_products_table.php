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

                // Foreign key
                $table->uuid('category_id')->comment('ID from categories table');

                $table->string('name', 150)
                    ->comment('Fill with name of product');
                $table->double('price')
                    ->comment('Fill price of product');
                $table->text('description')
                    ->comment('Fill description of product')
                    ->nullable();
                $table->text('slug')->unique()->comment('Product slug');
                $table->text('photo_desktop')
                    ->comment('Fill path of photo desktop product')
                    ->nullable();
                $table->text('photo_mobile')
                    ->comment('Fill path of photo mobile product')
                    ->nullable();
                $table->tinyInteger('is_available')
                    ->comment('Fill with "1" is product available, fill with "0" if product is unavailable')
                    ->default(0);

                $table->timestamps();
                $table->softDeletes();

                $table->integer('created_by')->default(0);
                $table->integer('updated_by')->default(0);
                $table->integer('deleted_by')->default(0);

                $table->index('name');
                $table->index('category_id');
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
