@extends('layouts.admin')

@section('title', 'Thêm mới sản phẩm')

@section('content')
    <h1>Thêm mới sản phẩm</h1>
    <form action="{{ route('admin/products/store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục:</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm:</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
            @if (!empty($errors['name']))
                <p class="text-danger">{{ $errors['name'] }}</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="img_thumbnail" class="form-label">Hình ảnh:</label>
            <input type="file" name="img_thumbnail" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Nhập mô tả"></textarea>
            @if (!empty($errors['description']))
                <p class="text-danger">{{ $errors['description'] }}</p>
            @endif
        </div>

        <div class="mb-3">
            <button type="reset" class="btn btn-primary">Nhập lại</button>
            <button type="submit" class="btn btn-success">Thêm mới</button>
        </div>
    </form>
@endsection
