<?php

/*  Mòdul: seuCrear.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul d'edició de Seus Avaluadores
 *  Laravel
 */
?>
@extends('plantilles.plantillaPrincipal')

@section ('page-title', 'GePOL')

@section ('content-area')
  
<h2>Edició Seu Avaluadora</h2>
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
    <form action="{{route('seus.update',['seu'=>$seu])}}" method="post">
        @method('PUT')
        @csrf
        
        <legend>Editar Seu: {{$seu->nomSeu}}</legend>
    
{{--    <div class="row"> 
        <div class="col-sm-6">
            <strong class="text-danger">Id:</strong>
        </div>
        <div class="col-sm-6">
            {{$seu->id}}
        </div>
    </div>--}}
    <div class="row"> 
        <div class="input-field col-sm-6">
            <label for="form-nomSeu">Seu:</label>
            <input class="form-control" type="text" name="Seu" id="form-nomSeu"
                   value="{{old('Seu')?:$seu->nomSeu}}">
        </div>
    </div>
    <div class="row"> 
        <div class="input-field col-sm-6">
            <label for="form-correuSeu">Correu:</label>
            <input class="form-control" type="text" name="Correu" id="form-correuSeu"
                   value="{{ old('Correu')?:$seu->correuSeu }}">
        </div>
 
    </div>
    <div class="row"> 
        <div class="input-field col-sm-6">
            <label for="form-ubicacioSeu">Ubicació:</label>
            <input class="form-control" type="text" name="form_ubicacioSeu" id="form-ubicacioSeu"
                   value="{{old('Ubicacio')?:$seu->ubicacioSeu}}">
        </div>
    </div>
    
    <div class="row"> 
        <div class="input-field col-sm-8">
            <label for="form-logoSeu">Fitxer per al Logotip:</label>
            <input class="form-control" type="text" name="Logotip" id="form-logoSeu"
                   value="{{old('Logotip')?:$seu->logoSeu}}">
        </div>
    </div>
    <div class="row"> 
        <div class="input-field col-sm-6">
            <label for="form-notesSeu">Notes:</label>
            <textarea class="form-control" name="Notes" 
                      id="form-notesSeu">{{old('Notes')?:$seu->notesSeu}}</textarea>
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

