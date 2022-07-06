<?php

namespace App\Http\Controllers;

use App\Models\Seu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use League\Flysystem\CorruptedPathDetected;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;
use Throwable;

//use \Illuminate\Http\Response;
include('../public/php/redimensioImatges.php');
define('TITOL','Seu Avaluadora');
define('TITOLS','Seus Avaluadores');

class SeuController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $taula='seus';
        $campOrdenacio='nomSeu';
        $campsLlista=[['Seu',   'input',    'text', 'nomSeu'],
                      ['Correu','input',    'text', 'correuSeu'],
                     // ['Notes', 'textarea', '',     'notesSeu']
                    ];

         include('commons/indexcont.php');

        return view('seus.seusLlistar')->with(['taulaList'=>$taulaList,
                                        'taula'=>$taula,
                                        'estat'=>$estat,
                                        'criteriOrdenacio'=>$criteriOrdenacio,
                                        'sentitOrdenacio'=>$sentitOrdenacio,
                                        'registresPagina' => $registresPagina,
                                        'pageNumber' => $pageNumber,
                                        'campsLlista' => $campsLlista,
                                        /*'dnone'=>$dnone,
                                        'acreditEdit' => $seuEdit,
                                        'dnoneEdit'=>$dnoneEdit,
                                        'dnoneShow'=>$dnoneShow*/
                                    ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $taula='seus';
        $titol='Nova '.TITOL;
       // $criteriOrdenacio='nomSeu';
       //               labelCamp  ctrlHTML   type    nomCamp    
        $campsLlista=[
            'imatge'=>'logoSeu',
            'camps' =>[// nom,     etiqHTML,   type,   camp
                        ['Seu',   'input',    'text', 'nomSeu'],
                        ['Correu','input',    'text', 'correuSeu'],
                        ['Notes', 'textarea', '',     'notesSeu']
                      ]
            ];
       return view('seus.seuAfegir')->with(['taula'=>$taula,
                                          // 'criteriOrdenacio'=>$criteriOrdenacio, 
                                           'campsLlista'=>$campsLlista,
                                           'titol'=>$titol
                                        ]); 
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {
        //$taula='seus';
        $condicions=[
                    'Seu'=>'required|max:30|unique:seus,nomSeu,'.$request['id'],
                    'Correu'=>'max:35|unique:seus,correuSeu,'.$request['id']
                    ];

        //validar imatge php
        if($request['contingut']!==""){
            $extensio=explode('.',$_FILES['imatge']['name']);
            $nouNom=$request['Correu'].'.'.end($extensio); 
            //que passa si repeteix el correu????
            //que passa si es modifica el correu?????

            //$nouNom='SEU'.str_pad($request['id'],5 - strlen($request['id']),'0',STR_PAD_LEFT).'.'.end($extensio);
            $resposta=pujarImatge("./fotos/".$nouNom);
        //si imatge correcta executar validate
            $request->validate($condicions);
            $request['logo']=$nouNom; //$request->LogoSeu;
         }   

        
        Seu::create(['nomSeu'=>$request['Seu'],
                     'correuSeu'=>$request['Correu'],
                     'notesSeu'=>$request['Notes'],
                     'logoSeu'=>$request['logo'],
                     'baixaSeu'=>null
        ]);
        
       /* $canvi=Seu::find($request['logo']);
        
        $nouNom=str_ireplace('0000',
            str_pad($canvi['logo'],5 - strlen($canvi['id']),'0',STR_PAD_LEFT),$canvi['logoSeu']);
        rename('../fotos/'.$canvi['logoSeu'],'../fotos/'.$nouNom);  
            $canvi['logoSeu']=$nouNom;
        $canvi->save();
         */ 
        //return redirect()->route('seusCreate'); //view('seus.seuAfegir')->with(['taula'=>$taula,]);
        return back()->with('status','Registre actualitzat correctament.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function show(Seu $seu) {
    
        return view('seus.seuPresentar')->with(['seu'=>$seu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id){   
        // variables especifique de la taula
        $taula='seus';
        $titol='Edició '.TITOL;
        $campsLlista=[
            'imatge'=>'logoSeu',
            'camps' =>[// nom,     etiqHTML,   type,   camp
                        ['Seu',   'input',    'text', 'nomSeu'],
                        ['Correu','input',    'text', 'correuSeu'],
                        ['Notes', 'textarea', '',     'notesSeu']
                      ]
                    ];
        $reg='seu';
        //cerca del registre
        $registre=null;
        $registre=Seu::withTrashed()->findOrFail($id)->toArray();
        $registre['logoSeu']=($registre['logoSeu'])??'nologoseu.jpg';
        return view('seus.seuEditar')->with(['registre'=>$registre,
                                             'taula'=>$taula,
                                             'reg'=>$reg,
                                             'campsLlista'=>$campsLlista,
                                             'titol'=>$titol
                                            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){

        $condicions=[
                    'Seu'=>'required|max:30|unique:seus,nomSeu,'.$request['id'],
                    'Correu'=>'max:35|unique:seus,correuSeu,'.$request['id']
                    ];
        //validara imagen php
        if($request['contingut']!==""){
            $extensio=explode('.',$_FILES['imatge']['name']);
            $nouNom=$request['Correu'].'.'.end($extensio); 
            //que passa si repeteix el correu????
            //que passa si es modifica el correu?????

            //$nouNom='SEU'.str_pad($request['id'],5 - strlen($request['id']),'0',STR_PAD_LEFT).'.'.end($extensio);
            $resposta=pujarImatge("./fotos/".$nouNom);

        //si imatge correcta executar validate
            $request->validate($condicions);
        }

        //subir imagen php

        $canvi=Seu::find($request->id);
        $canvi->nomSeu =      $request->Seu;
        $canvi->correuSeu =   $request->Correu;
        $canvi->notesSeu =    $request->Notes;
        $canvi->logoSeu =     $nouNom; //$request->LogoSeu;
        $canvi->save();
        //sino imagen correcta
        return back()->with('status','Registre actualitzat correctament.');
    }

    public function changeState(Request $request) {
       
        if($request['chst_id']!= null){
            $seu = Seu::withTrashed()->find($request['chst_id']);
            if($seu != null){
                if ($seu->trashed()){
                    $seu->restore();
                }else{
                    $seu->delete();
                }
            }
        }
        return redirect()->route('seusList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seu $seu)    {
        
    }
    public function seuCancelar(){
        return redirect('llistaSeu');
    }
}
