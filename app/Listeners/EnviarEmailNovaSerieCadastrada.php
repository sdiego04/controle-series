<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Models\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nome=$event->nome;
        $qtdTemporada=$event->qtd_temporadas;
        $epTemporada=$event->ep_temporada;

        $users=User::all();
        foreach ($users as $indice=>$user){

            $multiplicador=$indice+1;
            $email=new \App\Mail\novaSerie(
                $nome,
                $qtdTemporada,
                $epTemporada
            );
            $email->subjetc="Nova Série Adicionada";
            $quando=now()->addSecond($multiplicador*10);
            Mail::to($user)->later($quando,$email);
        }
    }
}
