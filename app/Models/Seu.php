<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\SeuFactory;

class Seu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='seus';
    protected $fillable=['nomSeu','correuSeu','notesSeu'];
    
    protected $hidden=[];
}
