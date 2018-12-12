<?php

namespace App\Notifications\Intranet;

use App\Mail\Intranet\LearningReady,
    Illuminate\Bus\Queueable,
    Illuminate\Notifications\Notification,
    Illuminate\Contracts\Queue\ShouldQueue;

class LearningReadyNotification extends Notification implements ShouldQueue
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
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return LearningReady
     */
    public function toMail($notifiable)
    {
        return new LearningReady($notifiable);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
