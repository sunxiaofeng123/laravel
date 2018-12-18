<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Endroid\QrCode\QrCode;
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
    }

    //服务器端回调
    public function alipayNotify()
    {
        $data = app('alipay')->verify();
        \Log::debug('Alipay notify', $data->all());
    }

    public function payByWechat(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        if ($order->paid_at || $order->closed){
            throw new InvalidRequestException('订单状态不正确');
        }

        $wechatOrder = app('wechat_pay')->scan([
            'out_trade_no' => $order->no,
            'total_fee'    => $order->total_amount*100,
            'body'         => '支付laravel shop 的订单：'.$order->no,
        ]);

        $qrCode = new QrCode($wechatOrder->code_url);

        //将二维码以字符串形式输出，并带上相应的响应类型
        return response($qrCode->writeString(), ['Content-type' => $qrCode->getContentType()]);
    }

    public function wechatNotify()
    {
        $data = app('wechat_pay')->verify();

        $order = Order::where('no', $data->out_trade_no)->first();

        if (!$order) {
            return 'fail';
        }

        if ($order->paid_at) {
            return app('wechat_pay')->success();
        }

        $order->update([
            'paid_at' => Carbon::now(),
            'payment_method' => 'wechat',
            'payment_no'     => $data->transaction_id,
        ]);
    }
}
