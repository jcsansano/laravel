<?php

/*  Mòdul: .php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici:
 *  Descripció: 
 */
?>
@extends('plantilles.plantillaPrincipal')

{{-- @section('page-title', "Llista d'organitzacions Acreditadores") --}}

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
            <div class="row"><h1>Organismes Acretitadors</h1></div>
            <div class="row"><br></div>
            <div class="row  ">
                <div class="col col-sm-4">
                    <div class="btn-group" role="group">
                        @include('commons.botonsEstat')
                    </div>
                </div>
                <div class="col col-sm-6">
            @include('commons.selectRegistres')  {{--Selector de Registres--}}
                </div>
                <div class="col col-sm-2 text-right" >
                    <a href="#{{-- route('orgAcredNou')--}}" id="btnNouOrgAcredAfegir" class="btn btn-success btn-sm">
                        Afegir
                    </a>
                </div>
            </div>
            <div class="row"><br></div>
            <div class="row {{$dnone}}" id="orgAcredAfegir">
                <div class="input-group inpout-group mb-3">
                    <div class="input-group-preend">
                        <span class="input-group-text">Nou Acreditador:</span>
                    </div>
                    <input type="text" class="form-control" name="nouOrgAcred" 
                        id="nouOrgAcred_id" value="{{ $nouOrgAcred }}">
                    <div class="input-group-append">
                        <a href="#" class="btn btn-success disabled create-record" id="create-orgAcred">
                            Crear
                        </a>
                    </div>
                </div>
            </div>
        @if (count($orgAcredList) > 0)
            <div class="row">
                <div class="col-sm-12 ">
                    <table class="table table-striped table-bordered table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th width='300'>
                                    <span class="zona-rotulo-cabecera">
                                        Organisme
                                    </span>
                            @if ($criteriOrdenacio == 'nomOrgAcred')
                                    <span class="zona-orden-cabecera">
                                         <a href="#" class="ordenacio" value="nomOrgAcred">
                                @if ($sentitOrdenacio == "ASC")
                                        <i class="material-icons">keyboard_arrow_up</i>
                                @else
                                        <i class="material-icons">keyboard_arrow_down</i>
                                @endif
                                        </a>
                                    
                                    </span>
                            @endif
                                </th>
                                <th></th>
                                <th><input type="hidden" id="actiu" value="reg0"></th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($orgAcredList as $registre)
                            <tr id="registre-show{{$registre->id}}" 
                                class="registre-show {{$dnoneShow}}">
                                <td>
                                    {{$registre->nomOrgAcred}}
                                </td>
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
                                    <a href="#" class="orgAcredEdit" id="{{ $registre->id }}">
                                        <i class="material-icons icono-azul">mode</i>
                                    </a>
                                </td>
                            </tr>
                            <tr id="registre-inpt{{$registre->id}}" 
                                class="registre-input {{$dnoneEdit}}">
                                <td>
                                    <input type="text" name="orgAcredEditat" id="btn{{$registre->id}}"
                                            value="{{$registre->nomOrgAcred}}" class="col-12">
                                </td>
                                <td colspan=2>
                                    <input type="button" name="btn-orgAcreEditat" 
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
                    {{$orgAcredList->links() }}
                </div>
            </div>
                @else
                    <p>En aquest moment no hi hay registres que per al criteri seleccionat.
                @endif
            </div>
     @include("commons.orgAcredForms")
                <script languaje="javascript" src="{{ asset('js/auxiliars/orgAcredList.js') }}"></script>
                <script languaje="javascript" src="{{ asset('js/common/commons.js') }}"></script>
    </div>

@endsection


