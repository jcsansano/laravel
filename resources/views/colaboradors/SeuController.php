<?php

namespace App\Http\Controllers;

use App\Models\Seu;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class SeuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $seus=Seu::all();
       return view('seus.seusLlistar')->with(['seus'=>$seus]);
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
    public function store(Request $request)
    {
        $condicions=['form_nomSeu'=>'required|max:30|unique:seus,nomSeu',
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function show(Seu $seu)
    {
        return view('seus.seuPresentar')->with(['seu'=>$seu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function edit(Seu $seu)
    {
        return view('seus.seuEditar')
                ->with(['seu'=>$seu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seu $seu)
    {
        $condicions=['Seu'=>'required|max:30|unique:seus,nomSeu,'.$seu->id.',id',
                     'Ubicacio'=>'max:50',
                     'Correu'=>'max:35|unique:seus,correuSeu',
                     'Logotip'=>'max:30'
                    ];
        $request->validate($condicions);
        $canvi=Seu::find($seu->id);
        $canvi->nomSeu =      $request->Seu;
        $canvi->ubicacioSeu = $request->Ubicacio;
        $canvi->correuSeu =   $request->Correu;
        $canvi->notesSeu =    $request->Notes;
        $canvi->logoSeu =     $request->Logotip;
        $canvi->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seu  $seu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seu $seu)
    {
        //
    }
}
