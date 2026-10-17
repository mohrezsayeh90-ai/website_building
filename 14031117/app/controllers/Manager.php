<?php

namespace App\Controllers;

use App\Models\ManagerModel;
use App\Models\PrjManModel;
use App\Models\ProduceModel;

class Manager extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            $tradeAddress = 'manager/tab3';
            $this->view('supply/manager/trade', compact('tradeAddress'));
        } else $this->view('auth/404');
    }

    public function tab3()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incompleteProj = $thisModel->getIncompleteProjProduce();
            $this->view('supply/manager/tab3', compact('incompleteProj'));
        } else $this->view('auth/404');
    }

    public function tab53()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            //$thisModel=new ProduceModel();
            // $incompleteOrders=$thisModel->getIncompleteOrders();
            //  print_r($incompleteOrders);
            $thisFrame = 'manager/tab531';
            $thisFrame1 = 'manager/tab532';
            $this->view('supply/manager/tab53', compact('thisFrame', 'thisFrame1'));
        } else $this->view('auth/404');
    }

    public function tab531()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incbuyOrder = $thisModel->getIncompleteBuyOrdersManager();
            //print_r($incbuyOrder);

            $this->view('supply/manager/tab531', compact('incbuyOrder'));
        } else $this->view('auth/404');
    }

    public function tab532()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incbuyOrder = $thisModel->getCompleteBuyOrdersManager();
            //print_r($incbuyOrder);

            $this->view('supply/manager/tab532', compact('incbuyOrder'));
        } else $this->view('auth/404');
    }

    public function trade($p, $b)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            $prjCode = $this->test_input(rawurldecode($p));
            $buyNo = $this->test_input(rawurldecode($b));
            $thisModel = new ProduceModel();
            $Order = $thisModel->getBuyOrders($prjCode, $buyNo);
            $levels = $thisModel->getTradeLevels();
            $signs = $thisModel->getSigns($prjCode, $buyNo);
            $docs = $thisModel->getbuyDocs($prjCode, $buyNo);
            //print_r($Order);
            $this->view('supply/manager/shop', compact('Order', 'levels', 'signs', 'docs'));
        } else $this->view('auth/404');
    }

    public function buyReqNotAccepted()
    {
        //badge required
        $p = $this->test_input($_POST['p']);
        $b = $this->test_input($_POST['b']);
        $type = $this->test_input($_POST['mcause']);
        $thisModel = new ManagerModel();
        $thisModel->rejectBuyReq($p, $b, $type);
        //print_r($Order);

        //  $this->view('supply/trade/shop',compact('Order'));
    }

    public function buyReqAccepted()
    {
        //badge required
        $p = $this->test_input($_POST['p']);
        $b = $this->test_input($_POST['b']);
        $type = $this->test_input($_POST['mcause']);
        $thisModel = new ManagerModel();
        $thisModel->acceptBuyReq($p, $b, $type);
        //print_r($Order);

        //  $this->view('supply/trade/shop',compact('Order'));
    }

    public function dpl($p)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][14]['access'] == 1 || isset($_SESSION['admin'])) {
            $produceC = new ProduceModel();
            $prjCode = $this->test_input(rawurldecode($p));
            $prjMan = new PrjManModel();
            $thisModel = new ProduceModel();
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
            $this->view('supply/manager/tabdpl', compact('materials'));
        } else $this->view('auth/404');
    }
}