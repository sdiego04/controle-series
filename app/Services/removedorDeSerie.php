<?php


namespace App\Services;


use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use App\Models\Episodio;
use App\Models\Temporada;
use App\Serie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class removedorDeSerie
{
    public function removedorSerie(int $idSerie)
    {
        DB::transaction(function ()use ($idSerie) {
            $serie = Serie::find($idSerie);

            $serie->temporadas->each(function (Temporada $temporada) {
                $temporada->episodios()->each(function (Episodio $episodio) {
                    $episodio->delete();
                });
                $temporada->delete();
            });
            Serie::destroy($idSerie);
            $evento=new SerieApagada($serie);
            //event($evento);
            ExcluirCapaSerie::dispatch($evento);
        });
    }
}
