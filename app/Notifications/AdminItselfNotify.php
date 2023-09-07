<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminItselfNotify extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct( $user )
    {
        $this->user = $user;
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
                    ->subject('New approval request for user # '.$this->user->id)
                    ->line($notifiable->name)
                    ->line('A new approval request for user is raised for you')
                    ->line('UserID : '.$this->user->id)
                    ->line('UserName : '.$this->user->firstname.' '.$this->user->lastname)
                    ->line('Email :'.$this->user->email)
                    ->line('Please login to below link and approve the request')
                    ->action('Login', url('/admin/login'))
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
