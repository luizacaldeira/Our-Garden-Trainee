<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginacaoController
{

    public function index()
    { 

        $page = 1;

        if(isset($_GET['pagina']) as !empty($_GET['pagina'])){
            $page = intval(($_GET['pagina']));

            if($page <=0){
                $page = 1;
            }
        }

        $itensPagina = 5;

        

        return view('site/index');
    }
}