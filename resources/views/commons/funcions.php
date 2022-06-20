<?php

function pujarImatge(){
    $pesImg=300;  //en kbytes
    $missatgeCarrega='';
    if(strlen($_FILES['imatge']['tmp_name'])>0){
        $imgPermeses=[1,2,3,4,5,6,7,8];
        $temporal = $_FILES["imatge"]["tmp_name"];
        $propietats= getimagesize($_FILES['imatge']['tmp_name']);
        $desti ="./fotos/" . $_FILES["imatge"]["name"];
        $missatgeCarrega.=(isset($_FILES['imatge']['name']) 
            && $_FILES['imgArt']['size']==0)?"- No te contingut.<br/>":"";
        $missatgeCarrega.=($_FILES['imgArt']['size']>($pesImg*1024))?"- Pes superior a ".$pesImg."Kb.<br/>":"";
        $missatgeCarrega.=   
                (in_array($propietats[2], $imgPermeses))?"":"- Tipus de arxiu no permés";
        if($missatgeCarrega==""){ 
            if (move_uploaded_file($temporal, $desti)) {
                $missatgeCarrega="L'axiu ".$_FILES["imgArt"]["name"]."s'ha carregat correctament.";
            }else {
                $missatgeCarrega="S'ha produït un error en la carrega de l'arxiu ".$_FILES["imgArt"]["name"];
            }
        }else{
            $missatgeCarrega="Problemes amb l'arxiu triat:<br>".$missatgeCarrega;
        }
    }
    return $missatgeCarrega;
}