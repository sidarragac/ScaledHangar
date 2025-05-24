<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::filterProducts($request);

        $brands = Product::select('brand')->distinct()->pluck('brand');
        $categories = Category::all();

        $viewData = [];
        $viewData['title'] = __('product.title');
        $viewData['products'] = $products;
        $viewData['brands'] = $brands;
        $viewData['categories'] = $categories;
        $viewData['msg'] = $request->input('msg', '');

        return view('products.index')->with('viewData', $viewData);
    }

    public function show(string $id): View|RedirectResponse
    {
        try {
            $product = Product::findOrFail($id);
            $viewData = [];
            $viewData['title'] = __('product.title');
            $viewData['product'] = $product;
            $viewData['relatedProducts'] = Product::relatedProducts($id);

            return view('products.show')->with('viewData', $viewData);
        } catch (\Exception $e) {
            return redirect()->route('product.index');
        }

    }
}
