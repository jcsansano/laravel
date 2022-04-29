<?php

/*  Mòdul: usuariCrear.blade.php
 *  Joan Carles Sansano Belso 2022 DWES-DAW" 
 *  Exercici: GePOL
 *  Descripció: Mòdul de creació d'usuaris
 *  Laravel
 */
?>
<html>
    <head></head>
    <body>
        <h2>Creació d'usuaris</h2>
        <form  method="Post" action="afegirUsuari.php">
            <label>NIF:</label>
            <input type="text" name="NIFUsuari"/>
            <label>Nom:</label>
            <input type="text" name="nomUsuari"/>
            <label>Cognoms:</label>
            <input type="text" name="cognomsUsuaris"/>
            <label>correu:</label>
            <input type="text" name="correuUsuari"/>
            <label>Notes:</label>
            <input type="text" name="NotesSeu"/>
            <label>Foto:</label>
            <div class="perfil mb-3">
                <label>Perfil:</label>
                <select name="perfil" type="file" placeholder="Perfil">
                    <option value="Administrador">Administrador</option>
                    <option value="Col·laborador">Col·laborador</option>
                    <option value="Coordinador">Coordinador de Seu</option>
                </select>
            <input type="text" name="nomUsuari"/>
            <input type="text" name="FotoUsuari"/> 
            <div class="pujarImatge">
                <input type="file" name="FotoSeu" accept="image/*" 
                       placeholder="Arxiu Usuari" >
                <button name="pujArxiu" type="submit" class="btn btn-info"
                      onclick="this.form.action='pujaArxiu.php'">Carrega imatge
                </button>
            </div>
            <input type="clear" value="Buidar"><input type="submit" value="Crear">
        </form>
        
    </body>
</html>
