<?php
/*  Mòdul: forms.php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Formularis parcials per als llistats de taules:
 *      seus
 */
?>
<form id="selectionForm" action="{{ route($taula.'List') }}" method="post">
    @csrf
    <input type="hidden" id="estat" name="estat" value="{{$estat}}">
    <input type="hidden" id="criteriOrdenacio" name="criteriOrdenacio" value="{{$criteriOrdenacio}}">
    <input type="hidden" id="sentitOrdenacio" name="sentitOrdenacio" value="{{$sentitOrdenacio}}">
    <input type="hidden" id="registresPagina" name="registresPagina" value="{{$registresPagina}}">
    <input type="hidden" id="pageNumber" name="pageNumber" value="{{$pageNumber}}">
    {{-- <input type="hidden" id="nouNomAcredit" name="nouNomAcredit" value="{{$nouNomAcredit}}">
    <input type="hidden" id="nouPesAcredit" name="nouPesAcredit" value="{{$nouPesAcredit}}">
    <input type="hidden" id="dnone" name="dnone" value="{{$dnone}}">--}}
</form>
{{--
<form id="showForm" action="{{ route($taula.'Show') }}" method="post">
    @csrf
    <input type="hidden" id="show_id" name="show_id" value="">
</form>--}}

<form id="editForm" action="{{ route($taula.'Edit') }}" method="post">
    @csrf
    <input type="hidden" id="edit_id" name="edit_id" value="">
</form>

<form id="chstForm" action="{{ route($taula.'ChangeState') }}" method="post">
    @csrf
    <input type="hidden" id="chst_id" name="chst_id" value="">
</form>

{{-- <form id="createForm" action="{{ route('acreditStore') }}" method="post">
    @csrf
    <input type="hidden" id="create_idNom" name="form_nomAcredit" value="">
    <input type="hidden" id="create_idPes" name="form_pesAcredit" value="">
</form>

<form id="updateForm" action="{{ route('acreditUpdate',['acreditList'=>$acreditList]) }}" method="post">
    @csrf
    <input type="hidden" id="update_nom" name="form_nomAcredit" value="">
    <input type="hidden" id="update_pes" name="form_pesAcredit" value="">
    <input type="hidden" id="update_id" name="form_idAcredit" value="">
</form>
--}}