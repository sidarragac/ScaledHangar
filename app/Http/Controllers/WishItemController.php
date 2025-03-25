<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\WishItem;
use Illuminate\Http\RedirectResponse;

class WishItemController extends Controller
{
    public function index(Request $request): View
    {
    $user = auth()->user();
    $viewData = [];
    $viewData['title'] = __('wish_items.title');
    $viewData['wishItems'] = $user->getWishItems();

    return view('wish_items.index')->with('viewData', $viewData);
    }

    public function addItem(Request $request, string $productId): RedirectResponse
    {
    $user = auth()->id();
    $viewData = [];
    if (WishItem::where('user_id', $user)->where('product_id', $productId)->exists()) {
        $msg = __('wish_items.already_added');
    }else{
    WishItem::create(
        [
            'user_id' => $user,
            'product_id' => $productId,

        ]
    );
    $msg= __('wish_items.added');
}
    return redirect()->route('product.index',['msg' => $msg]);
    }

    public function removeItem(Request $request, string $productId): RedirectResponse
    {
    $user = auth()->id();
    $wishItem = WishItem::where('user_id', $user)->where('product_id', $productId)->first();
    if (!$wishItem) {
        return redirect()->route('wish_items.index');
    }
    $wishItem->delete();
    return redirect()->route('wish_items.index');
    }
}
