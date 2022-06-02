<?php

/*  Mòdul: seuEditar.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul d'edició de Seus Avaluadores
 *  Laravel
 */
?>
@extends('plantilles.plantillaPrincipal')

{{-- @section ('page-title', 'GePOL')--}}

@section ('content-area')
  
<h2 class="text-center">Edició Seu Avaluadora: {{$registre['id'].' - '.$registre['nomSeu']}}</h2>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error) {{--Espai per a errades de validacio --}}
            <li><strong>{{$error}}</strong></li>
            @endforeach 
        </ul>
    </div>
@endif
<div class="container justify-content-center">
    <div class="row">
        <div class="class col-sm-4">
            <div class="row content-justify-center">
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
            <form action="{{route($taula.'Update')}}" method="post">
               {{-- @method('put')--}}
                @csrf
                <div class="row my-3"> 
                    <div class="col-sm-8">
                        <strong class="text-danger">Id:</strong>&nbsp;{{$registre['id']}}
                        <input type="hidden" name="id" value="{{$registre['id']}}">
                    </div>
                </div>
                @for ($n=0; $n < count($campsLlista); $n++)
                    
                <div class="row my-3"> 
                    <div class="input-field col-sm-8">
                        
                        @switch($campsLlista[$n][1])
                            @case ('input')
                        <label for="{{$campsLlista[$n][0]}}">{{$campsLlista[$n][0]}}:</label>
                        <input class="form-control" type="{{$campsLlista[$n][2]}}" name="{{$campsLlista[$n][0]}}" 
                            id="{{$campsLlista[$n][0]}}" value="{{old($campsLlista[$n][0])?:$registre[$campsLlista[$n][3]]}}">
                        </input>

                            @break
                            @case('textarea')
                        <label for="{{$campsLlista[$n][0]}}">{{$campsLlista[$n][0]}}:</label>
                        <textarea class="form-control" name="{{$campsLlista[$n][0]}}" 
           id="{{$campsLlista[$n][0]}}">{{old($campsLlista[$n][0])?:$registre[$campsLlista[$n][3]]}}</textarea>
                            @break
                            @default
                            {{'ETIQUETA HTML NO DEFINIDA'}}
                        @endswitch
                    </div>
                </div>
                @endfor
                {{-- <div classs="row my-3"> 
                  <div class="input-field col-sm-8">
                        <label for="form-nomSeu">Seu:</label>
                        <input class="form-control" type="text" name="Seu" id="form-nomSeu"
                            value="{{old('Seu')?:$registre->nomSeu}}">
                    </div>
                </div>--}}
                <div class="row my-3">
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="submit" value="Registrar">
                    </div>
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="reset" value="Buidar">
                    </div>
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type=button 
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
