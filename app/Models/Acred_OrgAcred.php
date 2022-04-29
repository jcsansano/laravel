<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acred_OrgAcred extends Model
{
    use HasFactory;
    protected $table='acred_orgAcred';
//    protected $fillable=['nomAcredit','dataAcredit','pesAcredit'];
   
    
//     public function OrganAcreditadors(){
//        return $this->belongsToMany(OrganAcreditador::class)->withPivot('id');
//    }
//    public function acreditacions(){
//        return $this->belongsToMany(Acreditacio::class)->withPivot('id');
//    }
}
