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
        Schema::create('bids', function (Blueprint $table) {
            $table->id('bidId');
            $table->integer('listingId')->default(0);
            $table->integer('bidderId')->default(0);
            $table->decimal('amount', 10, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->enum('status',['pending','approved','rejected','countered'])->default('pending');
            $table->dateTime('bid_time')->nullable();
            $table->decimal('counter_offer_amount', 10, 2)->default(0);
            $table->text('counter_offer_reason')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
