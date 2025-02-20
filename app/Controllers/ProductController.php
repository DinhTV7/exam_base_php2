<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $products = $this->productModel->getAllProducts();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryModel->all();
        return view('admin.products.create', compact('categories'));
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];

            // Validate
            $errors = [];

            if (empty($name)) {
                $errors['name'] = 'Vui lòng nhập tên sản phẩm.';
            } elseif (strlen($name) > 255) {
                $errors['name'] = 'Tên sản phẩm ko được quá 255 ký tự.';
            }

            if (!empty($description) && strlen($description) > 255) {
                $errors['description'] = 'Mô tả sản phẩm ko được quá 255 ký tự.';
            }

            if (!empty($errors)) {
                $categories = $this->categoryModel->all();
                return view('admin.products.create', compact('categories', 'errors'));
            }

            // Xử lý ảnh
            if (is_upload('img_thumbnail')){
                // Nếu đẩy lên là 1 ảnh
                $img_thumbnail = $this->uploadFile($_FILES['img_thumbnail'], 'products');
            } else {
                $img_thumbnail = null;
            }

            $this->productModel->create([
                'category_id' => $category_id,
                'name' => $name,
                'img_thumbnail' => $img_thumbnail,
                'description' => $description,
                'created_at' => date("Y-m-d H:i:s")
            ]);

            redirect('admin/products');
        }
    }

    public function edit($id)
    {
        $categories = $this->categoryModel->all();
        $product = $this->productModel->find($id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product = $this->productModel->find($id);

            // Lấy ra dữ liệu
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $img_thumbnail = $product['img_thumbnail']; // Mặc định ảnh cũ sẽ được giữ lại

            // Validate
            $errors = [];

            if (empty($name)) {
                $errors['name'] = 'Vui lòng nhập tên sản phẩm.';
            } elseif (strlen($name) > 255) {
                $errors['name'] = 'Tên sản phẩm ko được quá 255 ký tự.';
            }

            if (!empty($description) && strlen($description) > 255) {
                $errors['description'] = 'Mô tả sản phẩm ko được quá 255 ký tự.';
            }

            if (!empty($errors)) {
                $categories = $this->categoryModel->all();
                return view('admin.products.edit', compact('categories', 'errors', 'product'));
            }

            // Xử lý ảnh
            if (is_upload('img_thumbnail')){
                // Xóa ảnh cũ nếu tồn tại
                if (!empty($product['img_thumbnail']) && file_exists($product['img_thumbnail'])) {
                    unlink($product['img_thumbnail']);
                }
                $img_thumbnail = $this->uploadFile($_FILES['img_thumbnail'], 'products');
            }

            $this->productModel->update($id, [
                'category_id' => $category_id,
                'name' => $name,
                'img_thumbnail' => $img_thumbnail,
                'description' => $description,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            redirect('admin/products');
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product = $this->productModel->find($id);

            // Xóa ảnh nếu tồn tại
            if (!empty($product['img_thumbnail']) && file_exists($product['img_thumbnail'])) {
                unlink($product['img_thumbnail']);
            }

            $this->productModel->delete($id);
            redirect('admin/products');
        }
    }
}