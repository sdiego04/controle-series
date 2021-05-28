<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $primaryKey='id';
    protected $table="episodios";
    protected $fillable=['numero'];
    public $incrementing=true;
    public $timestamps=false;


    public function temporada(){

        return $this->belongsTo(Temporada::class);
    }


    use HasFactory;
}
