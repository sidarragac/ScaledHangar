<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product; 

class OrderController extends Controller
{
    public function confirm(Request $request)
    {
        $user = Auth::user();
        $cartItems = session('cart_data', []);

        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', __('order.empty_cart'));
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $this->calculateTotal($cartItems),
            'status' => 'completed'
        ]);

        foreach ($cartItems as $productId) {
            $product = Product::findOrFail($productId);
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        $request->session()->forget('cart_data');

        return redirect()->route('order.confirmation', ['order' => $order->id]);
    }

    public function showConfirmation(Order $order)
    {
        return view('orders.confirmation', [
            'order' => $order->load('items.product'),
            'title' => __('order.confirmation_title')
        ]);
    }

    private function calculateTotal($cartItems)
    {
        return Product::whereIn('id', $cartItems)->sum('price');
    }
}