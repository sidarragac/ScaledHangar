<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/category.title_index');
        $viewData['categories'] = Category::all();
        $viewData['msg'] = '';

        if ($request->has('msg')) {
            $viewData['msg'] = __('admin/category.msg_'.$request->input('msg'));
        }

        return view('admin.category.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $category = Category::find($id);
        $associatedProducts = $category->getProducts();

        $viewData = [];
        $viewData['title'] = __('admin/category.title_show', ['id' => $id]);
        $viewData['category'] = $category;
        $viewData['associatedProducts'] = $associatedProducts;

        return view('admin.category.show')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/category.title_create');

        return view('admin.category.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        Category::validate($request);

        Category::create($request->only('name'));

        return redirect()->route('admin.category.index', ['msg' => 'create_success']);
    }

    public function edit(string $id): View
    {
        $viewData = [];
        $viewData['title'] = __('admin/category.title_edit');
        $viewData['category'] = Category::findOrFail($id);

        return view('admin.category.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        Category::validate($request);

        $category = Category::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->route('admin.category.index', ['msg' => 'edit_success']);
    }

    public function delete(string $id): RedirectResponse
    {
        Category::destroy($id);

        return redirect()->route('admin.category.index', ['msg' => 'delete_success']);
    }
}
