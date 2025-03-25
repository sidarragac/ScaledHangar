<?php

namespace App\Http\Controllers;

use App\Models\WishItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WishItemController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $viewData = [];
        $viewData['title'] = __('wish_items.title');
        $viewData['wishItems'] = $user->getWishItems();

        return view('wish_items.index')->with('viewData', $viewData);
    }

    public function addItem(Request $request, string $productId): RedirectResponse
    {
        $user = Auth::id();
        $viewData = [];
        if (WishItem::where('user_id', $user)->where('product_id', $productId)->exists()) {
            $msg = __('wish_items.already_added');
        } else {
            WishItem::create(
                [
                    'user_id' => $user,
                    'product_id' => $productId,

                ]
            );
            $msg = __('wish_items.added');
        }

        return redirect()->route('product.index', ['msg' => $msg]);
    }

    public function removeItem(Request $request, string $productId): RedirectResponse
    {
        $user = Auth::id();
        $wishItem = WishItem::where('user_id', $user)->where('product_id', $productId)->first();
        if (! $wishItem) {
            return redirect()->route('wish_items.index');
        }
        $wishItem->delete();

        return redirect()->route('wish_items.index');
    }
}
