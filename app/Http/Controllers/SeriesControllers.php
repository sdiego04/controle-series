<?php


namespace App\Http\Controllers;

use App\Http\Requests\SerieFormRequest;
use App\Mail\novaSerie;
use App\Models\Episodio;
use App\Models\Temporada;

use App\Models\User;
use App\Serie;
use App\Services\removedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class SeriesControllers extends Controller
{



    public function criar(){

        return view('viewsSeries/criar');
    }
    public function ola(){
        $olaMundo="Ola Mundo";
        return view('viewsSeries/home',compact('olaMundo'));
    }
    public function listaSeries(Request $request){
     //lista as series conforme esta no banco
    //$listar=Serie::all();

     //retorna uma mensagem confirmando se foi adicioanada a serie
     $mensagem = $request->session()->get( 'mensagem');

     //lista as series de forma ordenada
    $listar=Serie::query()->orderBy('nome')->get();

    return view('viewsSeries/series',compact('listar','mensagem'));
    }

    public function store(SerieFormRequest $request){

        //codigo para salvar somente a serie do banco
        $nome=$request->nome;//pega o parametro nome do formulario
        //metodo que salva uma foto localmente
        $request->file('capa')->store('serie');
        $serie=new Serie();
        $serie->nome=$nome;
        $serie->capa=$request->file('capa')->store('serie');
        $serie->save();

        //retorna o ultimo id inserido na tabela serie
        $inserted_id = $serie->id;

        //insere na tabela temporadas
        $temporadas=Serie::find($inserted_id);//retorna dos os dados da tabela cujo o id for igual ao inserted_id
        $qtd_temp=$request->qtd_temporadas;//pega o parametro quantidade de temporadas
        $ep_temporadas=$request->ep_por_temporada;//pega o parametro episodio por temporadas

        for($j=1;$j<=$qtd_temp;$j++){
            $temp=new Temporada();
            $temp->numero=$j;
            $temporadas->temporadas()->save($temp);

            $inserted_id = $temp->id;
            //insere na tabela episodios
            $episodios=Temporada::find($inserted_id);//retorna dos os dados da tabela cujo o id for igual ao inserted
                for($i=1;$i<=$ep_temporadas;$i++) {
                    //retorna o ultimo id inserido na tabela episodios
                    $ep2=new Episodio();
                    $ep2->numero=$i;
                    $episodios->episodios()->save($ep2);
                    }
            }

        $eventoNovaSerie=new \App\Events\NovaSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );
        event($eventoNovaSerie);

        $request->session()->flash('mensagem',"Série {$serie->id} criada com sucesso {$serie->nome}");
        return redirect('listaSeries');
}

    public function destroy(Request $request,removedorDeSerie $removedorDeSerie){

        $removedorDeSerie->removedorSerie($request->id);
        $request->session()->flash('mensagem',"a serie {$request->nome} foi excluida");
        return redirect('listaSeries');

    }

    public function formAlterar(Request $request){
        $serie=$request->id;
        return view('viewsSeries/alterarSerie',compact('serie'));
    }
    public function alterarSerie(Request $request){
    $novoNome=$request->novonome;
    $serie=Serie::find($request->id);
    $serie->nome=$novoNome;
    $serie->save();

    return redirect('listaSeries');
    }

}
