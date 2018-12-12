<?php

namespace App\Notifications\Intranet;

use App\Mail\Intranet\WorkshopReady,
    Illuminate\Bus\Queueable,
    Illuminate\Notifications\Notification,
    Illuminate\Contracts\Queue\ShouldQueue;

class WorkshopReadyNotification extends Notification implements ShouldQueue
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
     * @return WorkshopReady
     */
    public function toMail($notifiable)
    {
        return new WorkshopReady($notifiable);
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
