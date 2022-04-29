<?php

namespace App\Http\Controllers;

use App\Models\Acreditacio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AcreditacioControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $vista='acredit';
        $taula='acreditacions';
    //variables request
        @include('commonsList.php');
        $estat=(isset($request['estat']))?$request['estat']:'A';
        $criteriOrdenacio=(isset($criteriOrdenacio))?$criteriOrdenacio:'nomAcredit';
        $sentitOrdenacio=(isset($request['sentitOrdenacio']))?$request['sentitOrdenacio'] : 'ASC';

    // Creacio i edició de registres
        $nouNomAcredit=(isset($request['nouNomAcredit']))?$request['nouNomAcredit'] : '';
        $nouPesAcredit=(isset($request['nouPesAcredit']))?$request['nouPesAcredit'] : '';
        $dnone=(isset($request['dnone']))?$request['dnone'] : 'd-none';
        $acreditEdit=(isset($request['acreditEdit']))?$request['acreditEdit'] : '';
        $dnoneEdit=(isset($request['dnoneEdit']))?$request['dnoneEdit'] : 'd-none';
        $dnoneShow=(isset($request['dnoneShow']))?$request['dnoneShow'] : '';

    // Paginat
        $registresPagina = (isset($request['registresPagina']))?(int)$request['registresPagina']:5;
        $pageNumber = (isset($request['pageNumber']))?$request['pageNumber']:1;
        $acreditQuery=DB::table($taula);
        if ($estat == 'A') {  $acreditQuery->whereNull('deleted_at');               // Actius
        } elseif ($estat == 'I') { $acreditQuery->whereNotNull('deleted_at');  }    // Inactius
        
        $acreditQuery->orderBy($criteriOrdenacio,$sentitOrdenacio);
        $registresTrobats = count($acreditQuery->get());
        if ($registresPagina == 0) {
            $registresATrobar = $registresTrobats;
            $pageNumber = 1;
        } else {
            $registresATrobar = $registresPagina;
            $maxPage = ceil($registresTrobats/$registresATrobar);
            if ($pageNumber > $maxPage) {   $pageNumber = $maxPage;     }
        }
        $acreditList = $acreditQuery->paginate($registresATrobar, ['*'], 'pageNumber', $pageNumber);

        return view('auxiliars.acreditList')->with(['acreditList'=>$acreditList,
                                                     'vista'=>$vista,
                                                     'estat'=>$estat,
                                                     'criteriOrdenacio'=>$criteriOrdenacio,
                                                     'sentitOrdenacio'=>$sentitOrdenacio,
                                                     'registresPagina' => $registresPagina,
                                                     'pageNumber' => $pageNumber,
                                                     'nouNomAcredit' => $nouNomAcredit,
                                                     'nouPesAcredit' => $nouPesAcredit,
                                                     'dnone'=>$dnone,
                                                     'acreditEdit' => $acreditEdit,
                                                     'dnoneEdit'=>$dnoneEdit,
                                                     'dnoneShow'=>$dnoneShow
                                                    ]);
                
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $condicions=['form_nomAcredit'=>'required|max:35|unique:acreditacions,nomAcredit',
                     'form_pesAcredit'=>'gt:0|lt:120',
                     
                    ];
        $request->validate($condicions);
        $nouAcredit=new Acreditacio;
        $nouAcredit['nomAcredit']=$request['form_nouNomAcredit'];
        $nouAcredit['pesAcredit']=$request['form_nouPesAcredit'];
        $nouAcredit->save();
        return redirect()->route('AcreditList');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acreditacio  $acreditacio
     * @return \Illuminate\Http\Response
     */
    public function show(Acreditacio $acreditacio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acreditacio  $acreditacio
     * @return \Illuminate\Http\Response
     */
    public function edit(Acreditacio $acreditacio)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acreditacio  $acreditacio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acreditacio $acredit) {
        $condicions=[
            'form_nomAcredit'=>['required','max:35',
                Rule::unique('acreditacions','nomAcredit')->ignore($request->form_idAcredit)],
        /* Rule::unique('acreditacions')->where (function ($query) use ($request){
                    return $query->where('nomAcredit', $request['form_nomAcredit']);
          })->ignore($request->form_idOrgAcred,'id')];*/
            'form_pesAcredit'=>['gt:0','lt:120']
                    ];
        $request->validate($condicions);
        $canvi=Acreditacio::withoutTrashed($request->form_idAcredit);
        $canvi->nomAcredit = $request->form_nomAcredit;
        $canvi->pesAcredit = $request->form_pesAcredit;
        $canvi->save();
        return  redirect()->route('acreditList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acreditacio  $acreditacio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acreditacio $acreditacio)
    {
        //
    }
    public function changeState(Request $request) {
        if($request['chst_id']!= null){
            $acredit = Acreditacio::withTrashed()->find($request['chst_id']);
            if($acredit != null){
                if ($acredit->trashed()){
                    $acredit->restore();
                }else{
                    $acredit->delete();
                }
            }
        }
        return redirect()->route('acreditList');
    }
}
