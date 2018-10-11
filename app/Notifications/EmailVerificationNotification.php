<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Str;
use Cache;
class EmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //使用laravel 内置的str类生成随机字符串的函数，参数是生成字符串的长度
        $token = Str::random(16);

        //往缓存中写入这个随机字符串， 有效时间30分钟
        Cache::set('email_verification_'.$notifiable->eamil, $token);
        $url = route('email_verification.verify', ['eamil' => $notifiable->eamil, 'token' => $token]);

        return (new MailMessage)
                    ->greeting($notifiable->name.'您好') //设置邮件欢迎词
                    ->subject('注册成功，请您验证邮箱') //设置邮件标题
                    ->line('请点击下方链接验证您的邮箱')
                    ->action('验证', url('/')); //设置链接按钮

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
