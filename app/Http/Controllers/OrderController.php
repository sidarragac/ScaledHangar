<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', Auth::id())->get();
        
        $viewData = [];
        $viewData['title'] = __('order.title_index');
        $viewData['orders'] = $orders;

        return view('order.index')->with('viewData', $viewData);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $cartItems = $request->session()->get('cart_data');

        if (!$cartItems) {
            return redirect()->route('product.index');
        }

        $order = new Order;
        $order->setUserId(Auth::id());
        $order->setStatus('created');
        $order->setTotal(0);
        $order->save();

        $totalPrice = 0;
        
        $products = Product::findMany(array_keys($cartItems));

        foreach ($products as $product) {
            $orderItem = new OrderItem;
            $orderItem->setOrderId($order->getId());
            $orderItem->setProductId($product->getId());
            $orderItem->save();

            $totalPrice += $product->getPrice();
        }

        $order->setTotal($totalPrice);
        $order->setStatus('confirmed');
        $order->save();

        $request->session()->forget('cart_data');

        return redirect()->route('order.show', ['id' => $order->getId()]);
    }

    public function show(string $id): View
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', $id)->get();
        $products = Product::findMany($orderItems->pluck('product_id')->toArray());

        $viewData = [];
        $viewData['title'] = __('order.title_show', ['id' => $id]);
        $viewData['totalProducts'] = count($products);
        $viewData['totalPrice'] = $order->getTotal();
        $viewData['order'] = $order;
        $viewData['products'] = $products;

        return view('order.show')->with('viewData', $viewData);
    }

}
