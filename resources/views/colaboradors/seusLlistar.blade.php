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
   
    <h2>Llista de Seus Avaluadores</h2> -
    <div class="container">
        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>Seu</th>
                    <th>Correu</th>
                    <th>Baixa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seus as $seu)
                <tr>
                    <td><a href="{{route('seus.show',['seu'=>$seu])}}">{{$seu->nomSeu}}</a></td>
                    <td>{{$seu->correuSeu}}</td>
                    <td>{{$seu->baixaSeu}}</td>
                    <td>
                        <span class="edicio">
                            <a href="{ route('seus.edit',['seu'=>$seu]}}">
                                <i class="material-icons">edit</i>
                            </a>
                        </span>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
<li><a href="{{ route('seus.create')}}">Afegir Seu</a></li>
  @endsection      
<!--    </body> 
</html>-->

