<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OfertaMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $mensagem;

    /**
     * Cria uma nova instância.
     */
    public function __construct(string $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Define o envelope do e-mail (assunto).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confira nossa nova oferta!'
        );
    }

    /**
     * Define a view usada para o e-mail e passa a mensagem.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.oferta',
        );
    }
    /**
     * Define anexos, se houver.
     */
    public function attachments(): array
    {
        return [];
    }
}
