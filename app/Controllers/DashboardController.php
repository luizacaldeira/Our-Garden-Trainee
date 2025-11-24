<?php

namespace App\Controllers;

use App\Core\App;
use Exception;

class DashboardController
{
    
    public function index()
    {
        return view('admin/dashboard');
    }
}