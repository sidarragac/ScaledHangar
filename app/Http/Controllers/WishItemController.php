<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\WishItem;

class WishItemController extends Controller
{
    public function index(Request $request)//: View
    {
    // $user = auth()->user();
    // $viewData['wishItems'] = $user->getWishItems();

    // return view('wish_items.index')->with('viewData', $viewData);
    }
}
