<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Exceptions\InvalidRequestException;

class PaymentController extends Controller
{
    //
    public function payByAlipay(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不争取');
        }

        return app('alipay')->web([
            'out_trade_no' => $order->no,
            'total_amount' => $order->total_amount,
            'subject'      => '支付laravel shop 的订单：'.$order->no,
        ]);
    }

    //前端回调
    public function alipayReturn()
    {
        $data = app('alipay')->verify();
        dd($data);
    }

    //服务器端回调
    public function alipayNotify()
    {
        $data = app('alipay')->verify();
        \Log::debug('Alipay notify', $data->all());
    }
}
