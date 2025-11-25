<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class PaginaPostsController
{

    public function index()
    {
        return view('site/paginaDePosts');
    }
}