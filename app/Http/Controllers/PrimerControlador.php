<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerControlador extends Controller
{
    
    public function raiz() {
        return "Página Principal";
    }
    public function hola(Request $request,$persona='') {
        
        dump($request);
        $textoFinal='Hola, ';
        $textoFinal.= ($persona== '')?'mundo': $persona;
        return view('mensaje')->with(['texto'=>$textoFinal]);
        return view('mensaje',['texto'=>'Hola, mundo']);
    }

}
