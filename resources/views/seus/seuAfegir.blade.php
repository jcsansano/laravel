<?php

/*  Mòdul: seuCrear.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul de creació i edició de Seus Avaluadores
 *  Laravel
 */

?>

@extends('plantilles.plantillaPrincipal')

@section ('content-area')
{{-- @include('commons.funcions.php')    --}}
<h2 class="text-center">Nova Seu Avaluadora</h2> 
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
    <div class="row">
        <div class="class col-sm-4">
            <div class="row content-justify-center">{{--Espai per a la imatge--}}
                <div class="col-sm-3"></div>
                <div class="row">
                    <div id="preview" class="col-sm-6">        
                        <img src="../fotos/nologoseu.jpg" class="img-fluid rounded float-center" 
                                alt="Logo identificador de la seu." />
                    </div>
                </div>
                <div class="row content-justify-center">
                    <input class="form-control-sm my-3" type="file" id="pujaFoto" 
                            accept="image/jpeg, image/png, image/gif, 
                                    image/tiff, image/webp, image/svg+xml" value="" >
                    <div id="novaImg" class="content-justify-center" ></div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
        <div class="class col-sm-8">
            <form action="{{route('seusStore')}}" method="post">
                @csrf
        {{--    <div class="row"> 
                    <div class="col-sm">
                        <strong class="text-danger">Id:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{$seu->id}}
                    </div>
                </div>--}}
                <div class="row my-3"> 
                    <div class="input-field col-sm-8">
                        <label for="form-nomSeu">Seu:</label>
                        <input class="form-control" type="text" name="form_nomSeu" id="form-nomSeu"
                            value="{{old('form_nomSeu')}}">
                    </div>
                </div>
                <div class="row my-3"> 
                    <div class="input-field col-sm-8">
                        <label for="form-correuSeu">Correu:</label>
                        <input class="form-control" type="text" name="form_correuSeu" id="form-correuSeu"
                            value="{{old('form_correuSeu') }}">
                    </div>
                </div>
                <div class="row my-3"> 
                    <div class="input-field col-sm-8">
                        <label for="form-notesSeu">Notes:</label>
                        <textarea class="form-control" name="form_notesSeu" 
                                id="form-notesSeu">{{old('form_notesSeu')}}</textarea>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="submit" 
                            value="Registrar">
                    </div>
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="reset" 
                            value="Buidar">
                    </div>
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="button"
                            href="{{route('seusList')}}" value="Cancel·lar">
                    </div>
                </div>
                <input id='logo' type="hidden" name='logoSeu' value="{{old('logoSeu')}}">
            </form>
        </div>
    </div>
</div>
<script languaje="javascript" src="{{ asset('js/common/afegir.js') }}"></script>
  @endsection      

