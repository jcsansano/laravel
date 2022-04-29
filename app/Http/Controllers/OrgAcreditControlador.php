<?php

namespace App\Http\Controllers;

use App\Models\OrganAcreditador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrgAcreditControlador extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $vista='orgAcred';
        $taula='organsAcreditadors';

        $estat=(isset($request['estat']))?$request['estat']:'A';
        $criteriOrdenacio=(isset($criteriOrdenacio))?$criteriOrdenacio:'nomOrgAcred';
        $sentitOrdenacio=(isset($request['sentitOrdenacio']))?$request['sentitOrdenacio'] : 'ASC';
    
    // Creacio i edició de registres
        $nouOrgAcred=(isset($request['nouOrgAcred']))?$request['nouOrgAcred'] : '';
        $dnone=(isset($request['dnone']))?$request['dnone'] : 'd-none';
        $orgAcredEdit=(isset($request['orgAcredEdit']))?$request['orgAcredEdit'] : '';
        $dnoneEdit=(isset($request['dnoneEdit']))?$request['dnoneEdit'] : 'd-none';
        $dnoneShow=(isset($request['dnoneShow']))?$request['dnoneShow'] : '';

    // Paginat
        $registresPagina = (isset($request['registresPagina']))?(int)$request['registresPagina']:5;
        $pageNumber = (isset($request['pageNumber']))?$request['pageNumber']:1;
        
        //$nombreRegistres = (isset($request['nombreRegistres']))?$request['nombreRegistres']:15;
        $orgAcredQuery=DB::table($taula);
        if ($estat == 'A') {    $orgAcredQuery->whereNull('deleted_at');                // Actius
        } elseif ($estat == 'I') {  $orgAcredQuery->whereNotNull('deleted_at');     }   // Inactius
        
        $orgAcredQuery->orderBy($criteriOrdenacio,$sentitOrdenacio);
        //$orgAcredList=$orgAcredQuery->get();
        $registresTrobats = count($orgAcredQuery->get());
        if ($registresPagina == 0) {
            $registresATrobar = $registresTrobats;
            $pageNumber = 1;
        } else {
            $registresATrobar = $registresPagina;
            $maxPage = ceil($registresTrobats/$registresATrobar);
            if ($pageNumber > $maxPage) {   $pageNumber = $maxPage;     }
        }
         $orgAcredList = $orgAcredQuery->paginate($registresATrobar, ['*'], 'pageNumber', $pageNumber);
        return view('auxiliars.orgAcredlist')->with(['orgAcredList'=>$orgAcredList,
                                                     'vista'=>$vista,
                                                     'estat'=>$estat,
                                                     'criteriOrdenacio'=>$criteriOrdenacio,
                                                     'sentitOrdenacio'=>$sentitOrdenacio,
                                                     'registresPagina' => $registresPagina,
                                                     'pageNumber' => $pageNumber,
                                                     'nouOrgAcred' => $nouOrgAcred,
                                                     'dnone'=>$dnone,
                                                     'orgAcredEdit' => $orgAcredEdit,
                                                     'dnoneEdit'=>$dnoneEdit,
                                                     'dnoneShow'=>$dnoneShow]);
                
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
    public function store(Request $request){
        //dd($request);
        $regles=['form_nomOrgAcred'=>'required|max:40|unique:organsAcreditadors,nomOrgAcred'];
        $messages=[
            'form_nomOrgAcred.required'=>$request['form_nomOrgAcred'].', ja està registrat'
                            .'No pot haver-hi Acreditadors repetits.'];
        
        $request->validate($regles); 
       
        $nouOrgAcred=new OrganAcreditador;
        $nouOrgAcred['nomOrgAcred']=$request['form_nomOrgAcred'];
        $nouOrgAcred->save();
        return redirect()->route('orgAcredList');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganAcreditador  $organAcreditador
     * @return \Illuminate\Http\Response
     */
    public function show(OrganAcreditador $organAcreditador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganAcreditador  $organAcreditador
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganAcreditador $organAcreditador)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganAcreditador  $organAcreditador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,OrganAcreditador $organAcreditador)
    {
         //dd($request);
        $regles=[
            'form_nomOrgAcred'=>'required|max:40|unique:organsAcreditadors,'.$organAcreditador->id.'id']; 
           // Rule::unique('organsAcreditadors')->where (function ($query) use ($request){
           //         return $query;//->where('nomOrgAcred', $request['form_nomOrgAcred']);
            //})->ignore($request->form_idOrgAcred,'id')];
        
        $messages=[
            'form_nomOrgAcred.required'=>$request['form_nomOrgAcred'].', ja està registrat'
                            .'No pot haver-hi Acreditadors repetits.',
            'form_nomOrgAcred.required'=>'El camp Organisme('.$request['form_nomOrgAcred']
            .') es obligatori.'];

                              
       //dd($regles);
       
        $request->validate($regles);   
        $canvi=OrganAcreditador::find($request->form_idOrgAcred);
        $canvi->nomOrgAcred = $request->form_nomOrgAcred; 
        $canvi->save();
        return  redirect()->route('orgAcredList');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganAcreditador  $organAcreditador
     * @return \Illuminate\Http\Response
     */
    public function changeState(Request $request) {
        if($request['chst_id']!= null){
            $orgAcred = OrganAcreditador::withTrashed()->find($request['chst_id']);
            if($orgAcred != null){
                if ($orgAcred->trashed()){
                    $orgAcred->restore();
                }else{
                    $orgAcred->delete();
                }
            }
        }
        return redirect()->route('orgAcredList');
    }
}
