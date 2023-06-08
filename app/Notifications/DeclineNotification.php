<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeclineNotification extends Notification
{
    use Queueable;
    public $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        switch ($this->data) {
            case 'administrator':
                return (new MailMessage)
                    ->subject('Volunteer Application Declined Notification From Administrator.')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Welcome to ' . config('app.name', 'Laravel'))
                    ->line('We are sorry! Your volunteer application has been declined by Administrator. Please contact administrator for more details')
                    ->line('You can track your application status by clicking below on login button.')
                    ->action('Login', route('login'))
                    ->line('Thank you for using ' . config('app.name', 'Laravel'));
                break;
            case 'branch-level':
                return (new MailMessage)
                    ->subject('Volunteer Application Declined Notification From Branch Level.')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Welcome to ' . config('app.name', 'Laravel'))
                    ->line('We are sorry! Your volunteer application has been declined by Branch Level. Please contact administrator for more details')
                    ->line('You can track your application status by clicking below on login button.')
                    ->action('Login', route('login'))
                    ->line('Thank you for using ' . config('app.name', 'Laravel'));
                break;
            case 'division-manager':
                return (new MailMessage)
                    ->subject('Volunteer Application Declined Notification From Division Manager.')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Welcome to ' . config('app.name', 'Laravel'))
                    ->line('We are sorry! Your volunteer application has been declined by Division Manager. Please contact administrator for more details')
                    ->line('You can track your application status by clicking below on login button.')
                    ->action('Login', route('login'))
                    ->line('Thank you for using ' . config('app.name', 'Laravel'));
                break;
            case 'hq':
                return (new MailMessage)
                    ->subject('Volunteer Application Declined Notification From HQ.')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Welcome to ' . config('app.name', 'Laravel'))
                    ->line('We are sorry! Your volunteer application has been declined by HQ. Please contact administrator for more details')
                    ->line('You can track your application status by clicking below on login button.')
                    ->action('Login', route('login'))
                    ->line('Thank you for using ' . config('app.name', 'Laravel'));
                break;
            default:
                return (new MailMessage)
                    ->subject('Volunteer Application Declined Notification From Administrator.')
                    ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
                    ->line('Welcome to ' . config('app.name', 'Laravel'))
                    ->line('We are sorry! Your volunteer application has been declined. Please contact administrator for more details')
                    ->line('You can track your application status by clicking below on login button.')
                    ->action('Login', route('login'))
                    ->line('Thank you for using ' . config('app.name', 'Laravel'));
                break;
        }
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
