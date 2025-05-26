<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request): View
    {
        $cartData = $request->session()->get('cart_data', []);
        $totalPrice = 0;
        if ($cartData) {
            $products = Product::whereIn('id', array_keys($cartData))->get();
            $totalPrice = $this->cartService->getTotalPrice($cartData, $products);
        } else {
            $products = [];
        }

        $viewData = [];
        $viewData['title'] = __('cart.title');
        $viewData['products'] = $products;
        $viewData['productsQuantity'] = $cartData ?? [];
        $viewData['totalProducts'] = array_sum($cartData);
        $viewData['totalPrice'] = $totalPrice;
        $viewData['msg'] = $request->input('msg', '');

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request, string $id): View|RedirectResponse
    {
        $product = Product::find($id);
        $quantity = (int) $request->input('cantidad', 1);
        if (! $product) {
            return redirect()->route('product.index')->with('msg', __('cart.product_not_found'));
        }
        if ($product->getStock() <= 0) {
            return redirect()->route('product.index')->with('msg', __('cart.out_of_stock'));
        }
        $msg = __('cart.added', ['product' => $product->getName()]);
        $this->cartService->addToCart($request, $id, $quantity);

        // dd($request->session()->get('cart_data'));

        return redirect()->route('product.index', ['msg' => $msg]);
    }

    public function remove(Request $request, string $id): RedirectResponse
    {
        $cartData = $this->cartService->getCart($request);
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
        $cartData = $this->cartService->getCart($request);

        if (! $this->cartService->checkout($cartData)) {
            return redirect()->route('cart.index')->with('msg', __('cart.out_of_stock'));
        }

        return redirect()->route('order.confirm');
    }
}
