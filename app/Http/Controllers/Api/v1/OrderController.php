<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\Order\PlaceOrderRequest;

class OrderController extends Controller
{

    public function placeOrder(PlaceOrderRequest $request)
{
    $data = $request->validated();


    $cart = Cart::where('user_id', $request->user()->id)->firstOrFail();

    // Создание заказа
    $order = new Order();
    $order->user_id = $request->user()->id;
    $order->customer_contact = $request->customer_contact;
    $order->total_price = $request->total_price;
    $order->save();

    // Добавление продуктов из корзины в заказ
    foreach ($cart->products as $product) {
        $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);
    }

    // Очистка корзины
    $cart->products()->detach();

    return response()->json(['message' => 'Order placed']);
}

public function index(Request $request)
{

    // Получение списка оформленных заказов текущего пользователя
    $orders = Order::where('user_id', $request->user()->id)->get();

    return response()->json($orders);
}

}
