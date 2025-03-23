<?php

namespace App\Http\Controllers\admin;

use App\Interfaces\ImageStorage;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/product.title_index');
        $viewData['products'] = Product::all();
        $viewData['msg'] = '';

        if ($request->has('msg')) {
            $viewData['msg'] = __('admin/product.msg_'.$request->input('msg'));
        }

        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/product.title_show', ['id' => $id]);
        $viewData['product'] = Product::findOrFail($id);

        return view('admin.product.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/product.title_create');
        $viewData['categories'] = Category::all();

        return view('admin.product.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        Product::validate($request);

        $productData = $request->only('name', 'description', 'price', 'brand', 'stock', 'category_id');

        if ($request->hasFile('image')) {
            $imageStorageInterface = app(ImageStorage::class);
            $imagePath = $imageStorageInterface->store($request, 'products');
        } else {
            $imagePath = 'img/products/default.jpg';
        }

        $productData['imagePath'] = $imagePath;
        
        Product::create($productData);

        return redirect()->route('admin.product.index', ['msg' => 'create_success']);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/product.title_edit');
        $viewData['product'] = Product::findOrFail($id);
        $viewData['categories'] = Category::all();

        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        Product::validate($request);

        $product = Product::findOrFail($id);

        $filledFields = $request->only(array_keys($request->all()));
        $product->fill($filledFields);

        if ($request->hasFile('image')) {
            $imageStorageInterface = app(ImageStorage::class);
            if ($product->getImagePath() !== 'img/products/default.jpg') {
                $imageStorageInterface->delete($product->getImagePath());
            }
            $imagePath = $imageStorageInterface->store($request, 'products');
            $product->setImagePath($imagePath);
        }

        $product->save();

        return redirect()->route('admin.product.index', ['msg' => 'edit_success']);
    }

    public function delete(string $id): RedirectResponse
    {
        $product = Product::find($id);
        $productImagePath = $product->getImagePath();

        $imageStorageInterface = app(ImageStorage::class);
        $imageStorageInterface->delete($productImagePath);

        $product->delete();

        return redirect()->route('admin.product.index', ['msg' => 'delete_success']);
    }
}
