<?php

/*  Mòdul: seuCrear.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul de creació de Seus Avaluadores
 *  Laravel
 */
?>
<!--<html>
    <head></head>
    <body>-->
@extends('plantilles.plantillaPrincipal')

@section ('page-title', 'GePOL')

@section ('content-area')
  
<h2>Propietats de la Seu {{$seu->nomSeu}}</h2>
<div class="container justify-content-center">
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Id:</strong>
        </div>
        <div class="col-sm-9">
            {{$seu->id}}
        </div>
    </div>
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Seu:</strong>
        </div>
        <div class="col-sm-10">
            {{$seu->nomSeu}}
        </div>
    </div>
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Coreu:</strong>
        </div>
        <div class="col-sm-10">
            {{$seu->correuSeu}}
        </div>
    </div>
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Ubicació:</strong>
        </div>
        <div class="col-sm-10">
            {{$seu->ubicacioSeu}}
        </div>
    </div>
    @isset($seu->logo)
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Logo:</strong>
        </div>
        <div class="col-sm-10">
            {{$seu->logoSeu}}
        </div>
    </div>
    @endisset
    @isset($seu->notesSeu)
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Notes:</strong>
        </div>
        <div class="col-sm-10">
            {{$seu->notesSeu}}
        </div>
    </div>
    @endisset
    @isset($seu->baixaSeu)
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">D.Baixa:</strong>
        </div>
        <div class="col-sm-10">
            @dataSimple($seu->baixaSeu)
        </div>
    </div>
    @endisset
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">D.Creació:</strong>
        </div>
        <div class="col-sm-10">
            @dataSimple($seu->created_at)
        </div>
    </div>
    <div class="row"> 
        <div class="col-sm-2">
            <strong class="text-danger">Modificat:</strong>
        </div>
        <div class="col-sm-10">
            @dataSimple($seu->updated_at)
        </div>
    </div>
</div>
    
    
    
  @endsection      
<!--    </body> 
</html>-->

