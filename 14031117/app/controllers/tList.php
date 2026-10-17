<?php

namespace App\Controllers;

use App\Models\ListModel as Lst;
use App\Models\ViewModel as Sgn;

class tList extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][6]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new Lst();
            $all = $db->all();
            $this->view('list', compact('all'));
        } else $this->view('auth/404');
    }

    public function show($id)
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][5]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new Lst();
            $id = $this->test_input(rawurldecode($id));
            $tender = $db->tenderView($id);
            $products = $db->products();
//     echo '<pre/>';
//       print_r($tender);
            $this->view('view', compact('tender', 'products'));
        } else $this->view('auth/404');
    }

    public function documents()
    {
        $db = new Lst();
        $tenderCode = $this->test_input($_POST['tenderCode']);
        $files = $db->gettenderFiles($tenderCode);
        echo json_encode($files);

    }

    public function details()
    {
        $db = new Lst();
        $det = $db->details($this->test_input($_POST["code"]));
        echo json_encode($det);

    }

    public function document()
    {
        $db = new Lst();
        echo json_encode($db->documents($this->test_input($_POST["code"])));

    }

    public function assign()
    {
        $pro = $this->test_input($_POST['child']);
        $ten = $this->test_input($_POST['parent']);
        $num = $this->test_input($_POST['number']);
        if (!$num) return;
        $db = new Lst();
        $res = $db->assign($ten, $pro, $num);
        echo json_encode($res);
    }

    public function delete($id)
    {
        $db = new Lst();
        $id = $this->test_input(rawurldecode($id));
        $res = $db->delete($id);
        echo json_encode($res);
    }

    public function upload()
    {
        $tender = $this->test_input($_POST['t']);
        $db = new Lst();
        if ($this->validateExt($_FILES["file"]["name"])) {
            $upload = $this->uploadFile($_FILES['file'], 'tenders');
            $currentAx = $db->currentPic($tender);
            if ($currentAx && $currentAx['ax'] != null) {
                $pathToFile = __DIR__ . '\..\..\assets\images\tenders\\' . $currentAx['ax'];
                unlink($pathToFile);
            }
            $ax = $db->uploadAx($upload[0], $tender);
            if ($ax == 1) echo json_encode($upload[0]);
        }
    }

    public function gotostep2()
    {
        $tendercod = $this->test_input($_POST['tenderCode']);
        $tndlist = new Lst();
        $tndlist->gostp2($tendercod);
        return "ok";
    }

    public function winTender()
    {
        $tendercod = $this->test_input($_POST['tenderCode']);
        $tndlist = new Lst();
        $tndlist->win($tendercod);
        return "ok";
    }

    public function loseTender()
    {
        $tendercod = $this->test_input($_POST['tenderCode']);
        $tndlist = new Lst();
        $tndlist->lose($tendercod);
        return "ok";
    }

    public function filter($sd, $ed, $type)
    {
        $sd = rawurldecode($sd);
        $ed = rawurldecode($ed);
        $sd = $sd == null ? '00000000' : $sd;
        $ed = $ed == null ? '99999999' : $ed;
        //print_r($sd);
        //print_r($ed);

        $sDate = $this->dateFormatter2($this->test_input($sd));
        $eDate = $this->dateFormatter2($this->test_input($ed));
        $type = $this->test_input(rawurldecode($type));
        $db = new Lst();
        echo json_encode($db->filter($sDate, $eDate, $type));
    }
}