<?php

namespace App\Mail;

use App\Models\Commande;
use App\Models\ParametresSite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeStatutMisAJour extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Commande $commande,
        public string $ancienLibelle,
        public string $nouveauLibelle,
    ) {}

    public function build(): self
    {
        $p = ParametresSite::instance();
        $nom = (string) $this->commande->nom;
        $ref = (string) $this->commande->reference;

        $subject = $p->resolvedCommandeStatutEmailSubject(
            $nom,
            $ref,
            $this->ancienLibelle,
            $this->nouveauLibelle,
        );

        $corpsHtml = $p->resolvedCommandeStatutEmailCorpsHtml(
            $nom,
            $ref,
            $this->ancienLibelle,
            $this->nouveauLibelle,
        );

        return $this->subject($subject)
            ->view('emails.commande-statut-mis-a-jour', [
                'corpsHtml' => $corpsHtml,
                'nomSite' => config('app.name'),
                'couleurEnTete' => $p->couleur_principale ?: '#E30613',
            ]);
    }
}