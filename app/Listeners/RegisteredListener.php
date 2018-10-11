<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\EmailVerificationNotification;

/**
 *php artisan make:listener RegisteredListener 创建监听器
 * 在 App\Providers\EventServiceProvider.php  注册监听器
 */
// implements ShouldQueue 让这个监听器异步执行
class RegisteredListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    // 当时间触发时，调用该方法
    public function handle($event)
    {
        $user = $event->user;

        $user->notify(new EmailVerificationNotification());
    }
}
