@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
<h1>{{ $viewData['title'] }}</h1>
@if ($viewData['msg'])
<p class="alert alert-success">{{ $viewData['msg'] }}</p>
@endif
<a href="{{ route('admin.category.create') }}" class="btn btn-primary">{{__('admin/category.create_category_btn')}}</a>
<table class="table mt-3">
    <thead>
        <tr>
            <th>{{__('admin/category.id')}}</th>
            <th>{{__('admin/category.name')}}</th>
            <th>{{__('admin/category.actions')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($viewData['categories'] as $category)
        <tr>
            <td>{{ $category->getId() }}</td>
            <td>{{ $category->getName() }}</td>
            <td>
                <a href="{{ route('admin.category.show', $category->id) }}"
                    class="btn btn-info">{{__('admin/category.action_btn_show')}}</a>
                <a href="{{ route('admin.category.edit', $category->id) }}"
                    class="btn btn-warning">{{__('admin/category.action_btn_edit')}}</a>
                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure?');">{{__('admin/category.action_btn_delete')}}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection