<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AffectationDemandeConsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
           'message'   =>  'Votre demande de consultation n° '.$this->data['demande'].
           ' a été réaffecté vers '.$this->data['assigned_to'].
           ' par '.$this->data['assigned_by'],
        ];
    }
}
