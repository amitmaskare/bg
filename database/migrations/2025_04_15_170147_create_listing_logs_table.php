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
        Schema::create('listing_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('listingId')->default(0);
            $table->integer('userId')->default(0);
            $table->integer('adminId')->default(0);
            $table->string('action')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_logs');
    }
};
