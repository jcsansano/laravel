<?php

/*  Mòdul: acreditacioList.blade.php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Llista d'acreditacions
 */
?>
@extends('plantilles.plantillaPrincipal')

{{-- @section('page-title', "Llista d'acreditadcions") --}}

@section('content-area')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
                @foreach($errors->all() as $error)
            <li><strong>{{$error}}</strong></li>
                @endforeach
        </ul>
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col col-sm-5">
            <div class="row"><h1><br></h1></div>
            <div class="row"><h1>Acreditacions</h1></div>
            <div class="row"></div>
            <div class="row">
                <div class="col col-sm-4">
                    <div class="btn-group" role="group">
                        @include('commons.botonsEstat')
                    </div>
                </div>
                <div class="col col-sm-6">
@include('commons.selectRegistres')  {{--Selector de Registres--}} 
                </div>
                <div class="col col-sm-2 text-right" >
                    <a href="#{{-- route('acreditNou')--}}" id="btnNouAcreditAfegir" 
                       class="btn btn-success btn-sm">
                        Afegir
                    </a>
                </div>
            </div>
            <div class="row"><br> </div>
            <div class="row {{$dnone}} justify-content-between" id="AcreditAfegir">
                <div class="col-12 input-group inpout-group mb-3">
                    <div class="input-group-preend">
                        <span class="input-group-text">Acreditació:</span>
                        
                    </div>
                    <input type="text" class="form-control" name="nouNomAcredit" 
                                id="nouNomAcredit_id" placeholder="Nom" value="{{ $nouNomAcredit }}">
                    <div class="input-group-append">
                        <input type="text" class="form-control" name="nouPesAcredit" 
                            id="nouPesAcredit_id" placeholder="Pes" value="{{ $nouPesAcredit }}">
                    </div>
                    <div class="input-group-append">
                        <a href="#" class="btn btn-success disabled create-record" id="create-Acredit">
                            Crear
                        </a>
                    </div>
                </div>
            </div>

@if (count($acreditList) > 0)
            <div class="row">
                <div class="col-sm-12 ">
                    <table class="table table-striped table-bordered table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th width='150'>
                                    <span class="zona-rotulo-cabecera">
                                        Acreditadió
                                    </span>
                            @if ($criteriOrdenacio == 'nomAcredit')
                                    <span class="zona-orden-cabecera">
                                         <a href="#" class="ordenacio" value="nomAcredit">
                                @if ($sentitOrdenacio == "ASC")
                                        <i class="material-icons">keyboard_arrow_up</i>
                                @else
                                        <i class="material-icons">keyboard_arrow_down</i>
                                @endif
                                        </a>
                                    </span>
                            @endif
                                </th>
                                <th width='50'>
                                        <span class="zona-rotulo-cabecera">
                                            Pes
                                        </span>
                                </th>
                                <!--th></th-->
                                <th></th>
                                <th><input type="hidden" id="actiu" value="reg0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acreditList as $registre)
                            <tr id="registre-show{{$registre->id}}" 
                                         class="registre-show {{$dnoneShow}}">
                                <td>
                                    <div>
                                        <!--a href="{{ route('acreditEdit', ['acredit'=>$registre->id]) }}"-->
                                            {{$registre->nomAcredit}}
                                        <!--/a-->
                                    </div>
                                </td>
                                <td>
                                    <div id="registre-show" 
                                         class="registre-show text-center">
                                            {{$registre->pesAcredit}}
                                    </div>
                                </td>
                                
                                <!--td class="celda-de-icono">
                                    <a href="#" class="enlaceVeracredit" id="show{{ $registre->id }}">
                                        <i class="material-icons icono-azul">visibility</i>
                                    </a>
                                </td-->
                                <td class="celda-de-icono">
                                    <a href="#" class="enllasEstat" id="chst{{ $registre->id }}">
                                @if (isset($registre->deleted_at))
                                        <i class="material-icons icono-rojo">check_circle_outline</i>
                                @else
                                        <i class="material-icons icono-verde">check_circle</i>
                                @endif
                                    </a>
                                </td>
                                
                                <td class="celda-de-icono">
                                    <a href="#" class="acreditEdit" id="{{ $registre->id }}">
                                        <i class="material-icons icono-azul">mode</i>
                                    </a>
                                </td>
                            </tr>
                            <tr id="registre-inpt{{$registre->id}}" 
                                         class="registre-show {{$dnoneEdit}}">
                                <td>    
                                    <input type="text" name="acreditNomEditat" id="btnNom{{$registre->id}}"
                                            value="{{$registre->nomAcredit}}" class="col-12">
                                </td>
                                <td> 
                                    <input type="text" name="acreditPesEditat" id="btnPes{{$registre->id}}"
                                            value="{{$registre->pesAcredit}}" class="col-12">
                                </td>    
                                <td colspan="2">
                                    <input type="button" name="btn-AcreditEditat" 
                                        class="btnModificar col-12" value="Modificar">
                                </td>    
                                        </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
            <div class="row">
                <div class="col col-sm-12">
                    {{$acreditList->links() }}
                </div>
            </div>
            @else
            <p>En aquest moment no hi hay registres que per al criteri seleccionat.</p>
            @endif
        </div>
        @include("commons.acreditForms")
        <script languaje="javascript" src="{{ asset('js/auxiliars/acreditList.js') }}"></script>
        <script languaje="javascript" src="{{ asset('js/common/commons.js') }}"></script>
    </div> 

@endsection