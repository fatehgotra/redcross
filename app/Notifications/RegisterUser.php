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
        ->line('Thank you for registering with Fiji Red Cross Society as a volunteer. You now have a profile in FRCS Volunteer Portal')
        ->line('Your Volunteer ID is: '.$notifiable->id)
        ->line('Please quote this number in all future correspondence with FRCS.')
        ->line('Your Volunteer portal interface has following tabs:')
        ->line('1.Dashboard - this is where you will view the latest activities and alerts from your branch and the Society.')
        ->line('2.Learning Portal - this is where you can do trainings online and get certified.')
        ->line('3.My Profile - You can update all necessary information there which help us to approve your account.')
        ->line('4.Alerts - All alert notifications you will receive under alert section.')
        ->line('5.Updates - All updates about upcoming events and scheduled events are notified there')
        ->line('6.Activites - You will get the present and upcoming scheduled activites information there you can join any activity.')
        ->line('7.Survey - The conducted surveys forms will notified you on your registered email as well as your login panel under this survey tab.')
        ->line('8 Settings - You can update your basic account details there and also you canchange your login password under settings')
        ->line('We recommend that you start by doing the task \'Complete your Volunteer profile\' from your dashboard. A step-by-step guide is available here : '.url('my-profile/lodge-information'))
        ->line('Then watching these three mandatory videos:')
        ->line('1. What are the Rules of War? | The Laws of War | ICRC: https://www.youtube.com/watch?v=HwpzzAefx9M')
        ->line('2. RC Introduction Video: https://www.youtube.com/watch?v=XlDLLGjmTOs')
        ->line('3. What\'s the difference between the red cross, red crescent and red crystal? | Working For The ICRC: https://www.youtube.com/watch?v=yBIS2mj0vQ4')
        ->line('Forgotten passwords:')
        ->line('Should you forget your password, reach out to your branch executives to assist you in resetting your password.')
      
        ->line('We thank you for your interest in the Fiji Red Cross Society.')
        ->line('With best regards,')
        ->line('Fiji Red Cross Society');
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
