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
        // dd(); 
        //$vista='seu';
        $taula='seus';
        $campOrdenacio='nomSeu';
        $campsLlista=['Seu','Correu'];
        //variables request
        // include('commonsList.php');
        $estat=(isset($request['estat']))?$request['estat']:'A';
        $criteriOrdenacio=(isset($criteriOrdenacio))?$criteriOrdenacio:$campOrdenacio;
        $sentitOrdenacio=(isset($request['sentitOrdenacio']))?$request['sentitOrdenacio'] : 'ASC';

        // Paginat
        $registresPagina = (isset($request['registresPagina']))?(int)$request['registresPagina']:5;
        $pageNumber = (isset($request['pageNumber']))?$request['pageNumber']:1;
        $taulaQuery=DB::table($taula);
        if ($estat == 'A') {  $taulaQuery->whereNull('deleted_at');               // Actius
        } elseif ($estat == 'I') { $taulaQuery->whereNotNull('deleted_at');  }    // Inactius

        $taulaQuery->orderBy($criteriOrdenacio,$sentitOrdenacio);
        $registresTrobats = count($taulaQuery->get());
        if ($registresPagina == 0) {
            $registresATrobar = $registresTrobats;
            $pageNumber = 1;
        } else {
            $registresATrobar = $registresPagina;
            $maxPage = ceil($registresTrobats/$registresATrobar);
            if ($pageNumber > $maxPage) {   $pageNumber = $maxPage;     }
        }
        $taulaList = $taulaQuery->paginate($registresATrobar, ['*'], 'pageNumber', $pageNumber);
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
    public function create()
    {
       return view('seus.seuAfegir');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)    {
        $taula='seus';
        $condicions=['form_nomSeu'=>'required|max:30|unique:seus,nomSeu',
        //'email:filter'|
                     'form_correuSeu'=>'max:35|unique:seus,correuSeu',
                     'form_logoSeu'=>'max:30'
                    ];
        $request->validate($condicions);
        Seu::create(['nomSeu'=>$request['form_nomSeu'],
                     'correuSeu'=>$request['form_correuSeu'],
                     'notesSeu'=>$request['form_notesSeu'],
                     'logoSeu'=>$request['form_logoSeu'],
                     'baixaSeu'=>null
        ]);
        return view('seus.seuAfegir')->with(['taula'=>$taula,]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function show(Seu $seu)
    {
        //dd($seu);
        return view('seus.seuPresentar')->with(['seu'=>$seu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Seu $seu){   
        // variables especifique de la taula
        $taula='seus';
                    // nom,     etiqHTML,   type,   camp
        $campsLlista=[['Seu',   'input',    'text', 'nomSeu'],
                      ['Correu','input',    'text', 'correuSeu'],
                      ['Notes', 'textarea', '',     'notesSeu']];
        $reg='seu';
        //cerca del registre
        $registre=Seu::withTrashed()->findOrFail($request['edit_id'])->toArray();
        //dump($registre);
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
    public function update(Request $request, Seu $seu){
        $condicions=['Seu'=>'required|max:30|unique:seus,nomSeu,'.$seu->id.',id',
                                         'Correu'=>'max:35|unique:seus,correuSeu',
                     'Logotip'=>'max:30'
                    ];
        $request->validate($condicions);
        $canvi=Seu::find($seu->id);
        $canvi->nomSeu =      $request->Seu;
       
        $canvi->correuSeu =   $request->Correu;
        $canvi->notesSeu =    $request->Notes;
        $canvi->logoSeu =     $request->Logotip;
        return $canvi->save();
        
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
