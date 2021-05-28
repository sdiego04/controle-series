@extends('layout')

@section('cabecalho')
Series
@endsection

@section('conteudo')
    <div class="alert alert-sucess">
    {{$mensagem}}
    </div>
        @auth()
        <a href="{{route('salvar')}}" class="btn btn-dark mb-2">Adicionar</a>
        @endauth
        <ul class="list-group" >
            <?php foreach ($listar as $lista){?>
            <li class="list-group-item">
                <img src="{{$lista->capa_url}}" class="img-thumbnail" height="100px" width="100px">
                <a href="/series/{{$lista->id}}/temporadas" class="btn btn-info btn-sm">
                    <i class="fas fa-external-link-alt">Temporadas</i>
                </a>
                @auth()
                <form method="get" action="/alterarSeries/{{$lista->id}}">
                    <button>Editar</button>

                </form>
                @endauth
                @auth()
                <form method="post" action="/removerSerie/{{$lista->id}}+{{$lista->nome}}"
                      onsubmit='return confirm("Tem certeza que deseja excluir?")'>
                    @csrf
                    <button class="btn btn-danger "  >Excluir</button>
                </form>
                @endauth
            <?php echo $lista->nome;}?>
            </li>
        </ul>
@endsection
