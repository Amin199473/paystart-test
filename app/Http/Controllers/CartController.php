<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        Cart::instance('product')->add($product->id, $product->name, 1, $product->price,)
            ->associate('App\Models\Product');

        return response()->json([
            'status' => true,
            'message' => 'محصول به سبد خرید افزوده شد'
        ]);
    }

    public function removeItemFromCart($rowId)
    {
        $qty = Cart::instance('product')->remove($rowId);
        return response()->json(['status' => true, 'message' => 'محصول با موفقیت حذف شد ']);
    }

    public function getCartContent()
    {
        $cartContent = Cart::instance('product')->content();

        return response()->json(
            ['status' => true, 'cartContent' => $cartContent]
        );
    }

    public function incrementCart($rowId)
    {
        $qty = Cart::instance('product')->get($rowId)->qty;
        Cart::instance('product')->update($rowId, $qty + 1);
        return response()->json(['status' => true, 'message' => 'تعداد افزایش یافت']);
    }

    public function decrementCart($rowId)
    {
        $qty = Cart::instance('product')->get($rowId)->qty;
        Cart::instance('product')->update($rowId, $qty - 1);
        return response()->json(['status' => true, 'message' => 'تعداد کاهش یافت']);
    }

    public function getCartTotal()
    {
        return response()->json([
            'status' => true,
            'cartTotal' => Cart::instance('product')->total()
        ]);
    }
}
