

$('#pujaFoto').change(function(e){ 
    var pesMaximKB=500;                 //pes maxim de la imatge
    var formatsAdmesos=['image/png','image/gif','image/jpeg','image/tiff','image/webp','image/svg+xml'];
    // Creem l'objecte de la classe FileReader
    let reader = new FileReader();
    // Llegim l'arxiu pujat i el passem al nostre fileReader
    reader.readAsDataURL(e.target.files[0]);
    arxiu=e.target.files[0];

    var imatgeValida=true;    //indica si la imatge complix les condicions
    //
    novaImg=document.getElementById('novaImg'); //agrupacio d'informació de la imatge
    while(novaImg.firstElementChild){           //elimina els elements d'infomació anteriors
        novaImg.firstElementChild.remove();
    }
    nomImatge=document.createElement('h6');     //Element per al nom de la imatge
    nomImatge.innerHTML=arxiu.name;             //anota el nom de la imatge
    novaImg.append(nomImatge);                  //col·loca el nom de imatge

    tipusImatge=document.createElement('h6');   //Element per al tipus de la imatge
    if(formatsAdmesos.indexOf(arxiu.type)>-1){  //si la imatge és del tipus admés
        tipusImatge.innerHTML=arxiu.type+" >>> OK";
    }else{                                      // si el el tipus no és correcte
        tipusImatge.innerHTML=arxiu.type+" >>> Tipus incorrecte";
        imatgeValida=false;
    }        
    novaImg.append(tipusImatge);                //col·loca el tipus de imatge

    midaImatge=document.createElement('h6');    //Element per al nom de la imatge
    if(arxiu.size<=1024*pesMaximKB){            //si el pes no supera el maxim
        midaImatge.innerHTML=arxiu.size+" >>> OK";
    }else{
        midaImatge.innerHTML=arxiu.size+" >>> La imatge supera el "+pesMaximKB+" Kb";
        imatgeValida=false;
    }
    novaImg.append(midaImatge);                 //coloca el pes de la imatge
        // Li diem que quan estiga llest execute el còdigo intern
        reader.onload = function(){
            let preview = document.getElementById('preview'),
            imatge = document.createElement('img'); //creem un lloc on col·locar la imatge
        if(imatgeValida){                       // si la imatge es vàlida la carregue
                imatge.src = reader.result;     // col·loque la nova imatge
                                            //anote el nom de la imatge per poder passar-la a la DB
                $('#logo').prop('value',arxiu.name);  
            }else{                  // sino carregue la imatge base
                imatge.src= "../fotos/nologoseu.jpg";
            }                       //afegim les classes per presentar la imatge
            imatge.classList.add("img-fluid","rounded", "float-center" ); 
            preview.innerHTML = '';             //s'elimina la imatge anterior
            preview.append(imatge);             //col·loquem la imatge al seu lloc
        };
});
