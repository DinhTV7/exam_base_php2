@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')
    <h1>Sửa sản phẩm</h1>
    <form action="{{ route('admin/products/' . $product['id'] . '/update') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh mục:</label>
            <select name="category_id" id="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" 
                        {{ $category['id'] == $product['category_id'] ? 'selected' : '' }}>
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm:</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm"
                value="{{ $product['name'] }}">
            @if (!empty($errors['name']))
                <p class="text-danger">{{ $errors['name'] }}</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="img_thumbnail" class="form-label">Hình ảnh cũ:</label>
            <br>
            <img src="{{ file_url($product['img_thumbnail']) }}" alt="Hình ảnh" width="150px">
            <br>
            <label for="img_thumbnail" class="form-label">Hình ảnh mới (Nếu muốn thay đổi):</label>
            <input type="file" name="img_thumbnail" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Nhập mô tả">{{ $product['description'] }}</textarea>
            @if (!empty($errors['description']))
                <p class="text-danger">{{ $errors['description'] }}</p>
            @endif
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-warning">Cập nhật</button>
        </div>
    </form>
@endsection
