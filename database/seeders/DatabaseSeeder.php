<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(50)->create();
        Cart::factory(10)->create();
        Order::factory(10)->create();
        OrderItem::factory(50)->create();
    }
}