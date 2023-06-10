<?php

namespace App\Http\Controllers\Api\v1;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\updateCartItemRequest;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
   public function addToCart(AddToCartRequest $request)
    {
       
        $data = $request->validated();
        // Добавление продукта в корзину текущего пользователя
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = Auth::id();
            $cart->save();
        }

        $cart->products()->attach($request->product_id, ['quantity' => $request->quantity]);

        return response()->json(['message' => 'Product added to cart']);
    }

    public function updateCartItem(updateCartItemRequest $request, $cartId)
    {
        // Валидация входных данных
        $data = $request->validated();

        // Обновление количества продукта в корзине текущего пользователя
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);

        $cart->products()->updateExistingPivot($request->product_id, ['quantity' => $request->quantity]);

        return response()->json(['message' => 'Cart item updated']);
    }

    public function removeCartItem($cartId)
    {
        // Удаление продукта из корзины текущего пользователя
        $cart = Cart::where('user_id', Auth::id())->findOrFail($cartId);

        $cart->products()->detach($request->product_id);

        return response()->json(['message' => 'Cart item removed']);
    }
}
