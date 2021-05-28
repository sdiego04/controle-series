@extends('layout')

@section('cabecalho')
    Alterar Serie
@endsection

@section('conteudo')


    <form class="row g-3" method="post" action="/alterarSeriado/{{$serie}}">
        <div class="col-auto">
            <input type="text" readonly class="form-control-plaintext" id="alteraserie" value="Digite a serie">
        </div>
        <div class="col-auto">
            <input type="text" class="form-control" id="inputPassword2" name="novonome">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Alterar</button>
            @csrf
        </div>
    </form>

@endsection
