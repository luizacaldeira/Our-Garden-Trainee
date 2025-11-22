<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginacaoController
{

    public function index()
    {
        $page=1;

        if(isset($_GET['paginacaoNumero']) && !empty($_GET['paginacaoNumero'])){
            $page = intval($_GET['paginacaoNumero']);

            if($page<=0){
                return redirect('admin/listaPosts');
            }
        }
        $itensPage = 5;
        $inicio = $itensPage * $page - $itensPage;
        $rows_count = App::get('database')->countAll('posts');
        
        if($inicio>$rows_count){
            return redirect('admin/listaPosts');
        }

        $posts = App::get('database')->selectAll('posts');
        return view('admin/listaPosts');
    }
    
}