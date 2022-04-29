<?php

/*  Mòdul: colaboradorList.php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Llista de colaboradors
 */
?>
@extends('plantilles.plantillaPrincipal')

{{-- @section('page-title', "Llista d'organitzacions Acreditadores") --}}

@section('content-area')
<!--<div class="row justify-content-center">
    <div class="container">-->
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
    <!--<div class="col col-sm-3"></div>-->
            <div class="row"><h1>Col·laboradors</h1></div>
            <div class="row"><br></div>
            <div class="row">
                <div class="col col-sm-4">
                    <div class="btn-group" role="group">
                        @include('commons.botonsEstat') {{-- pendent de revisar --}}
                    </div>
                </div>
                <div class="col col-sm-3 text-end">R x Pàgina</div>
                <div class="col col-sm-2">
                    <select class="form-control form-control-sm" id="registresPagina">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="0">Tots</option>
                    </select>
                </div>
                <div class="col col-sm-3 justify-content-end" >
                    <a href="#{{-- route('acreditNou')--}}" id="btnNouAcreditAfegir" 
                       class="btn btn-success btn-sm">
                        Afegir
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
        @if (count($colaboradorList) > 0)
                    <table class="table table-striped table-bordered table-hover ">
                        <thead class="thead-dark">
                            <th>
                                        <span class="zona-rotulo-cabecera">
                                            Telèfon
                                        </span>
                                </th>
                            <th>

                            <tr>
                                <th width='300'>
                                        <span class="zona-rotulo-cabecera">
                                            Col·laborador
                                        </span>
                               @if ($criteriOrdenacio == 'nomColaborador')
                                    <span class="zona-orden-cabecera">
                                         <a href="#" id="ColaboraforNomOrderChange">
                                @if ($sentitOrdenacio == "ASC")
                                        <i class="material-icons">keyboard_arrow_up</i>
                                @else
                                        <i class="material-icons">keyboard_arrow_down</i>
                                @endif
                                        </a>
                                    </span>
                            @endif
                                </th>
                                <th>
                                        <span class="zona-rotulo-cabecera">
                                            Telèfon
                                        </span>
                                </th>
                                <th>
                                        <span class="zona-rotulo-cabecera">
                                            Correu
                                        </span>
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($colaboradorList as $colaborador)
                            <tr>
                                <td>
                                    <div id="registre-show" 
                                         class="registre-show">
                                        <a href="{{ route('colaboraroEdita', ['colaborador'=>$colaborador->id]) }}">
                                            {{$colaborador->nomColaborador}}
                                        </a>
                                    </div>
                                </td>
                                    <td class="celda-de-icono">
                                    <a href="#" class="enlaceVercolaborador" id="show{{ $colaborador->id }}">
                                        <i class="material-icons icono-azul">visibility</i>
                                    </a>
                                </td>-->
                                <td class="celda-de-icono">
                                    <a href="#" class="enllasEstatColaborador" id="chst{{ $colaborador->id }}">
                                @if (isset($colaborador->deleted_at))
                                        <i class="material-icons icono-rojo">check_circle_outline</i>
                                @else
                                        <i class="material-icons icono-verde">check_circle</i>
                                @endif
                                    </a>
                                </td>
                                
                                <td class="celda-de-icono">
                                    <a href="#" class="colaboradorEdit" id="{{ $colaborador->id }}">
                                        <i class="material-icons icono-azul">mode</i>
                                    </a>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="col col-sm-12">
                {{$colaboradorList->links() }}
            </div>
        </div>
    @else
        <p>En aquest moment no hi hay registres que per al criteri seleccionat.
    @endif

     @include("commons.acreditForms")
        {{--  @include("commons.operators-modals")--}}

        <script languaje="javascript" src="{{ asset('js/auxiliars/acreditList.js') }}"></script>
<!--    </div>
</div>-->
@endsection


