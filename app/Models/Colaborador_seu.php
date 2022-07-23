<?php

namespace App\Models;
use App\Models\Colaborador;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador_seu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='colaboradors_seus';
    
    function seus(){
        return $this->belongsTo('App/Model/Seu');
    }
    function colaboradors(){
        return $this->belongsTo(Colaborador::class);
    }
}
