<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TriggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('triggers')->insert([
        [
            'template_name'       => 'Add to Cart',
            'type'       => 'add_to_cart',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Remove Cart',
            'type'       => 'remove_cart',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Wish List',
            'type'       => 'wish_list',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Remove Wish List',
            'type'       => 'remove_wish_list',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Bidding',
            'type'       => 'bidding',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'bid_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Bid Accept',
            'type'       => 'bid_accept',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'bid_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Bid Reject',
            'type'       => 'bid_reject',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'bid_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Bid Counter',
            'type'       => 'bid_counter',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'bid_amount'],
                ['tags' => 'counter_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Buy Bid',
            'type'       => 'buy_bid',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'bid_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'user_type'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Buyer Bid Summary',
            'type'       => 'buyer_bid_summary',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'bid_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'user_type'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Seller Bid Summary',
            'type'       => 'seller_bid_summary',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'bid_amount'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'user_type'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Checkout',
            'type'       => 'checkout',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Order Generate',
            'type'       => 'order_generate',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'quantity'],
                ['tags' => 'status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Order Success',
            'type'       => 'order_success',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'quantity'],
                ['tags' => 'payment_status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Order Pending',
            'type'       => 'order_pending',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'product'],
                ['tags' => 'price'],
                ['tags' => 'quantity'],
                ['tags' => 'payment_status'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Add Wallet',
            'type'       => 'add_wallet',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'amount'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Remove Wallet',
            'type'       => 'remove_wallet',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'amount'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Shipping Details',
            'type'       => 'shipping_detail',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'charge'],
                ['tags' => 'date_time'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Login',
            'type'       => 'login',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'email'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Register',
            'type'       => 'register',
            'fields'      => json_encode([
                ['tags' => 'name'],
                ['tags' => 'email'],
                ['tags' => 'phone'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'template_name'       => 'Logout',
            'type'       => 'logout',
            'fields'      => json_encode([
                ['tags' => 'name'],
            ]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ]);
    }
}
