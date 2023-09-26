<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RenewMembershipNotification extends Notification
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
        ->subject('Membership Renewal Notiication from RedCross.')
        ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
        ->line('Welcome to ' . config('app.name', 'Laravel'))
        ->line('Attention Please!')
        ->line('Your Redcross membership will be expiring on '. $notifiable->expiry_date)
        ->line('Please renew the membership before the above mentioned expiry date')
        ->line('You can send the membership fee on the payment details by clicking below on Payment Details button.')
        ->action('Payment Details', route('payment-details'))
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
