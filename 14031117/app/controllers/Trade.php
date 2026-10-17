<?php

namespace App\Controllers;

use App\Models\PrjManModel;
use App\Models\ProduceModel;
use App\Models\TradeModel;

class Trade extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $tradeAddress = 'trade/tab3';
            $this->view('supply/trade/trade', compact('tradeAddress'));
        } else $this->view('auth/404');
    }

    public function tab3()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incompleteProj = $thisModel->getIncompleteProjProduce();
            $this->view('supply/trade/tab3', compact('incompleteProj'));
        } else $this->view('auth/404');
    }

    public
    function tab33()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            //$thisModel=new ProduceModel();
            // $incompleteOrders=$thisModel->getIncompleteOrders();
            //  print_r($incompleteOrders);
            $thisFrame = 'trade/tab331';
            $thisFrame1 = 'trade/tab332';
            $this->view('supply/trade/tab33', compact('thisFrame', 'thisFrame1'));
        } else
            $this->view('auth/404');
    }

    public
    function tab331()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incbuyOrder = $thisModel->getIncompleteBuyOrdersTrade();
            //print_r($incbuyOrder);

            $this->view('supply/trade/tab331', compact('incbuyOrder'));
        } else
            $this->view('auth/404');
    }
    public
    function tab3311()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new TradeModel();
            $incbuyOrder = $thisModel->getBuyOrderswithCommandTrade();
            //print_r($incbuyOrder);

            $this->view('supply/trade/tab3311', compact('incbuyOrder'));
        } else
            $this->view('auth/404');
    }
    public
    function tab3312()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new TradeModel();
            $incbuyOrder = $thisModel->getBuyOrderPackingList();
            //print_r($incbuyOrder);

            $this->view('supply/trade/tab3312', compact('incbuyOrder'));
        } else
            $this->view('auth/404');
    }
    public
    function tab3313()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new TradeModel();
            $incbuyOrder = $thisModel->getinBuyOrdersTrade();
            //print_r($incbuyOrder);

            $this->view('supply/trade/tab3313', compact('incbuyOrder'));
        } else
            $this->view('auth/404');
    }
    public
    function packing($p,$d)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new TradeModel();

            $pack = trim($this->test_input(rawurldecode($p)));
            $packd = $_GET['d'];
            $incbuyOrder = $thisModel->getPackingData($pack,$packd);
            //print_r($incbuyOrder);

            $this->view('supply/trade/packing', compact('incbuyOrder'));
        } else
            $this->view('auth/404');
    }
    public function packingcompleted(){
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new TradeModel();

            $pack = $this->test_input($_POST['p']);
            $packd = $_POST['d'];
            $incbuyOrder = $thisModel->packingcompleted($pack,$packd);
            //print_r($incbuyOrder);


        }
    }
    public
    function tab332()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $thisModel = new ProduceModel();
            $incbuyOrder = $thisModel->getCompleteBuyOrdersTrade();
            //print_r($incbuyOrder);

            $this->view('supply/trade/tab332', compact('incbuyOrder'));
        } else
            $this->view('auth/404');
    }

    public
    function trade($p, $b)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
            $prjCode = $this->test_input(rawurldecode($p));
            $buyNo = $this->test_input(rawurldecode($b));
            $thisModel = new ProduceModel();
            $Order = $thisModel->getBuyOrders($prjCode, $buyNo);
            $levels = $thisModel->getTradeLevels();
            $signs = $thisModel->getSigns($prjCode, $buyNo);
            $docs = $thisModel->getbuyDocs($prjCode, $buyNo);
            //print_r($Order);

            $this->view('supply/trade/shop', compact('Order', 'levels', 'signs', 'docs'));
        } else
            $this->view('auth/404');
    }

    public
    function setPrice()
    {
        $id = $this->test_input($_POST['id']);
        $p = $this->test_input($_POST['p']);
        $value = $this->test_input($_POST['value']);
        $thisModel = new TradeModel();
        $Order = $thisModel->setPrice($id, $p, $value);
        //print_r($Order);

        //  $this->view('supply/trade/shop',compact('Order'));
    }

    public
    function closeBuyReq()
    {

        $p = $this->test_input($_POST['p']);
        $b = $this->test_input($_POST['b']);
        $thisModel = new TradeModel();
        $Order = $thisModel->closeBuyReq($p, $b);
        //print_r($Order);

        //  $this->view('supply/trade/shop',compact('Order'));
    }
    public function issueBuyCommand()
    {
        $p = $this->test_input($_POST['p']);
        $b = $this->test_input($_POST['b']);
        $thisModel = new TradeModel();
        $Order = $thisModel->issueBuyCommand($p, $b);
    }
    public
    function setTradeLevel()
    {
        $id = $this->test_input($_POST['id']);
        $value = $this->test_input($_POST['value']);
        $thisModel = new TradeModel();
        $thisModel->setTradeLevel($id, $value);
        //print_r($Order);

        //  $this->view('supply/trade/shop',compact('Order'));
    }

    public
    function signBuyReq()
    {
        //badge required
        $p = $this->test_input($_POST['p']);
        $b = $this->test_input($_POST['b']);
        $type = $this->test_input($_POST['type']);
        $thisModel = new TradeModel();
        $thisModel->signBuyReq($p, $b, $type);
        //print_r($Order);

        //  $this->view('supply/trade/shop',compact('Order'));
    }

    public
    function uploadAppendix()
    {
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileContent = file_get_contents($_FILES['file']['tmp_name']);
        $projCode = $this->test_input($_POST['proj_code']);
        $buyNo = $this->test_input($_POST['buy_no']);
        //$currentPath=$this->prjManM->getCurrentPath();
        $bytes = random_bytes(32);
        $fileN = bin2hex($bytes);
        $extt = explode('.', $fileName);
        $thismodel = new TradeModel();
        $fp = fopen('d:\\apache24\\htdocs\\mehrabad\\assets\\images\\supply\\' . $fileN . '.' . $extt[count($extt) - 1], "w");
        fwrite($fp, $fileContent);
        $thismodel->insertUplodedFiles($projCode, $fileName, $fileN . '.' . $extt[count($extt) - 1], $buyNo);
    }

    public
    function dpl($p)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][12]['access'] == 1 || isset($_SESSION['admin'])) {
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
            $this->view('supply/trade/tabdpl', compact('materials'));
        } else
            $this->view('auth/404');
    }
    public function getproperpacking()
    {
        $thisModel = new TradeModel();
        echo json_encode($thisModel->getproperpacking());
    }
    public function setpackno(){

        $thisModel = new TradeModel();
        $packno = $this->test_input($_POST['packno']);
        $mdata = $_POST['mdata'];
        $thisModel->setpackno($packno,$mdata);
    }
}