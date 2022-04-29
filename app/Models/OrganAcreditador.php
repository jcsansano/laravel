<?php

namespace App\Models;
use App\Models\Acreditacio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\OrganAcreditadorFactory;

class OrganAcreditador extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='organsAcreditadors';
    protected $fillable=['nomOgrAcred'];
    protected $dates=['deleted_at'];
    
    public function acreditacions(){
        return $this->belongsToMany(Acreditacio::class,'acred_orgAcred')
                ->withPivot('acreditacio_id');
    }
//     public function Acred_OrgAcred(){
//        return $this->belongsToMany(Acred_OrgAcred::class)->withPivot('id');
//    }
    public static function newFactory(){
        return OrganAcreditadorFactory::new();
    }
}
