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
        $tmpImatge='tmp'.$taula.'user.jpg';
        copy('./fotos/nologoseu.jpg','./fotos/'.$tmpImatge);
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
                                           'titol'=>$titol,
                                           'tmpImatge'=>$tmpImatge
                                        ]); 
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {
        $taula='seus';
        $condicions=[
                    'Seu'=>'required|max:30|unique:seus,nomSeu,'.$request['id'],
                    'Correu'=>'max:35|unique:seus,correuSeu,'.$request['id']
                    ];

        //validar imatge php
        if(isset($_FILES['imatge']['name']) && $_FILES['imatge']['name']!==""){
            $extensio=explode('.',$_FILES['imatge']['name']);
            $tmpNom=construirNomImatge('tmp'.$taula,'user',end($extensio));
            $resposta=pujarImatge("./fotos/".$tmpNom);
            //$nouNom=construirNomImatge('SEU',$request['id'],end($extensio));
            setcookie('tmpNom',$tmpNom,time()+3600,'/');
            //setcookie('nouNom',$nouNom,time()+3600);
        }
        switch($resposta){
            case 0: // pujada exitosa
                //$request->validate($condicions);
                $tmpNom=$_COOKIE['tmpNom'];
                //$nouNom=$_COOKIE['nouNom'];
                //rename('./fotos/'.$tmpNom,'./fotos/'.$nouNom);
                $request->validate($condicions);
                
                //recuperar registre, guardar nouNom en logoSeu
                //$registre=Seu::withTrashed()->findOrFail($request['correuSeu'])->toArray();
                //$extensio=explode('.',$tmpNom);
                //$nouNom=construirNomImatge('tmp'.$taula,'SEU',$registre['id'],end($extensio));
                Seu::create(['nomSeu'=>$request['Seu'],
                    'correuSeu'=>$request['Correu'],
                    'notesSeu'=>$request['Notes'],
                    'logoSeu'=>$request['logo'],
                    'baixaSeu'=>null
                ]);   
                $canvi=Seu::where('nomSeu', $request['Seu'])->first()->toArray();
                $extensio=explode('.',$tmpNom);
                $nouNom=construirNomImatge('tmp'.$taula,'SEU',$canvi['id'],end($extensio));
                
                $canvi->logoSeu =     $nouNom; //$request->LogoSeu;
                $canvi->save();
                return back()->with('status','Registre actualitzat correctament.');
                break;
            case 1: // no s'ha trobat la imatge pujada
            case 2: // tipus de extensio no soportada
            case 3: // tipus mime no sortat
            default: // resultat inesperat
        }

            
            //$request['logo']=$nouNom; //$request->LogoSeu;
            
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
        $extensio=explode('.',$registre['logoSeu']);
        $tmpImatge=construirNomImatge('tmp'.$taula,'user',end($extensio));
        if(!file_exists('fotos/'.$tmpImatge)){
            if(file_exists('fotos/'.$registre['logoSeu'])){
                copy('./fotos/'.$registre['logoSeu'],'./fotos/'.$tmpImatge);
                //setcookie('tmpNom',$tmpImatge ,time()+3600,'/');
            }
        }
        
        return view('seus.seuEditar')->with(['registre'=>$registre,
                                             'taula'=>$taula,
                                             'reg'=>$reg,
                                             'campsLlista'=>$campsLlista,
                                             'titol'=>$titol,
                                             'tmpImatge'=>$tmpImatge                                             
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
        $taula='seus';
        $condicions=[
                    'Seu'=>'required|max:30|unique:seus,nomSeu,'.$request['id'],
                    'Correu'=>'max:35|unique:seus,correuSeu,'.$request['id']
                    ];
        //validara imagen php
        //$tmpNom=($_COOKIE['tmpNom'])??"";
        $resposta=-1;
        if(isset($_FILES['imatge']['name']) && $_FILES['imatge']['name']!==""){
            $extensio=explode('.',$_FILES['imatge']['name']);
            $tmpNom=construirNomImatge('tmp'.$taula,'user',end($extensio));
            $resposta=pujarImatge("./fotos/".$tmpNom);
            $nouNom=construirNomImatge('SEU',$request['id'],end($extensio));
            setcookie('tmpNom',$tmpNom,time()+3600,'/');
            setcookie('nouNom',$nouNom,time()+3600,'/');
            
        }

        switch($resposta){
            case -1: //no ha pujat cap imatge
                $request->validate($condicions);
                $canvi=Seu::find($request->id);
                $canvi->nomSeu =      $request->Seu;
                $canvi->correuSeu =   $request->Correu;
                $canvi->notesSeu =    $request->Notes;
                $canvi->logoSeu =     $nouNom; //$request->LogoSeu;
                $canvi->save();
                
                $estat='Registre actualitzat correctament.';
                break;
            case 0: // pujada exitosa
                $request->validate($condicions);
                //$tmpNom=$_COOKIE['tmpNom'];
                //$nouNom=$_COOKIE['nouNom'];
                rename('./fotos/'.$tmpNom,'./fotos/'.$nouNom);
                $canvi=Seu::find($request->id);
                $canvi->nomSeu =      $request->Seu;
                $canvi->correuSeu =   $request->Correu;
                $canvi->notesSeu =    $request->Notes;
                $canvi->logoSeu =     $nouNom; //$request->LogoSeu;
                $canvi->save();
                
                $estat='Registre actualitzat correctament.';
                break;
            case 1: // no s'ha trobat la imatge pujada
                $estat="No s'ha trobat la imatge pujada. Torneu a pujar-la";
                break;
            case 2: // tipus de extensio no soportada
                $estat="Tipus d'arxiu no soportat. Trieu una imatge amb altres formats.";
                break;
            case 3: // tipus mime no sortat
                $estat="Tipus mime no sortat.Trieu una imatge amb altres formats.";
                break;
            default: // resultat inesperat
        }
        setcookie('tmpNom',$tmpNom,time()-1,'/');
        setcookie('nouNom',$nouNom,time()-1,'/');
        return back()->with('status',$estat);
    }

    public function changeState(Request $request) {
       //pendiente dar bajas y atas en todas las tablas relacionadas
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
        (isset($_COOKIE['tmpNom']) && file_exists('./fotos/'.$_COOKIE['tmpNom']))?unlink('./fotos/'.$_COOKIE['tmpNom']):"";
        //if(file_exists('./fotos/'.$tmpNom)) {unlink('./fotos/'.$tmpNom);}
            
        return redirect('llistaSeu');
    }
}
