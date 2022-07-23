<?php 
function construirNomImatge($taula,$id,$ext){
	return $taula.str_pad($id,4,'0',STR_PAD_LEFT).'.'.$ext;
}
function pujarImatge($desti){
//https://datoweb.com/post/2921/como-redimensionar-o-reducir-peso-de-imagenes-con-php
//per al certes funcions cal activar la directiva de PHP ';extension=gd'
	$pesMaxim=1024*500; //kb
	$retorna=0;
	if(isset($_FILES['imatge'])){

//Funciones optimizar imagenes


//Ruta de la carpeta donde se guardarán las imagenes
		$patch=$desti; //'../fotos/';

//Parámetros optimización, resolución máxima permitida
		$max_ancho = 384; // 256 1280; 256 640 320
		$max_alto = 270;  // 180 900;   180 450 225

		if($_FILES['imatge']['type']=='image/png' || 
			$_FILES['imatge']['type']=='image/jpeg' ||
			$_FILES['imatge']['type']=='image/gif' ||
			$_FILES['imatge']['type']=='image/wbmp' ||
			$_FILES['imatge']['type']=='image/xpm'){
			
			$medidasimagen= getimagesize($_FILES['imatge']['tmp_name']);

//Si las imagenes tienen una resolución y un peso aceptable se suben tal cual
			if($medidasimagen[0] < $max_ancho && $_FILES['imatge']['size'] < $pesMaxim){
				//$nombrearchivo=$_FILES['imatge']['name'];
				move_uploaded_file($_FILES['imatge']['tmp_name'], $patch); //.$nombrearchivo);
			} else { //Si no, se generan nuevas imagenes optimizadas
				//$nombrearchivo=$_FILES['imatge']['name'];
//Redimensionar
				$rtOriginal=$_FILES['imatge']['tmp_name'];

				switch($_FILES['imatge']['type']){
					case 'image/jpeg': $original = imagecreatefromjpeg($rtOriginal);	break;
					case 'image/png': $original = imagecreatefrompng($rtOriginal);		break;
					case 'image/gif': $original = imagecreatefromgif($rtOriginal);		break;
					case 'image/wbmp': $original = imagecreatefromwbmp($rtOriginal);	break;
					case 'image/xpm': $original = imagecreatefromxpm($rtOriginal);		break;
					default: 
				}
 
				list($ancho,$alto)=getimagesize($rtOriginal);

				$x_ratio = $max_ancho / $ancho;
				$y_ratio = $max_alto / $alto;

				if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
					$ancho_final = $ancho;
					$alto_final = $alto;
				}
				elseif (($x_ratio * $alto) < $max_alto){
					$alto_final = ceil($x_ratio * $alto);
					$ancho_final = $max_ancho;
				}
				else{
					$ancho_final = ceil($y_ratio * $ancho);
					$alto_final = $max_alto;
				}

				$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
				imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
 
//imagedestroy($original);
 
		//$cal=8;

				switch($_FILES['imatge']['type']){
					case 'image/jpeg':	imagejpeg($lienzo,$patch);	break; //.$nombrearchivo
					case 'image/png':	imagepng($lienzo,$patch);	break; //.$nombrearchivo
					case 'image/gif':	imagegif($lienzo,$patch);	break; //.$nombrearchivo
					case 'image/wbmp':	imagewbmp($lienzo,$patch);	break; //.$nombrearchivo
					case 'image/xpm': 	imagejpeg($lienzo,str_ireplace('.xpm','.jpeg',$patch));	break;
					default: $retorna=3;  // tipus mime no sortat
				}
			}
   	 	} else {$retorna=2;}  // tipus de extensio no soportada
	} else {$retorna=1;}  // no s'ha trobat la imatge pujada
	return $retorna;
}

?>