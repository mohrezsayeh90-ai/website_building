<?php

namespace App\Controllers;

class Test extends Controller
{
    public function index()
    {
        $prjman= new PrjMan();
        $allbpmData=$prjman->getAllBpmData('P000001');

        $this->view('project/test',compact('allbpmData'));
    }
    public function show($p)
    {
        $prjman= new PrjMan();
        $allbpmData=$prjman->getAllBpmData( $this->test_input(rawurldecode($p)));

        $this->view('project/test',compact('allbpmData'));
    }
    public function tab33()
    {
        $prjman= new PrjMan();
        $allbpmData=$prjman->getAllBpmData( $this->test_input(rawurldecode($p)));

        $this->view('project/test',compact('allbpmData'));
    }
}