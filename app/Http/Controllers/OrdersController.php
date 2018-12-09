<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Models\UserAddress;
use App\Services\CartService;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\ProductSku;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use App\Jobs\CloseOrder;

class OrdersController extends Controller
{
    //
    public function store(OrderRequest $request, CartService $cartService)
    {
        $user = $request->user();

        //开始数据事务
        $order = \DB::transaction(function()use($user, $request, $cartService){
            $address = UserAddress::find($request->input('address_id'));

            $address->update(['last_used_at' => Carbon::now()]);

            //创建一个订单
            $order = new Order([
                'address' => [
                    'address' => $address->full_address,
                    'zip'     => $address->zip,
                    'contact_name' => $address->contact_name,
                    'contact_phone'=> $address->contact_phone,
                ],
                'remark'  => $request->input('remark'),
                'total_amount' => 0,
            ]);

            $order->user()->associate($user);
            $order->save();

            $totalAmount = 0;
            $items = $request->input('items');

            foreach($items as $data) {
                $sku = ProductSku::find($data['sku_id']);
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price'  => $sku->price,
                ]);

                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                $totalAmount += $sku->price * $data['amount'];
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('该商品库存不足');
                }
            }

            $order->update(['total_amount' => $totalAmount]);

            $skuIds = collect($request->input('items'))->pluck('sku_id')->all();
            $cartService->remove($skuIds);

            return $order;
        });

        $this->dispatch(new CloseOrder($order, config('app.order_ttl')));

        return $order;
    }

    public function index(Request $request)
    {
        $orders = Order::query()
                ->with(['items.product', 'items.productSku'])
                ->where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order, Request $request)
    {
        $this->authorize('own', $order);
        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }
}
