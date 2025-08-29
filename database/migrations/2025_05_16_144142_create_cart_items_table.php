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
    Schema::create('cart_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // assuming the cart is user-specific
        $table->unsignedBigInteger('listing_id');
        $table->integer('quantity')->default(1);
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('listing_id')->references('id')->on('listing_products')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
