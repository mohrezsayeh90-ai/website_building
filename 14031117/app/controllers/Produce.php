<?php

namespace App\Controllers;

use App\Models\ProduceModel as PrdM;
use App\Models\PrjManModel as PrjManM;

class Produce extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][10]['access'] == 1 || isset($_SESSION['admin'])) {
            $produceAddress = 'produce/tab1';
            $this->view('supply/produce', compact('produceAddress'));
        } else $this->view('auth/404');
    }

    public function tab1()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][10]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new PrdM();
            $incompleteProj = $thisModel->getIncompleteProjProduce();
            $this->view('supply/tab1', compact('incompleteProj'));
        } else $this->view('auth/404');
    }

    public function tab12()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][10]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new PrdM();
            $incompleteOrders = $thisModel->getIncompleteOrders();
            //  print_r($incompleteOrders);
            $this->view('supply/tab12', compact('incompleteOrders'));
        } else $this->view('auth/404');
    }

    public function dpl($p)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][10]['access'] == 1 || isset($_SESSION['admin'])) {
            $prjCode = $this->test_input(rawurldecode($p));
            $prjMan = new PrjManM();
            $thisModel = new PrdM();
            $materials = $prjMan->selectDPL($prjCode);

            $data = $thisModel->getQtydeman_draft($materials[8][0]['prj_cod']);
            for ($i = 0; $i < count($materials[8]); $i++) {
                $materials[8][$i]['Remained'] = $materials[8][$i]['qty'] + $materials[8][$i]['spare']+ $materials[8][$i]['col1']+
                    $materials[8][$i]['col2']+$materials[8][$i]['col3']+$materials[8][$i]['col4']+$materials[8][$i]['col5'];
                for ($j = 0; $j < count($data); $j++) {
                    if ($data[$j]['search'] == 1) continue;
                    if ($materials[8][$i]['mah_cod'] == $data[$j]['mah_cod'] && $materials[8][$i]['equip'] == $data[$j]['equip'] && $materials[8][$i]['type'] == $data[$j]['spec']
                        && $materials[8][$i]['manufact'] == $data[$j]['manufact']) {
                        $data[$j]['search'] = 1;
                        $materials[8][$i]['Ordered'] = $data[$j]['qty_demand'];
                        $materials[8][$i]['Received'] = $data[$j]['qty_draft'];
                        $materials[8][$i]['Remained'] = $materials[8][$i]['qty'] + $materials[8][$i]['spare']+ $materials[8][$i]['col1']+
                        $materials[8][$i]['col2']+$materials[8][$i]['col3']+$materials[8][$i]['col4']+$materials[8][$i]['col5'] - $data[$j]['qty_demand'];
                        break;
                    }
                }
            }
            $this->view('supply/tabdpl', compact('materials'));
        } else $this->view('auth/404');

    }

    public function registerDeman()
    {
        ////Badge required
        $thisModel = new PrdM();
        $dno=$this->test_input($_POST["dno"]);
        $ddate=$this->test_input($_POST["ddate"]);
        $thisModel->registerDemand($_POST['data'],$dno,$ddate);
    }

    public function demandDetails($p, $o)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][10]['access'] == 1 || isset($_SESSION['admin'])) {
            $prjCode = $this->test_input(rawurldecode($p));
            $orderTime = $this->test_input(rawurldecode($o));
            $thisModel = new PrdM();
            $allData = $thisModel->demandDetails($prjCode, $orderTime);
            $signData = [];
            $boughtData = [];
            if (isset($_GET['closed'])) {
                $signData = $thisModel->getallDraft($p, $allData[0]['demand_no']);
                $boughtData = $thisModel->getallBought($p, $allData[0]['demand_no']);
            }
            // print_r($allData);
            $this->view('supply/tab121', compact('allData', 'signData', 'boughtData'));
        } else $this->view('auth/404');
    }

    public function tab122()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][10]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new PrdM();
            $completeOrders = $thisModel->getcompleteOrders();
            //  print_r($completeOrders);
            $this->view('supply/tab122', compact('completeOrders'));
        } else $this->view('auth/404');
    }
}