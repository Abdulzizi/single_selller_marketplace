<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 50)->comment('Role name, e.g., superadmin, seller, client');

            $table->timestamps();
            $table->softDeletes();

            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->integer('deleted_by')->default(0);

            $table->index('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
};
