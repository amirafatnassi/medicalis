<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RepDemandeInfosNotification extends Notification
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
            'message'   =>  'Vous avez reçu une réponse à votre demande des informations
            complémentaire n°' . $this->data['demande_infos'] . ' de la part de ' . $this->data['user'],
            'demande_infos' => $this->data['demande_infos'],
            'rep_demande_infos' => $this->data['rep_demande_infos']
        ];
    }
}
