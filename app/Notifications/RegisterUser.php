<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Registration successfull'.$notifiable->firstname)
        ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
        ->line('Welcome to ' . config('app.name', 'Laravel'))
        ->line('Please follow the below steps for approval your account.')
        ->line('Instructions for Approval process')
        ->line('Step 1 : Login with you email and password on '.url('/'))
        ->line('Step 2 : Fill your all details under my profile section.')
        ->line('Step 3 : Go through every section under my profile and upload all necessary documents.')
        ->line('Step 4 : Your branch officer will review your application and approve it.')
        ->line('You can give your feedback on below link.')
        ->line('Watch instruction video :'.get_setting('signup_video_link'))
        ->action('Login', url('/') )
        ->line('Thank you for using ' . config('app.name', 'Laravel'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
