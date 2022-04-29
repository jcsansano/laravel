/**$('#ranges-modal').modal({
    backdrop: 'static',
    keyboard: false,
    focus: true,
    show: false
});*/

// Boto Afegir registre
$('#nouOrgAcred_id').on('keyup',function(){ checkNewRecord(); });
// Fi Boto Afegir
    
//funcio per habilitar / deshabilitar boto de creació de registre
function checkNewRecord() {
    if($.trim($('#nouOrgAcred_id').prop('value'))==''){
        $('.create-record').addClass('disabled');
        $('#nouOrgAcred').prop('value',$('#nouOrgAcred_id').prop('value'));
    }else{
        $('.create-record').removeClass('disabled');
    }
}
//Fi funcio 
checkNewRecord();

//Crear un nouOrgAcred
$('#create-orgAcred').on('click',function(e){
    e.preventDefault();
    $('#create_id').prop('value', $('#nouOrgAcred_id').prop('value'));
$('#createForm').submit();  
})
//Fi nouOrgAcred

//Mostrar formulari de Afegir orgAcredAfegir
$('#btnNouOrgAcredAfegir').on('click', function(e) {
    e.preventDefault();
    var classes=$('#orgAcredAfegir').attr('class');
    var split_classes=classes.split(' ');
    if(split_classes.indexOf('d-none')>0){
        $('#orgAcredAfegir').removeClass('d-none');
       //  $('#dnone').prop('value','');
    }else{
        $('#orgAcredAfegir').addClass('d-none');
        $('#dnone').prop('value','d-none');
    }
});
//Fi mostrar formulari

//Editar Registre
$('.orgAcredEdit').on('click',function(e){
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
    $('#update_nom').prop('value', $('#btn'+actiu).prop('value'));
    $('#updateForm').submit();  
});
//Fi modificar registre