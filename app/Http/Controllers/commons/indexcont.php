        <?php

        $estat=(isset($request['estat']))?$request['estat']:'A';
        $criteriOrdenacio=(isset($criteriOrdenacio))?$criteriOrdenacio:$campOrdenacio;
        $sentitOrdenacio=(isset($request['sentitOrdenacio']))?$request['sentitOrdenacio'] : 'ASC';

        // Paginat
        $registresPagina = (isset($request['registresPagina']))?(int)$request['registresPagina']:5;
        $pageNumber = (isset($request['pageNumber']))?$request['pageNumber']:1;
        $taulaQuery=DB::table($taula);
        if ($estat == 'A') {  $taulaQuery->whereNull('deleted_at');               // Actius
        } elseif ($estat == 'I') { $taulaQuery->whereNotNull('deleted_at');  }    // Inactius

        $taulaQuery->orderBy($criteriOrdenacio,$sentitOrdenacio);
        $registresTrobats = count($taulaQuery->get());
        if ($registresPagina == 0) {
            $registresATrobar = $registresTrobats;
            $pageNumber = 1;
        } else {
            $registresATrobar = $registresPagina;
            $maxPage = ceil($registresTrobats/$registresATrobar);
            if ($pageNumber > $maxPage) {   $pageNumber = $maxPage;     }
        }
        $taulaList = $taulaQuery->paginate($registresATrobar, ['*'], 'pageNumber', $pageNumber);
        ?>