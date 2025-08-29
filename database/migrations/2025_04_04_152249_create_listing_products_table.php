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
        Schema::create('listing_products', function (Blueprint $table) {
            $table->id();
            $table->integer('productId')->default(0);
            $table->integer('sellerId')->default(0);
            $table->integer('categoryId')->default(0);
            $table->integer('subcategoryId')->default(0);
            $table->enum('type',['sale','purchase']);
            $table->integer('quantity')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('currencyId')->default(0);
            $table->date('expirydate')->nullable();
            $table->enum('status',['pending','published','sold','closed']);
            $table->text('description')->nullable();
            $table->string('main_image',255)->nullable();
            $table->string('other_image',255)->nullable();
            $table->string('slug_url',200)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_products');
    }
};
