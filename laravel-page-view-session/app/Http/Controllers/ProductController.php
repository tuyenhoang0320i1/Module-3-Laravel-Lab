<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function show($id)
    {
        $productKey = 'product_' . $id;

        // Kiem tra Session cua san pham co ton tai hay khong
        // Neu khong ton tai se tu dong tang truong view_count len 1 dong thời tạo session lưu trữ key sản phẩm.
        if (!Session::has($productKey)) {
            Product::where('id', $id)->increment('view_count');
            Session::put($productKey,1);
        }

        // Su dung Eloquent de lay ra san pham theo id
        $product = Product::find($id);

        // Tra ve view
        return view('show', compact('product'));
    }
}
