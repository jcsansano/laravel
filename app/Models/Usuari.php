<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuari extends Model
{
    use HasFactory;
    protected $table='usuaris';
    protected $fillable=['NIFUsuari','perfilUsuari','nomUsuari','cognomsUsuari','telefonUsuari',
                         'correuUsuari','fotoUsuari','notesUsuari'];
    
    protected $hidden=['passwdUsuari'];
}
