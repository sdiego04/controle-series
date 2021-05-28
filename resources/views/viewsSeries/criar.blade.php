@extends('layout')

@section('cabecalho')
Adicionar Série
@endsection
@section('conteudo')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data">
                @csrf
              <div class="row">
                <div class="col col-8 mt-4">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
                  <div class="col col-2">
                      <label for="qtd_temporadas">Número de Temporadas</label>
                      <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
                  </div>
                  <div class="col col-2">
                      <label for="ep_por_temporada">Episodio por Temporadas</label>
                      <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada">
                  </div>
                  <div class="col col-12 mt-4">
                      <label for="nome">Capa:</label>
                      <input type="file" class="form-control" name="capa" id="capa">
                  </div>
              </div>
                <button class="btn btn-dark mt-2">Cadastrar</button>
            </form>
@endsection
