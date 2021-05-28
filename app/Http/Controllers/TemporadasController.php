<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use App\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    //

    public function index(int $seriesId){
       $temporadas=Serie::find($seriesId)->temporadas;
       $serie=Serie::find($seriesId);


        return view('viewsTemporadas/index',compact('temporadas','serie'));

    }


}
