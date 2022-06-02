<?php

namespace App\Http\Controllers;

use App\Models\Seu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
//use \Illuminate\Http\Response;

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
       // $criteriOrdenacio='nomSeu';
        $campsLlista=[['Seu',   'input',    'text', 'nomSeu'],
                      ['Correu','input',    'text', 'correuSeu'],
                      ['Notes', 'textarea', '',     'notesSeu']];
       return view('seus.seuAfegir')->with(['taula'=>$taula,
                                          // 'criteriOrdenacio'=>$criteriOrdenacio, 
                                           'campsLlista'=>$campsLlista]); 
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {
        $taula='seus';
        $condicions=['Seu'=>'required|max:30|unique:seus,nomSeu',
        //'email:filter'|
                     'Correu'=>'max:35|unique:seus,correuSeu',
                     'Logo'=>'max:30'
                    ];
        $request->validate($condicions);
        Seu::create(['nomSeu'=>$request['Seu'],
                     'correuSeu'=>$request['Correu'],
                     'notesSeu'=>$request['Notes'],
                     'logoSeu'=>$request['logo'],
                     'baixaSeu'=>null
        ]);
        return redirect()->route('seusCreate'); //view('seus.seuAfegir')->with(['taula'=>$taula,]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function show(Seu $seu) {
        //dd($seu);
        return view('seus.seuPresentar')->with(['seu'=>$seu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request){   
        // variables especifique de la taula
        $taula='seus';
                    // nom,     etiqHTML,   type,   camp
        $campsLlista=[['Seu',   'input',    'text', 'nomSeu'],
                      ['Correu','input',    'text', 'correuSeu'],
                      ['Notes', 'textarea', '',     'notesSeu']];
        $reg='seu';
        //cerca del registre
       dump($request);
        $registre=Seu::withTrashed()->findOrFail($request['edit_id'])->toArray();
      
        return view('seus.seuEditar')->with(['registre'=>$registre,
                                             'taula'=>$taula,
                                             'reg'=>$reg,
                                             'campsLlista'=>$campsLlista
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
        ///dd($request);
        $condicions=['nomSeu'=>['required','max:30',Rule::unique('seus')
                        ->where(function ($query) use ($request) {
                            return $query->where('nomSeu',$request['Seu']);
                            })->ignore($request->id, 'id')],
                     'correuSeu'=>['max:35', Rule::unique('seus')
                        ->where(function ($query) use ($request) {
                            return $query->where('correuSeu', $request['Seu']);
                            })->ignore($request->id, 'id')],
                     'logoSeu'=>'max:30'];
  
        

// REVISAR

        $request->validate($condicions);

        $canvi=Seu::find($request->id);
        $canvi->nomSeu =      $request->Seu;
        $canvi->correuSeu =   $request->Correu;
        $canvi->notesSeu =    $request->Notes;
        $canvi->logoSeu =     $request->Logotip;
        $canvi->save();
        return view('inicio'); 
        
    }

    public function changeState(Request $request) {
        //dd($request);
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
}
