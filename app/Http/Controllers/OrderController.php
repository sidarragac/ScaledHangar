

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class Controller extends BaseController
{
    public function confirm(Request $request)
    {
        // Get authenticated user
        $user = Auth::user();
        
        // Get cart items from session
        $cartItems = session('cart_data', []);
        
        // Validate cart not empty
        if (empty($cartItems)) {
            return redirect()->route('cart.index')
                ->with('error', __('order.empty_cart'));
        }

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $this->calculateTotal($cartItems),
            'status' => 'completed',
            'order_number' => 'ORD-' . strtoupper(uniqid())
        ]);

        // Create order items
        foreach ($cartItems as $productId) {
            $product = Product::findOrFail($productId);
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        // Clear the cart
        $request->session()->forget('cart_data');

        // Redirect to confirmation page
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