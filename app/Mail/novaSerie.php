<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class novaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $qtd_temporadas;
    public $qtd_episodios;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome,$qtd_episodios,$qtd_temporadas)
    {
        $this->nome=$nome;
        $this->qtd_temporadas=$qtd_temporadas;
        $this->qtd_episodios=$qtd_episodios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.series.nova-serie');
    }
}
