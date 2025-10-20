<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $newUser)
    {
        //
    }

    /**
     * کانال‌های ارسال نوتیفیکیشن
     */
    public function via(object $notifiable): array
    {
        // نوتیفیکیشن را از طریق ایمیل بفرست
        return ['mail'];
    }

    /**
     * پیام ارسالی به ایمیل
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('ثبت‌نام کاربر جدید در سامانه')
            ->greeting('سلام مدیر محترم،')
            ->line('یک کاربر جدید در سامانه ثبت‌نام کرده است.')
            ->line('نام: ' . $this->newUser->name)
            ->line('ایمیل: ' . $this->newUser->email)
            ->action('مشاهده کاربران', url('/admin/users'))
            ->line('با تشکر از شما 🙏');
    }
}
