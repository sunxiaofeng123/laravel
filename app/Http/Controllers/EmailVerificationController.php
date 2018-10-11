<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use Mail;

class EmailVerificationController extends Controller
{
    //校验邮件
    public function verify(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        if (!$email || !$token) {
            throw new Exception('验证链接不正确');
        }

        //对比token 缓存的token是否和链接token 相同
        if ($token != Cache::get('email_verification_'.$email)) {
            throw new Exception('验证链接不正确或已过期');
        }

        //判断用户是否存在
        if (!$user = User::where('email', $email)->first()) {
            throw new Exception('用户不存在');
        }

        //废弃该email的token
        Cache::forget('email_verification_'.$token);

        //修改用户email验证状态
        $user->update(['email_verified' => true]);

        return view('pages.success', ['msg' => '邮箱验证成功']);
    }

    //发送邮件
    public function send(Request $request)
    {
        //获取档当前用户信息模型
        $user = $request->user();

        if ($user->email_verified) {
            throw new Exception('你已经验证过邮箱了');
        }

        //调用notify()方法用来发送我们定义好的通知类

        $user->notify(new EmailVerificationNotification());

        return view('pages.success', ['msg' => '邮件发送成功']);
    }
}
