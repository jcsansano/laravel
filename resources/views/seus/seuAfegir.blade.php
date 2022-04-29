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
  
<h2>Nova Seu Avaluadora</h2>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li><strong>{{$error}}</strong></li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container justify-content-center">
    <form action="{{route('seus.store')}}" method="post">
        @csrf
        <legend>Seu Nova</legend>
    
{{--    <div class="row"> 
        <div class="col-sm-">
            <strong class="text-danger">Id:</strong>
        </div>
        <div class="col-sm-9">
            {{$seu->id}}
        </div>
    </div>--}}
    <div class="row"> 
        <div class="input-field col-sm-8">
            <label for="form-nomSeu">Seu:</label>
            <input class="form-control" type="text" name="form_nomSeu" id="form-nomSeu"
                   value="{{old('form_nomSeu')}}">
        </div>
    </div>
    <div class="row"> 
        <div class="input-field col-sm-8">
            <label for="form-correuSeu">Correu:</label>
            <input class="form-control" type="text" name="form_correuSeu" id="form-correuSeu"
                   value="{{ old('form_correuSeu') }}">
        </div>
 
    </div>
    <div class="row"> 
        <div class="input-field col-sm-8">
            <label for="form-ubicacioSeu">Ubicació:</label>
            <input class="form-control" type="text" name="form_ubicacioSeu" id="form-ubicacioSeu"
                   value="{{old('form_ubicacioSeu')}}">
        </div>
    </div>
    
    <div class="row"> 
        <div class="input-field col-sm-8">
            <label for="form-logoSeu">Fitxer per al Logotip:</label>
            <input class="form-control" type="text" name="form_logoSeu" id="form-logoSeu"
                   value="{{old('form_logoSeu')}}">
        </div>
    </div>
    <div class="row"> 
        <div class="input-field col-sm-8">
            <label for="form-notesSeu">Notes:</label>
            <textarea class="form-control" name="form_notesSeu" 
                      id="form-notesSeu">{{old('form_notesSeu')}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="input-field col-sm-3">
            <input class="btn btn-primary btn-small" type="submit" value="Registrar">
        </div>
        <div class="input-field col-sm-3">
            <input class="btn btn-primary btn-small" type="reset" value="Buidar">
        </div>
    </form>
</div>
    
    
    
  @endsection      
<!--    </body> 
</html>-->

