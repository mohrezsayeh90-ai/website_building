<?php

namespace App\Controllers;

use App\Models\InitializeMeModel as initT;

class InitializeMe extends Controller
{
    public function m3455436788769009()
    {
        if ($_SESSION['tke'] == 'admin') {
            $startm = new initT();
            $startm->startInitialize();
        }
    }
}