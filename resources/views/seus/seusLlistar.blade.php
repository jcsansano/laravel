<?php

/*  Mòdul: seusLlistar.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul per llistar les Seus Avaluadores
 *  Laravel
 */
// variable d'adaptació al formulari concret
 //$afegirRegistre = 'seusNova';      // control de afegir registre
 //$editarRegistre = 'seusEdit';      // control per editar registre
 //$campOrdenacio  = 'nomSeu';        // camp d'ordenacio
 //$vista= 'seus';                    // control
 $titol='Llista de Seus Avaluadores';

?>

@extends('plantilles.plantillaPrincipal')

@section ('content-area')

{{-- 
    Cal definir en el formulari origen les variables de: 
    $afegirRegistre, 
    $editarRegistre
    $campOrdenacio, 
    $titol
--}}

<h2>{{ $titol }}</h2> 
<div class="container">
  <div class="row">
    <div class="col-sm-2">
       {{-- <img src="../fotos/nologoseu.jpg" class="rounded float-center" alt="Logo identificador de la seu.">--}}
    </div>
    <div class="class col-sm-8">
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
                <a href="{{ route($taula.'Create') }}" id="btnAfegir" 
                    class="btn btn-success btn-sm">
                    Afegir
                </a>
            </div>
        </div>
        <div><br></div>
@if (count($taulaList) > 0)
        <div class="row">
            
            <div class="col-sm-12 ">
                <table class="table table-striped table-bordered table-hover ">
                    <thead class="thead-dark">
                        <tr>       
                        @for ($n=0; $n < count($campsLlista); $n++)
                            <th>
                                <span class="zona-rotulo-cabecera">{{$campsLlista[$n][0]}}</span>
                                @if ($criteriOrdenacio == $campsLlista[$n][3])
                                <span class="zona-orden-cabecera">
                                    <a href="#" class="ordenacio" value="{{$criteriOrdenacio}}">
                                @if ($sentitOrdenacio == "ASC")
                                        <i class="material-icons">keyboard_arrow_up</i>
                                @else
                                        <i class="material-icons">keyboard_arrow_down</i>
                                @endif
                                    </a>
                                </span>
                            @endif
                            </th>
                        @endfor
                            <th width='50'></th>
                            <th width='50'></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($taulaList as $registre)
                        <tr>                                                
                            <td>{{$registre->nomSeu}}</td>
                            <td>{{$registre->correuSeu}}</td>
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
                                <a href="#" class="registreEdit" id="{{ $registre->id }}">
                                    <i class="material-icons icono-azul">mode</i>
                                </a>
                            </td>
                        </tr>                                                                                           
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">       {{--paginat del llistat--}}
            <div class="col col-sm-12">
                {{$taulaList->links() }}
            </div>
        </div>

    </div>
    @else 
    <div class="alert alert-danger" role="alert">
        No s'han trobat registres que complixquen les condicions demanades.
</div>
    @endif
  </div>
</div>
@include("commons.forms")
<script languaje="javascript" src="{{ asset('js/common/list.js') }}"></script>
  @endsection      


