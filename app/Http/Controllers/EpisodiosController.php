<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class EpisodiosController extends Controller
{
    public function index(int $temporadaId, Request $request){

        $episodios=Temporada::find($temporadaId)->episodios;
        $mensagem=$request->session()->get('mensagem');
        return view('viewsEpisodios/episodios',compact('episodios','temporadaId','mensagem'));
    }

    public function assistido(Temporada $temporada, Request $request){

        //$j=sizeof($request->episodios);//metodo sizeof me da o numero de linhas no array
        $episodiosAssistidos=$request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos){
            $episodio->assistido=in_array($episodio->id,$episodiosAssistidos);
        });
        $temporada->push();
        $request->session()->flash('mensagem',"Episodio marcado assistido com sucesso");

        //metodo back retorna para a ultima pagina acessada, assim não precisa vir digitando rotas
        return redirect()->back();
    }
}
