<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSurvey extends Notification implements ShouldQueue
{
    use Queueable;
    public $survey;
    /**
     * Create a new notification instance.
     */
    public function __construct( $survey )
    {
        $this->survey = $survey;
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

        ->subject('New Survey for '.$this->survey->name.' from RedCross.')
        ->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname)
        ->line('Welcome to ' . config('app.name', 'Laravel'))
        ->line('Redcross created a new survey '.$this->survey->name.' for you')
        ->line('It would be our pleasure to have your presence.')
        ->line('You can give your feedback on below link.')
        ->action('Start Survey', route('user-survey',['id' => base64_encode($this->survey->id),'uid' => base64_encode($notifiable->id) ] ) )
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
