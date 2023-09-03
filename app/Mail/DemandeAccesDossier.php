<?php

namespace App\Mail;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeAccesDossier extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $coordinateur, $dossier;

    public function __construct(User $user, User $coordinateur, Dossier $dossier)
    {
        $this->user = $user;
        $this->coordinateur = $coordinateur;
        $this->dossier = $dossier;
    }

    public function build()
    {
        return $this->subject('Demande d\'accès à votre dossier médical')
            ->markdown('emails.demandeAcces', [
                'user' => $this->user,
                'coordinateur'=>$this->coordinateur,
                'dossier'=>$this->dossier,
                'url' => route('coordinateur.demandeAcces'),
            ]);
    }
}
