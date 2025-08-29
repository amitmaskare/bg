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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
             $table->string('orderId',100); 
            $table->integer('bidId')->default(0); 
            $table->integer('sellerId')->default(0); 
            $table->integer('buyerId')->default(0); 
            $table->enum('order_type',['buy_now', 'bid'])->default('buy_now')->nullable(); 
            $table->enum('status', ['pending', 'processing', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->date('order_date')->nullable(); 
            $table->integer('shipping_address_id')->nullable(); 
            $table->integer('billing_address_id')->nullable(); 
            $table->integer('shipping_method_id')->nullable(); 
            $table->integer('shipping_provider_id')->nullable(); 
            $table->string('tracking_number',100)->nullable(); 
            $table->integer('payment_method_id')->nullable(); 
            $table->string('transaction_id',100)->nullable(); 
            $table->text('cancellation_reason')->nullable(); 
            $table->string('cancelled_by',100)->nullable(); 
            $table->text('notes')->nullable(); 
            $table->string('order_tracking_url',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
