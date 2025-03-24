<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($request->filled('sort_sold')) {
            $query->orderBy('sold', $request->input('sort_sold') === 'desc' ? 'desc' : 'asc');
        }

        if ($request->filled('sort_price')) {
            $query->orderBy('price', $request->input('sort_price') === 'desc' ? 'desc' : 'asc');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('brands')) {
            $brands = is_array($request->input('brands')) ? $request->input('brands') : explode(',', $request->input('brands'));
            $query->whereIn('brand', $brands);
        }

        $products = $query->get();

        $brands = Product::select('brand')->distinct()->pluck('brand');
        $categories = Category::all();

        $viewData = [];
        $viewData['title'] = __('product.title');
        $viewData['products'] = $products;
        $viewData['brands'] = $brands;
        $viewData['categories'] = $categories;

        return view('products.index')->with('viewData', $viewData);
    }
}
