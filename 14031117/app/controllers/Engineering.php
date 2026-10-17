<?php

namespace App\Controllers;
use App\Models\PrjManModel as prjMan;
class Engineering extends Controller
{
    public function index()
    {
          if (isset($_SESSION['access']) && $_SESSION['access'][9]['access'] == 1 || isset($_SESSION['admin'])) {
              $prjM = new prjMan();
              $incompleteProj = $prjM->getIncompleteProj(8);
              $completeProj = $prjM->getcompleteProj();
              $this->view('project/eng/prjman', compact('incompleteProj','completeProj'));
          }else $this->view('auth/404');
    }
    public function dpl($p)
    {
          if (isset($_SESSION['access']) && $_SESSION['access'][9]['access'] == 1 || isset($_SESSION['admin'])) {
              $prjCode = $this->test_input(rawurldecode($p));
              $prjM = new prjMan();
              $materials = $prjM->selectDPL($prjCode);
              $this->view('project/eng/ddetails', compact('materials'));
          }else $this->view('auth/404');
    }
}