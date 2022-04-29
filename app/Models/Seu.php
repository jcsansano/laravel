<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seu extends Model
{
    use HasFactory;
    protected $table='seus';
    protected $fillable=['nomSeu','ubicacioSeu','correuSeu','notesSeu','logoSeu','baixaSeu'];
    
    protected $hidden=[];
}
