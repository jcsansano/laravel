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

// Botons d'estat (Actius / Inactius / Tots)
$('.btn-estat').on('click', function() {
    var botoPolsat = $(this).prop('id');
    switch (botoPolsat) {
        case "btnElementActius":    $('#estat').prop('value', 'A');     break;
        case "btnElementInactius":  $('#estat').prop('value', 'I');     break;
        case "btnElementTots":      $('#estat').prop('value', 'T');     break;
    }
    $('#selectionForm').submit();
});
// Fi de botones d'estat

// Ordre ascendent o descendent
$('.ordenacio').on('click', function(e) {
    e.preventDefault();
    $camp=$(this).prop('value');
    $('#criteriOrdenacio').prop('value', $camp);
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
// Fi de canviar