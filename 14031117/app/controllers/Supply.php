<?php

namespace App\Controllers;

class Supply extends Controller
{
    public  function index()
    {
        return $this->view('project/request');
    }
    public function request()
    {
        return $this->view('supply');
    }
}