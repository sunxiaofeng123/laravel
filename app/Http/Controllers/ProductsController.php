<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    //展示列表
    public function index(Request $request)
    {
        $products = Product::query()->where('on_sale', true)->paginate(16);

        return view('products.index', ['products' => $products]);
    }

    //展示详情
    public function show(Request $request, Product $product)
    {
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        return view('products.show', ['product' => $product]);
    }
}
