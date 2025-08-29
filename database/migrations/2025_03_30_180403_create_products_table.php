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
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId');
            $table->string('name',100)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('brandId')->default(0);
            $table->integer('categoryId')->default(0);
            $table->integer('subcategoryId')->default(0);
            $table->string('specification',255)->nullable();
            $table->integer('weightId')->default(0);
            $table->string('dimension',100)->nullable();
            $table->string('manufacture',100)->nullable();
            $table->string('supplier',100)->nullable();
            $table->string('upc',100)->nullable();
            $table->string('ean',100)->nullable();
            $table->string('video',100)->nullable();
            $table->string('keyword',100)->nullable();
            $table->string('slug_url',200)->nullable();
            $table->enum('status',['Active','Inactive']);
            $table->softDeletes();
            $table->timestamps();
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
