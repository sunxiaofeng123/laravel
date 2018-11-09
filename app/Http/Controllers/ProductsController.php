<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    //展示列表
    public function index(Request $request)
    {
        $builder = Product::query()->where('on_sale', true);

        if ($search = $request->input('order', '')) {
            $like = '%'.$search.'%';
            $builder->where(function($query)use($like){
                $query->where('title', 'like', $like)
                    ->orWhere('discription', 'like', $like)
                    ->orWhereHas('skus', function($query) use($like){
                        $query->where('title', 'like', $like)
                            ->orWhere('discription', 'like', $like);
                    });
            });
        }

        if ($order = $request->input('title','')) {
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)){
                if (in_array($m[1], ['price', 'sold_count', 'rating'])){
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $builder->paginate(16);

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
