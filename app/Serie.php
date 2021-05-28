<?php


namespace App;


use App\Models\Temporada;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Serie extends Model
{
    protected $table="series";
    public $timestamps=false;
    protected $primaryKey = 'id';
    protected $fillable=['numero','capa'];
    public $incrementing = true;

    public function getCapaUrlAttribute(){
        if($this->capa){
            return Storage::url($this->capa);
        }

        return Storage::url('/serie/sem-imagem.png');

    }
    public function temporadas(){

        return $this->hasMany(Temporada::class);
    }


}
