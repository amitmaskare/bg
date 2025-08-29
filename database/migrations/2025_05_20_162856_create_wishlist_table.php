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
    Schema::create('wishlist', function (Blueprint $table) {
        $table->id(); // ID INT PRIMARY KEY AUTO_INCREMENT
        $table->unsignedBigInteger('user_id'); // UserID INT NOT NULL
        $table->unsignedBigInteger('product_id'); // ProductID INT NOT NULL
        $table->timestamp('added_at')->useCurrent(); // AddedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
