<?php

namespace App\Controllers;

use App\Models\ProjectModel as Proj;
use Dompdf\Dompdf;

//use Its404\PhpPuppeteer\Browser;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Spatie\Browsershot\Browsershot;

class Project extends Controller
{
    private $Proj;

    public function __construct()
    {
        $this->Proj = new Proj();
    }

    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][7]['access'] == 1 || isset($_SESSION['admin'])) {
            $id = $this->Proj->id();
            $code = $id ? 'P' . substr('000000' . ($id + 1), -6) : 'P000001';
            // $this->view('project/project');
            $customerList = $this->Proj->getAllCustomer();
            $this->view('project/projects', compact('code', 'customerList'));
        } else $this->view('auth/404');

    }

    public function saveproj()
    {
//     print_r($_POST);
//        Array ( [cuscod] => MOT-0001 [consulcod] => MOT-0002 [projectName] => ;
//        [checkbox-item-11] => 1 [checkbox-item-12] => 1 [checkbox-item-13] => 1
//        [checkbox-item-14] => 1 [contract] => P000001 [manager] => ; [contact] =>
//        [startDate] => 1403/09/10 [location] => ; [duration] => 9 [insurance] => o
//    [customer] => شرکت تولیدی ایران [operator] => l [contactCus] =>
//        [consultant] => شرکت برق و مخابرات [contactCon] => [penalty] => )
        $data = [];
        $data[] = $this->test_input($_POST['cuscod']);//0
        $data[] = $this->test_input($_POST['consulcod']);//1
        $data[] = $this->test_input($_POST['projectName']);//2
        if (isset($_POST['checkbox-item-11']))//3
            $data[] = 1;
        else
            $data[] = 0;
        if (isset($_POST['checkbox-item-12']))//4
            $data[] = 1;
        else
            $data[] = 0;
        if (isset($_POST['checkbox-item-13']))//5
            $data[] = 1;
        else
            $data[] = 0;
        if (isset($_POST['checkbox-item-14']))//6
            $data[] = 1;
        else
            $data[] = 0;
        $data[] = $this->test_input($_POST['contract']);//7
        //        [checkbox-item-14] => 1 [contract] => P000001 [manager] => ; [contact] =>
//        [startDate] => 1403/09/10 [location] => ; [duration] => 9 [insurance] => o
//    [customer] => شرکت تولیدی ایران [operator] => l [contactCus] =>
//        [consultant] => شرکت برق و مخابرات [contactCon] => [penalty] => )
        $data[] = $this->test_input($_POST['manager']);//7
        $data[] = $_POST['contact'] ?? '';//8
        $data[] = $this->test_input($_POST['startDate']);//9
        $data[] = $this->test_input($_POST['location']);//10

        if ($_POST['vahed'] == 0)//11
            $data[] = $this->test_input($_POST['duration']);
        else if ($_POST['vahed'] == 1)
            $data[] = $this->test_input($_POST['duration']) * 30;
        else if ($_POST['vahed'] == 2)
            $data[] = $this->test_input($_POST['duration']) * 365;
        $data[] = $this->test_input($_POST['insurance']);//12
        $data[] = $this->test_input($_POST['operator']);//13
        $data[] = $_POST['contactCus'] ?? '';//14
        $data[] = $_POST['penalty'] ?? '';
        //$data[]=$_POST['contactCon'] ?? '';//15
        //print_r($data);
        $updateProj = $this->test_input($_POST['updateProj']);
        if (!$updateProj) $k = $this->Proj->insertProj($data);
        else $this->Proj->updateProj($data);

        $this->redirect('project');
    }

    public function getallprojects()
    {

        echo json_encode($this->Proj->allProj());
    }

    public function deletethisproject()
    {
        $proCod = $this->test_input($_POST['projCod']);
        $this->Proj->delaProj($proCod);
        $this->redirect('project');
    }

    public function getaprojectdata()
    {
        $proCod = $this->test_input($_POST['projCod']);
        echo json_encode($this->Proj->getaProjData($proCod));
        // $this->redirect('project');
    }

    /**
     * @throws MpdfException
     * @throws \Exception
     */
    public function pdfMaker()
    {

        //  $html = file_get_contents("https://stackoverflow.com/questions/ask");
        $c = curl_init(Base_Url.'/home');
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt(... other options you want...)

        $html = curl_exec($c);

        if (curl_error($c))
            die(curl_error($c));

// Get the status code
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        curl_close($c);


    }
}