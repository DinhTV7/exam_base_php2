@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Danh sách sản phẩm</h1>
    <a href="{{ route('admin/products/create') }}" class="btn btn-success">+ Thêm mới</a>
    <table class="table">
        <tbody>
            <th>STT</th>
            <th>Category name</th>
            <th>Name</th>
            <th>Image Thumbnail</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Action</th>
        </tbody>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['category_name'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>
                        <img src="{{ file_url($product['img_thumbnail']) }}" alt="Hình ảnh" width="70px">
                    </td>
                    <td>{{ !empty($product['created_at']) ? date('d-m-Y H:i:s', strtotime($product['created_at'])) : '' }}</td>
                    <td>{{ !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '' }}</td>
                    <td>
                        <a href="{{ route('admin/products/' . $product['id'] . '/edit') }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin/products/' . $product['id'] . '/delete') }}" method="POST" 
                            class="d-inline" onsubmit="return confirm('Xóa sản phẩm????')">
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

