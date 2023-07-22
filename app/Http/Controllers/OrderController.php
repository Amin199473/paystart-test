<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('checkout.index');
    }

    public function orderDone(Request $request)
    {
        if ($request->credit_card != auth()->user()->credit_card) {
            return redirect()->back()->with([
                'message' => 'شماره کارت ثبت شده با شماره کارت پرداختی مغایرت دارد'
            ]);
        }

        $order = new Order();
        $order->user_id = auth()->id();
        $order->mobile = $request->mobile;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->province = $request->province;
        $order->country = $request->country;
        $order->credit_card = $request->credit_card;
        $order->zipcode = $request->zipcode;
        $order->total = Cart::instance('product')->total();
        $order->status = 'pending';
        $order->save();

        $string = "5000#{$order->id}#http://127.0.0.1:8000/thankYou";

        $sign = hash_hmac('sha512', $string, env('PAYSTAR_SECRET'));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 0yovdk2l6e143'
        ])->post('https://core.paystar.ir/api/pardakht/create', [
            "amount" => 5000,
            "order_id" => $order->id,
            "callback" => "http://127.0.0.1:8000/thankYou",
            "sign" => $sign

        ]);

        if ($response['message'] == "درخواست نامعتبر") {
            return redirect()->back()->with(['message' => "درخواست نامعتبر"]);
        }

        if ($response['message'] == "موفق") {
            Transaction::create([
                'ref_num' => $response['data']['ref_num'],
                'order_id' => $response['data']['order_id'],
                'payment_amount' => $response['data']['payment_amount'],
            ]);
            $response = $response['data'];
            return view('factor.index', compact('response'));
        }
    }
}
