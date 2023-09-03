<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DemandeAccesDossierNotification extends Notification
{
    use Queueable;

    public function __construct($demande)
    {
        $this->demande = $demande;
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
           'message'   =>  'Nouvelle demande d\'accès à votre dossier n° '.$this->dossier,
           'objet'=>'Demande d\'accès dossier médical médicalis',
           'user'=>$this->user,
           'coordinateur'=>$this->coordinateur

        ];
    }
}
