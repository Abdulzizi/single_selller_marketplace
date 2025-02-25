<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('street')->nullable()->after('status');
            $table->string('apartment')->nullable()->after('street');
            $table->string('city')->nullable()->after('apartment');
            $table->string('postcode')->nullable()->after('city');
            $table->string('country')->nullable()->after('postcode');
            $table->string('payment_method')->nullable()->after('country');
            $table->json('payment_details')->nullable()->after('payment_method');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'street',
                'apartment',
                'city',
                'postcode',
                'country',
                'payment_method',
                'payment_details'
            ]);
        });
    }
};
