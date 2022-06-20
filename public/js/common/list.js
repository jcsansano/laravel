/*/*  Mòdul: list.php
 *  Joan Carles Sansano Belso 2022
 *  Exercici: GePOL
 *  Descripció: Codi js per a ser inclós als llistats de taules:
 *      seusLlistar.php
 */

// Botons conjunt d'estats (Actius / Inactius / Tots)
$('.btn-estat').on('click', function() {
    var botoPolsat = $(this).prop('id');
    switch (botoPolsat) {
        case "btnElementActius":    $('#estat').prop('value', 'A');     break;
        case "btnElementInactius":  $('#estat').prop('value', 'I');     break;
        case "btnElementTots":      $('#estat').prop('value', 'T');     break;
    }
    $('#selectionForm').submit();
});
// Fi de botons conjunt d'estat

// Paginació
$('.pagination').addClass('justify-content-center');
$('#selectRegistresPagina').prop('value', $('#registresPagina').prop('value'));

// Selector de  registres per pàgina
$('#selectRegistresPagina').on('change', function() {
    //console.log($('#registresPagina').prop('value'));
    //console.log('valor Actual'+$('#selectRegistresPagina').prop('value'));
    $('#registresPagina').prop('value', $('#selectRegistresPagina').prop('value'));
    $('#selectionForm').submit();
});
// Fi de selector de registres per pàgina

// Enllaços paginació
$('.page-link').on('click', function(e){
    e.preventDefault();
    if ($(this).prop('href')) {
        var corte = $(this).prop('href').indexOf('=') + 1;
        var pageNumber = $(this).prop('href').substr(corte);
        $('#pageNumber').prop('value', pageNumber);
        $('#selectionForm').submit();
    }
});
// Fi enllaços paginació



// Ordre ascendent o descendent del camp d'ordenacio
$('.ordenacio').on('click', function(e) {
    e.preventDefault();
   // var camp = $(this).prop('value');
    //$('#criteriOrdenacio').prop('value', camp);
    $('#sentitOrdenacio').prop('value', ($('#sentitOrdenacio').prop('value') == 'ASC')?'DESC':'ASC');
    $('#selectionForm').submit();
});
// Fi de ordre ascendent o descendent

// Canviar estat
$('.enllasEstat').on('click', function(e) {
    e.preventDefault();
    $('#chst_id').prop('value', $(this).prop('id').substr(4));
    $('#chstForm').submit();
});

/*$('.registreEdit').on('click',function(e){
    e.preventDefault();
    $('#edit_id').prop('value',$(this).prop('id'));
    $('#editForm').submit();
});*/

// Boto Afegir registre  
// ES COMENTA PER QUE AÇÒ ACTIVA EL BOTO D'AFEGIR REGISTRES EN FORMULARIS DE TAULES AUXILIARS
// ON S'INSERIXEN VALOS DIRECTAMENT AL LLISTAT
// $('#nouNomAcredit_id').on('keyup',function(){ checkNewRecord(); });
// $('#nouPesAcredit_id').on('keyup',function(){ checkNewRecord(); });
// Fi Boto Afegir


//funcio per habilitar / deshabilitar boto de creació de registre
function checkNewRecord() {
    if($.trim($('#nouNomAcredit_id').prop('value'))=='' ||
       $.trim($('#nouPesAcredit_id').prop('value'))==''){
        $('.create-record').addClass('disabled');
        $('#nouAcredit').prop('value',$('#nouAcredit_id').prop('value'));
    }else{
        $('.create-record').removeClass('disabled');
    }
}
//Fi funcio 
// checkNewRecord();

//Crear un nouAcredit
// ESPECIFIC DEL LLISTAT D'ACREDITACIONS
// $('#create-Acredit').on('click',function(e){
//    e.preventDefault();
//    $('#create_idNom').prop('value', $('#nouNomAcredit_id').prop('value'));
//    $('#create_idPes').prop('value', $('#nouPesAcredit_id').prop('value'));
//  $('#createForm').submit();  
//})
//Fi nouAcredit

//Mostrar formulari de Afegir AcreditAfegir
$('#btnNouAcreditAfegir').on('click', function(e) {
    e.preventDefault();
    var classes=$('#AcreditAfegir').attr('class');
    var split_classes=classes.split(' ');
    if(split_classes.indexOf('d-none')>0){
        $('#AcreditAfegir').removeClass('d-none');
       //  $('#dnone').prop('value','');
    }else{
        $('#AcreditAfegir').addClass('d-none');
        $('#dnone').prop('value','d-none');
    }
});
//Fi mostrar formulari

//Editar Registre
$('.AcreditEdit').on('click',function(e){
    e.preventDefault();
    deshabilitar($('#actiu').prop('value').substr(3));
    var registre=$(this).prop('id');
    var showId='#registre-show'+registre;
    var inptId='#registre-inpt'+registre;
    var classes=$(showId).attr('class')
    var split_classes=classes.split(' ');
    if(split_classes.indexOf('d-none')>0){
        $(showId).removeClass('d-none');
        $(inptId).addClass('d-none');
        $('#dnone').prop('value','');
        $('#actiu').prop('value','reg0');
    }else{ 
        $(inptId).removeClass('d-none');
        $(showId).addClass('d-none');
        $('#dnone').prop('value','d-none'); 
        $('#actiu').prop('value','reg'+registre);
    }
});
//Fi Editar Registre

//Funcio deshabilitar Edicio
function deshabilitar(actiu){
    if(actiu!='0'){
        $('#registre-show'+actiu).removeClass('d-none');
        $('#registre-inpt'+actiu).addClass('d-none');
        $('#dnone').prop('value','');
    }    
}
//Fi funció deshabilitar

//Modificar registre

$('.btnModificar').on('click',function(e){
    e.preventDefault();
    actiu=$('#actiu').prop('value').substr(3);
    $('#update_id').prop('value', actiu);
    $('#update_nom').prop('value', $('#btnNom'+actiu).prop('value'));
    $('#update_pes').prop('value', $('#btnPes'+actiu).prop('value'));
    $('#updateForm').submit();  
});
//Fi modificar registre