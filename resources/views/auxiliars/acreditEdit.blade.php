<?php

/*  Mòdul: acreditEdit.blade.php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Edició d'acreditació
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
<div class="row"></div>
<div class="row justify-content-center">
    <div class="row"></div>
    <div class="row"></div>
    <form action="{{route('acreditUpdate',['acreditacio'=>$acreditacio])}}" method="post">
        @method('PUT')
        @csrf
        <legend>Edició d'acretitació: {{ $acreditacio->nomAcredit }}</legend>
        <div class="col col-sm-2"></div>
        <div class="col col-sm-8 align-items-center">
            <div class="row"> 
                <div class="input-label col col-sm-6">
                    <label class="text-right" for="form-nomAcredit">Acreditació:</label>
                </div>
                <div class="input-field col col-sm-6 text-start">
                    <input class="form-control" type="text" name="acreditacio" id="form-nomAcredit"
                        value="{{old('acreditacio')?:$acreditacio->nomAcredit}}">
                </div>
            </div>
            <div class="row">    
                <div class="input-label col col-sm-6">
                    <label for="form-nomAcredit">Pes:</label>
                </div>
                <div class="input-label col col-sm-6">
                    <input class="form-control" type="text" name="pes" id="form-pesAcredit"
                     value="{{old('acreditacio')?:$acreditacio->nomAcredit}}">
                </div>

            </div> <!-- fi de linea-->
            <div class="row"><h1></h1></div>
            <div class="row justify-content-between">
                <div class="col col-sm-3">
                    <a href="{{-- route('operatorCreate') --}}#" class="btn btn-success btn-sm">
                        Reiniciar
                    </a>
                </div>
                <div class="col col-sm-3">
                    <a href="{{-- route('operatorCreate') --}}#" class="btn btn-success btn-sm">
                        Acceptar
                    </a>
                </div>
            </div>

        </div><!-- fi de columna-->
        <div class="col col-sm-2"></div>
    </form>
    </div><!-- fi de justificació de página-->

    