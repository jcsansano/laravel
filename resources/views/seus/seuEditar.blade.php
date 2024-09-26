<?php

/*  Mòdul: seuEditar.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul d'edició de Seus Avaluadores
 *  Laravel
 */
?>
@extends('plantilles.plantillaPrincipal')
@section ('content-area')
 
<h2 class="text-center">{{$titol.": ".$registre['id'].' - '.$registre['nomSeu']}}</h2>
<div class="container justify-content-center">
    {{-- <form  id="registre" action="{{route($taula.'Update')}}" method="post" enctype="multipart/form-data">
       @method('put')
        @csrf --}}
        <div class="row">                                   <!- Quadre principal del formulari -->
<!- COLUMNA ESQUERRA -->
            <div class="class col-sm-4 justify-content-center"> 
    <!- MISSATGES PER AL RESULTAT DE LA INTRODUCCIÓ DE VALORS -->
                <div class="row">                           <!- Linea per a les errades -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                @foreach($errors->all() as $error) <!-Espai per a errades de validacio -->
                            <li><strong>{{$error}}</strong></li>
                @endforeach 
                        </ul>
                    </div>
                @endif
                @if(session()->has('status')) <!- Operació realitzada correctament -->
                    <div  name="error" id="errorId" class="alert alert-success row my-3">
                        <p>{{session('status')}}</p>
                    </div>
                @endif
                </div>
    <!- POSICIONAMENT DE LA IMATGE -->
                <div class="row">
                    <!--div class="col-sm-3"></div--> <!- Marge esquerre -->
                    <div class="row justify-content-center">

<!- ESPAI PER A COLOCAR LA IMATGE -->
                    <form  id="imatge" action="{{route($taula.'Imatge')}}" method="post" enctype="multipart/form-data">
                        @csrf                
                        <div id="preview" class="col-sm-6">
                            {{ $_COOKIE['tmpNom'] }}
                            <img src="{{'../fotos/'.$registre['logoSeu']}}" 
                            class="img-fluid rounded float-center" 
                                alt="Logo identificador de la seu." />
                             
                        </div>
                        <div class="row justify-content-center"> <!- Captura de la nova Imatge -->
                            <input class="form-control-sm my-3" type="file" id="pujaFoto" name="imatge" 
                                accept="image/gif, image/jpeg, image/png, image/wbmp, image/xpm">
                        </div>
                <!- **************** texte de validaciÓ possiblement a borrar ************ -->
                        <div id="novaImg" class="row content-justify-center" ></div> 
                        <div class="row"></div> <!- linea de separació -->
                    </div>
                </div><!- FI ESPAI PER A COLOCAR LA IMATGE -->  
            </div> <!- FI COL ESQUERRA -->
            <!--?php echo "IMG_GIF=".IMG_GIF."| IMG_JPG=".IMG_JPG." | IMG_PNG=".IMG_PNG.
                    " | IMG_WBMP=".IMG_WBMP." | IMG_XPM=".IMG_XPM; ?-->
<!- COLUMNA DRETA -->
        <form  id="registre" action="{{route($taula.'Update')}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
            <div class="class col-sm-8">
                <div class="row my-3"> <!- CAMP Id -->
                    <div class="col-sm-8">
                        <strong class="text-danger">Id:</strong>&nbsp;{{$registre['id']}}
                        <input type="hidden" name="id" value="{{$registre['id']}}">
                    </div>
                </div>
<!- Recorrem la resta de camps i montem l'HTML en funcio del tipus de camp -->            
            @for ($n=0; $n < count($campsLlista['camps']); $n++)
                <div class="row my-3">                                  <!- Àrea de camps -->
                    <div class="input-field col-sm-8">
                @switch($campsLlista['camps'][$n][1])
                    @case ('input')
                            <label for="{{$campsLlista['camps'][$n][0]}}">
                                {{$campsLlista['camps'][$n][0]}}:
                            </label>
                            <input class="form-control" type="{{$campsLlista['camps'][$n][2]}}" 
                                name="{{$campsLlista['camps'][$n][0]}}" 
                                id="{{$campsLlista['camps'][$n][0]}}" 
                                value="{{old($campsLlista['camps'][$n][0])?:
                                    $registre[$campsLlista['camps'][$n][3]]}}">
                            </input>
                    @break
                    @case('textarea')
                            <label for="{{$campsLlista['camps'][$n][0]}}">
                                {{$campsLlista['camps'][$n][0]}}:
                            </label>
                            <textarea class="form-control" name="{{$campsLlista['camps'][$n][0]}}" 
                                id="{{$campsLlista['camps'][$n][0]}}"
                                >{{old($campsLlista['camps'][$n][0])?:
                                    $registre[$campsLlista['camps'][$n][3]]}}</textarea>
                    @break
                    @default
                        {{'ETIQUETA HTML NO DEFINIDA'}}
                @endswitch
                    </div>
                </div>                                                  <!- Fi Àrea de camps -->
            @endfor
                <input id='logo' type="hidden" name='logoSeu' value="{{old('logoSeu')}}">
                <control id='registreModificat' value="fals"/> 
                <div class="row my-3">                                  <!- Línia de botons -->
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="submit" value="Registra">
                    </div>
                    <div class="input-field col-sm-3">
                        <input class="btn btn-primary btn-small" type="reset" value="Buida">
                    </div>
                    <div class="input-field col-sm-3">
                        <a class="btn btn-primary btn-small" type="button" 
                            href="{{ route($taula.'Cancelar') }}">Cancel·la / Ix</a>
                    </div>
                </div>                                                  <!- Fi Línia de botons -->
            </div> <!- FI COLUMNA DRETA -->
        </div>                                                      <!- Quadre principal del formulari -->
    </form>        
</div>
<script languaje="javascript" src="{{ asset('js/common/afegirFoto.js') }}"></script>  
@endsection      
