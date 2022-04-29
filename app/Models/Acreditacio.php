<?php

namespace App\Models;

use App\Models\OrganAcreditador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\AcreditacioFactory;

class Acreditacio extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='acreditacions';
    protected $fillable=['nomAcredit','pesAcredit'];
    protected $hidden=[];
    protected $attributes=['nomAcredit'=>'Suport',
                           'pesAcredit'=>20];
    protected $dates=['deleted_at'];
    
    public function OrganAcreditadors(){
        return $this->belongsToMany(OrganAcreditador::class,'acred_orgAcred')
                ->withPivot('organ_acreditador_id');
    }
    public static function newFactory(){
        return AcreditacioFactory::new();
    }
}