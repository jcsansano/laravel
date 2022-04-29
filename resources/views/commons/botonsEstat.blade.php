<?php

/*  Mòdul: .php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici:
 *  Descripció: 
 */

    $BotoActius = ($estat == 'A')?"btn btn-primary btn-sm":"btn btn-secondary btn-sm";
    $BotoInactius = ($estat == 'I')?"btn btn-primary btn-sm":"btn btn-secondary btn-sm";
    $BotoTots = ($estat == 'T')?"btn btn-primary btn-sm":"btn btn-secondary btn-sm";
?>
<button type="button" id="btnElementActius" class="btn-estat {{ $BotoActius }}">Actius</button>
<button type="button" id="btnElementInactius" class="btn-estat {{ $BotoInactius }}">Inactius</button>
<button type="button" id="btnElementTots" class="btn-estat {{ $BotoTots }}">Tots</button>