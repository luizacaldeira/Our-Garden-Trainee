<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class DashboardController
{
    
    public function index()
    {
        $total_post = App::get('database')->countAll('publicacoes');
        $total_user = App::get('database')->countAll('usuarios');

        return view('admin/dashboard', compact('total_post', 'total_user'));
    }
}