//variables request
        $estat=(isset($request['estat']))?$request['estat']:'A';
        $sentitOrdenacio=(isset($request['sentitOrdenacio']))?$request['sentitOrdenacio'] : 'ASC';
        $criteriOrdenacio=(isset($criteriOrdenacio))?$criteriOrdenacio:'nomAcredit';
    // Paginat
        $registresPagina = (isset($request['registresPagina']))?(int)$request['registresPagina']:5;
        $pageNumber = (isset($request['pageNumber']))?$request['pageNumber']:1;
        $acreditQuery=DB::table($taula);
        if ($estat == 'A') {  $acreditQuery->whereNull('deleted_at');               // Actius
        } elseif ($estat == 'I') { $acreditQuery->whereNotNull('deleted_at');  }    // Inactius
        $acreditQuery->orderBy($criteriOrdenacio,$sentitOrdenacio);
        $registresTrobats = count($acreditQuery->get());
        if ($registresPagina == 0) {
            $registresATrobar = $registresTrobats;
            $pageNumber = 1;
        } else {
            $registresATrobar = $registresPagina;
            $maxPage = ceil($registresTrobats/$registresATrobar);
            if ($pageNumber > $maxPage)
            {
                $pageNumber = $maxPage;
            }
        }
        $acreditList = $acreditQuery->paginate($registresATrobar, ['*'], 'pageNumber', $pageNumber);