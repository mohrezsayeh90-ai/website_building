<?php

namespace App\Controllers;

use App\Models\PrjManModel;
use App\Models\ProduceModel;

use App\Models\ProduceModel as PrdM;
use App\Models\StoreModel;

class Store extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $storeAddress = 'store/tab2';
            $this->view('supply/store/store', compact('storeAddress'));
        } else $this->view('auth/404');
    }

    public function tab2()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incompleteProj = $thisModel->getIncompleteProjProduce();
            $this->view('supply/store/tab2', compact('incompleteProj'));
        } else $this->view('auth/404');
    }

    public function tab22()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incompleteOrders = $thisModel->getIncompleteOrders();
            //  print_r($incompleteOrders);
            $this->view('supply/store/tab22', compact('incompleteOrders'));
        } else $this->view('auth/404');
    }

    public function tab23()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            //$thisModel=new ProduceModel();
            // $incompleteOrders=$thisModel->getIncompleteOrders();
            //  print_r($incompleteOrders);
            $thisFrame = 'store/tab231';
            $thisFrame1 = 'store/tab232';
            $this->view('supply/store/tab23', compact('thisFrame', 'thisFrame1'));
        } else $this->view('auth/404');
    }

    public function tab231()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incbuyOrder = $thisModel->getIncompleteBuyOrders();
            //print_r($incbuyOrder);

            $this->view('supply/store/tab231', compact('incbuyOrder'));
        } else $this->view('auth/404');
    }

    public function tab232()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incbuyOrder = $thisModel->getCompleteBuyOrders();
            //print_r($incbuyOrder);

            $this->view('supply/store/tab232', compact('incbuyOrder'));
        } else $this->view('auth/404');
    }

    public function trade($p, $b)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $prjCode = $this->test_input(rawurldecode($p));
            $buyNo = $this->test_input(rawurldecode($b));
            $thisModel = new ProduceModel();
            $Order = $thisModel->getBuyOrders($prjCode, $buyNo);
            //print_r($Order);

            $this->view('supply/store/shop', compact('Order'));
        } else $this->view('auth/404');
    }

    public function reqDate()
    {
        $id = $this->test_input($_POST['id']);
        $dvalue = $this->test_input($_POST['dvalue']);
        $strMod = new StoreModel();
        $strMod->setreqDate($id, $dvalue);
        //print_r($Order);

        // $this->view('supply/store/shop',compact('Order'));
    }

    public function reqDescriptions()
    {

        $id = $this->test_input($_POST['id']);
        $dvalue = $this->test_input($_POST['dvalue']);
        $strMod = new StoreModel();
        $strMod->setreqDescriptions($id, $dvalue);
        //print_r($Order);

        // $this->view('supply/store/shop',compact('Order'));
    }

    public function signBuyReq()
    {
        //badge required
        $p = $this->test_input($_POST['p']);
        $b = $this->test_input($_POST['b']);
        $strMod = new StoreModel();
        $strMod->signBuyReq($p, $b);

    }

    public function closeDemand()
    {
        //badge required
        $p = $this->test_input($_POST['p']);
        $d = $this->test_input($_POST['d']);
        $desc = $this->test_input($_POST['desc']);
        $strMod = new StoreModel();
        $strMod->closeDemand($p, $d, $desc);

    }

    public function dpl($p)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
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
            $this->view('supply/store/tabdpl', compact('materials'));
        } else $this->view('auth/404');
    }

    public function demandDetails($p, $o)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $prjCode = $this->test_input(rawurldecode($p));
            $orderTime = $this->test_input(rawurldecode($o));
            $thisModel = new ProduceModel();
            $allData = $thisModel->demandDetails($prjCode, $orderTime);
            $signData = [];
            $boughtData = [];
            if (isset($_GET['closed'])) {
                $signData = $thisModel->getallDraft($p, $allData[0]['demand_no']);
                $boughtData = $thisModel->getallBought($p, $allData[0]['demand_no']);
                //  print_r( $signData);
            }

            $this->view('supply/store/tab221', compact('allData', 'signData', 'boughtData'));
        } else $this->view('auth/404');
    }

    public function sabtDemanNo()
    {
        $strM = new StoreModel();
        $demandTime = $this->test_input($_POST['demandTime']);
        $demandNo = $this->test_input($_POST['demandNo']??'0');
        $demandNo = substr("00000" . $demandNo,-5);
        $strM->sabtDemanNo($demandTime, $demandNo);
    }

    public function draftAll()
    {
        ///badge required
        $strM = new StoreModel();
        $prjCode = $this->test_input($_POST['prjCode']);
        $demandNo = $this->test_input($_POST['demandNo']);
        $draftNo = $this->test_input($_POST['draftNo']??'0');
        $draftNo = substr("00000" . $draftNo,-5);
        $strM->draftAll($prjCode, $demandNo, $draftNo);
    }

    public function buyAll()
    {
        ///badge required
        $strM = new StoreModel();
        $prjCode = $this->test_input($_POST['prjCode']);
        $demandNo = $this->test_input($_POST['demandNo']);
        $buyNo = $this->test_input($_POST['buyNo']??'0');
        $buyNo = substr("00000" . $buyNo,-5);
        $strM->buyAll($prjCode, $demandNo, $buyNo);
    }

    public function tab222()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][11]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $completeOrders = $thisModel->getcompleteOrders();
            //  print_r($completeOrders);
            $this->view('supply/store/tab222', compact('completeOrders'));
        } else $this->view('auth/404');
    }

    public function registerDraft()
    {
        ///badge required
        $strM = new StoreModel();
        $prjCode = $this->test_input($_POST['prjCod']);
        $demandNo = $this->test_input($_POST['demandNo']);
        $draftNo = intval($this->test_input($_POST['draftNo']??'0'));
        $draftNo = substr("00000" . $draftNo,-5);
        $id = $this->test_input($_POST['id']);
        $No = $this->test_input($_POST['No']);
        if (intval($draftNo)==0 || $draftNo == '' || $No == '') return "bad";
        $strM->registerDraft($prjCode, $demandNo, $draftNo, $id, $No);
        return "ok";
    }

    public function registerBuy()
    {
        ///badge required
        $strM = new StoreModel();
        $prjCode = $this->test_input($_POST['prjCod']);
        $demandNo = $this->test_input($_POST['demandNo']);
        $buyNo = intval($this->test_input($_POST['buyNo']??'0'));
        $buyNo = substr("00000" . $buyNo,-5);
        $id = $this->test_input($_POST['id']);
        $No = $this->test_input($_POST['No']);
        if (intval($buyNo)==0 || $buyNo == '' || $No == '') return "bad";
        $strM->registerBuy($prjCode, $demandNo, $buyNo, $id, $No);
        return "ok";
    }
    public function getproperdemandno()
    {
        $demandNo = $this->test_input($_POST['demandtime']);
        $strM = new StoreModel();
        echo json_encode($strM->getproperdemandno($demandNo));
    }
    public function getproperdraftno()
    {
        $strM = new StoreModel();
        echo json_encode($strM->getproperdraftno());
    }
    public function getproperbuyno()
    {
        $strM = new StoreModel();
        echo json_encode($strM->getproperbuyno());
    }
}