<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory(20)->create();

        Customer::factory(10)->create()->each(function ($customer) {
            $orders = Order::factory(2)->create([
                'customer_id' => $customer->id,
            ]);

            foreach ($orders as $order) {
                OrderItem::factory(rand(1, 5))->create([
                    'order_id' => $order->id,
                    'product_id' => Product::inRandomOrder()->first()->id,
                ]);

                CartItem::factory()->create([
                    'order_id' => $order->id,
                ]);
            }
        });
    }
}
