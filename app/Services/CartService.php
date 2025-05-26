<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCart(Request $request): array
    {
        return $request->session()->get('cart_data', []);
    }

    public function addToCart(Request $request, string $productId, int $quantity = 1): void
    {
        $cart = $this->getCart($request);
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        $request->session()->put('cart_data', $cart);
    }

    public function getTotalPrice(array $cartData, Collection $products): float
    {
        $products = Product::whereIn('id', array_keys($cartData))->get();
        $total = 0;

        foreach ($products as $product) {
            $total += $product->getPrice() * $cartData[$product->getId()];
        }

        return $total;
    }

    public function checkout(array $cartData): bool
    {
        foreach ($cartData as $id => $quantity) {
            $product = Product::find($id);

            if (!$product || $product->getStock() < $quantity) {
                return false; // Or throw an exception
            }
        }

        DB::transaction(function () use ($cartData) {
            foreach ($cartData as $id => $quantity) {
                $product = Product::find($id);
                $product->setSold($product->getSold() + $quantity);
                $product->setStock($product->getStock() - $quantity);
                $product->save();
            }
        });

        return true;
    }
}
