<?php

/*  Mòdul: .php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici:
 *  Descripció: 
 */
?>
<form id="selectionForm" action="{{ route('orgAcredList') }}" method="post">
    @csrf
    <input type="hidden" id="estat" name="estat" value="{{$estat}}">
    <input type="hidden" id="criteriOrdenacio" name="criteriOrdenacio" value="{{$criteriOrdenacio}}">
    <input type="hidden" id="sentitOrdenacio" name="sentitOrdenacio" value="{{$sentitOrdenacio}}">
    <input type="hidden" id="pageNumber" name="pageNumber" value="{{$pageNumber}}">
    <input type="hidden" id="registresPagina" name="registresPagina" value="{{$registresPagina}}">
    <input type="hidden" id="nouOrgAcred" name="nouOrgAcred" value="{{$nouOrgAcred}}">
    <input type="hidden" id="dnone" name="dnone" value="{{$dnone}}">
</form>

<form id="showForm" action="{{ route('orgAcredShow') }}" method="post">
    @csrf
    <input type="hidden" id="show_id" name="show_id" value="">
</form>

<form id="chstForm" action="{{ route($vista.'ChangeState') }}" method="post">
    @csrf
    <input type="hidden" id="chst_id" name="chst_id" value="">
</form>

<form id="createForm" action="{{ route('orgAcredStore') }}" method="post">
    @csrf
    <input type="hidden" id="create_id" name="form_nomOrgAcred" value="">
</form>

<form id="updateForm" action="{{ route('orgAcredUpdate',['orgAcredList'=>$orgAcredList]) }}" method="post">
    @csrf
    <input type="hidden" id="update_nom" name="form_nomOrgAcred" value="">
    <input type="hidden" id="update_id" name="form_idOrgAcred" value="">
</form>
