<?php
/**
 * Created by PhpStorm.
 * User: sunxiaofeng
 * Date: 2018/12/9
 * Time: 20:09
 */

namespace App\Services;

use Auth;
use App\Models\CartItem;

class CartService
{
    public function get()
    {
        return Auth::user()->cartItems()->with(['productSku.product'])->get();
    }

    public function add($skuId, $amount)
    {
        $user = Auth::user();
        //从数据库中查询该商品是否已经在购物车
        if ($item = $user->cartItems()->where('product_sku_id', $skuId)->first()) {

            $item->update([
                'amount' => $item->amount + $amount,
            ]);
        } else {
            //
            $item = new CartItem(['amount' => $amount]);
            $item->user()->associate($user);
            $item->productSku()->associate($skuId);
            $item->save();
        }

        return $item;
    }

    public function remove($skuIds)
    {
        if (!is_array($skuIds)) {
            $skuIds = [$skuIds];
        }

        Auth::user()->cartItems()->whereIn('product_sku_id', $skuIds)->delete();
    }
}