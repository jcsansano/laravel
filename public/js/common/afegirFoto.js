// valida i afegix la imatge seleccionada a la vista actual (no la emmagatza)
$('#pujaFoto').change(function(e){ 
    var formatsAdmesos=['image/png','image/gif','image/jpeg','image/tiff','image/webp','image/svg+xml'];
    // Creem l'objecte de la classe FileReader
    let reader = new FileReader();
    // Llegim l'arxiu pujat i el passem al nostre fileReader
    reader.readAsDataURL(e.target.files[0]);
    arxiu=e.target.files[0];

    var imatgeValida=false;    //indica si la imatge complix les condicions
    if(formatsAdmesos.indexOf(arxiu.type)>-1){  //si la imatge és del tipus admés
            imatgeValida=true;
    }    
        // Li diem que quan estiga llest execute el còdigo intern
        reader.onload = function(){
            let preview = document.getElementById('preview'),
            
            imatge = document.createElement('img'); //creem un lloc on col·locar la imatge
          
        if(imatgeValida){                       // si la imatge es vàlida la carregue
                imatge.src = reader.result;     // col·loque la nova imatge
                
                                            //anote el nom de la imatge per poder passar-la a la DB
  
                
            }else{                  // sino carregue la imatge base
                imatge.src= "../fotos/nologoseu.jpg";
            }                       //afegim les classes per presentar la imatge
            imatge.classList.add("img-fluid","rounded", "float-center" ); 
            preview.innerHTML = '';             //s'elimina la imatge anterior
            preview.append(imatge);             //col·loquem la imatge al seu lloc
        };
});

