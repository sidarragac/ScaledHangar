<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cartData = $request->session()->get('cart_data');
        $totalPrice = 0;
        if ($cartData) {
            $products = Product::whereIn('id', $cartData)->get();
            foreach ($products as $product) {
                $totalPrice += $product->getPrice();
            }
        } else {
            $products = [];
        }

        $viewData = [];
        $viewData['title'] = __('cart.title');
        $viewData['products'] = $products;
        $viewData['totalProducts'] = count($products);
        $viewData['totalPrice'] = $totalPrice;
        $viewData['msg'] = $request->input('msg', '');

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, string $id): View|RedirectResponse
    {
        $cartData = $request->session()->get('cart_data');

        if (! $cartData) {
            $cartData[$id] = $id;
            $request->session()->put('cart_data', $cartData);
            $msg = __('cart.added');
        } else {
            if (in_array($id, $cartData)) {
                $msg = __('cart.already_added');
            } else {
                $cartData[$id] = $id;
                $request->session()->put('cart_data', $cartData);
                $msg = __('cart.added');
            }
        }

        return redirect()->route('product.index', ['msg' => $msg]);
    }

    public function remove(Request $request, string $id): RedirectResponse
    {
        $cartData = $request->session()->get('cart_data');
        if ($cartData) {
            unset($cartData[$id]);
            $request->session()->put('cart_data', $cartData);
        }
        $msg = __('cart.removed');

        return redirect()->route('cart.index', ['msg' => $msg]);
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_data');

        return redirect()->route('product.index');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $cartData = $request->session()->get('cart_data');
        foreach ($cartData as $id) {
            $product = Product::find($id);
            $stock = $product->getStock();
            $sold = $product->getSold();
            $product->setSold($sold + 1);
            $product->setStock($stock - 1);
            $product->save();
        }
        $request->session()->forget('cart_data');

        return redirect()->route('product.index');
    }
}
