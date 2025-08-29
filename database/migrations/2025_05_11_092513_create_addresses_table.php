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
    Schema::create('addresses', function (Blueprint $table) {
        $table->id();

        $table->unsignedBigInteger('user_id')->nullable(); // optional user relation
        $table->string('address_line');
        $table->string('city');
        $table->string('state')->nullable();
        $table->string('postal_code');
        $table->string('country');
        $table->string('type')->default('home'); // home, work, etc.

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
