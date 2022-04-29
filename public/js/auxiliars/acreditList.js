// Boto Afegir registre
$('#nouNomAcredit_id').on('keyup',function(){ checkNewRecord(); });
$('#nouPesAcredit_id').on('keyup',function(){ checkNewRecord(); });
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
checkNewRecord();

//Crear un nouAcredit
$('#create-Acredit').on('click',function(e){
    e.preventDefault();
    $('#create_idNom').prop('value', $('#nouNomAcredit_id').prop('value'));
    $('#create_idPes').prop('value', $('#nouPesAcredit_id').prop('value'));
$('#createForm').submit();  
})
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