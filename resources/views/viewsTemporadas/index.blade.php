@extends('layout')
<?php
use App\Models\Episodio;
use App\Models\Temporada;

?>
@section('cabecalho')

    Temporada de {{$serie->nome}}

@endsection

@section('conteudo')

    <!--percorre um array te chegar o fim dele atraves de um contador-->
    <img src="{{$serie->capa_url}}" class="img-thumbnail" height="400px" width="400px">
    <?php

        foreach ($temporadas as $temporada){
                $eps=Temporada::find($temporada->id)->episodios;

    ?>
    <ul class="list-group" >
        <li class="list-group-item">
            <a href="/temporadas/{{$temporada->id}}/episodios">Temporada:{{$temporada->numero}}</a>
            <span class="badge bg-secondary">{{$temporada->getEpisodiosAssistidos()->count()}}/{{$temporada->episodios->count()}}</span>
        </li>
    </ul>

    <?php

    }
    ?>
@endsection

