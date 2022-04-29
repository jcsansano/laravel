
<?php

/*  Mòdul: navbar.blade.php
 *  Joan Carles Sansano Belso 2021 DWES-DAW" 
 *  Exercici: Gepol
 *  Descripció: 
 */
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-blue-600 bg-success">
    <a class="navbar-brand" href="{{ route('inicio') }}">GePOL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <!--li class="nav-item active">
                <a class="nav-link" href="{{ route('inicio') }}"></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownOrgAcred" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Organs Acreditadors
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownOrgAcred">
                    <a class="dropdown-item" href="{{ route('orgAcredList') }}">Llista</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAcreditacions" role="button" 
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Viajes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownAcreditacions">
                    <a class="dropdown-item" href="{{ route('acreditList') }}">Llista</a>
                </div>
            </li-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCustomers" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    T.Auxiliars
                </a>
                <div class="dropdown-menu bg-info" aria-labelledby="navbarDropdownCustomers">
                    <a class="dropdown-item" href="llistaAcredit">Acreditacions</a>
                    <a class="dropdown-item" href="llistaOrgAcred">Org. Acreditadors</a>
                    <!--a class="dropdown-item" href="#">Editar</a>
                    <a class="dropdown-item" href="#">Eliminar</a-->
                </div>
            </li>
        </ul>
    </div>
</nav>

