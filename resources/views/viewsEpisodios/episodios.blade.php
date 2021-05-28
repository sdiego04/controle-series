@extends('layout')

@section('cabecalho')
    Episodios
@endsection

@section('conteudo')

    @if(!empty($mensagem))
    <div class="alert alert-sucess">
        {{$mensagem}}
    </div>
    @endif
    <form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="post">
        @csrf
    <ul class="list-group">
        <?php

            foreach ($episodios as $episodio){
         ?>

        <li class=list-group-item">Episodio {{$episodio->numero}}<input type="checkbox"name="episodios[]"
                                                         value="{{$episodio->id}}"
                                                         {{$episodio->assistido ? 'checked':''}}></li>
        <?php
            }
        ?>
        <button class="btn btn-primary">Salvar</button>

    </ul>
    </form>

@endsection
