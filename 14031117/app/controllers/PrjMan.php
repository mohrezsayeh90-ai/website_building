<?php

namespace App\Controllers;

use App\Models\DetailModel as DPL;
use App\Models\PrjManModel as PrjManM;
use Karriere\PdfMerge\Exceptions\FileNotFoundException;
use Karriere\PdfMerge\Exceptions\NoFilesDefinedException;
use Karriere\PdfMerge\PdfMerge;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spatie\Async\Pool;
use Spatie\Browsershot\Browsershot;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;

class PrjMan extends Controller
{
    private $prjManM;

    public function __construct()
    {
        //if (isset($_SESSION['access']) && $_SESSION['access'][1]['access'] == 1 || isset($_SESSION['admin'])) {
        $this->prjManM = new PrjManM();
        //}else $this->view('auth/404');
    }

    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][8]['access'] == 1 || isset($_SESSION['admin'])) {
            $incompleteProj = $this->prjManM->getIncompleteProj();
            $completeProj = $this->prjManM->getcompleteProj();
            $this->view('project/prjman', compact('incompleteProj', 'completeProj'));
        } else $this->view('auth/404');
    }

    public function getCurrentProj()
    {
        $allProjs = $this->prjManM->getIncompleteProj();
        for ($i = 0; $i < count($allProjs); $i++) {
            $allProjs[$i]['startDate'] = farsidatediff($allProjs[$i]['proj_start_date'])->days * 24;
            $allProjs[$i]['endDate'] = $allProjs[$i]['proj_duration'] * 24 + farsidatediff($allProjs[$i]['proj_start_date'])->days * 24;
            $allProjs[$i]['realPos'] = $allProjs[$i]['proj_duration'] * 24 * ($allProjs[$i]['proj_physical_progress'] / 100.0)
                + farsidatediff($allProjs[$i]['proj_start_date'])->days * 24;
        }
        echo json_encode($allProjs);

    }

    public function show($p)
    {
        $prjCode = $this->test_input(rawurldecode($p));
        $ProjData = $this->prjManM->getProjData($prjCode)[0];
        $OtherProjData = $this->prjManM->getOtherProjData($prjCode);
        $this->view('project/showprj', compact('ProjData', 'OtherProjData'));
    }

    public function getAllowedTenders()
    {
        echo json_encode($this->prjManM->getTenders());
    }

    public function extractTenderData()
    {
        $prjCode = $this->test_input($_POST['projcode']);
        $tenderCode = $this->test_input($_POST['tenderCode']);
        $this->prjManM->extractTenders($prjCode, $tenderCode);
        echo json_encode("ok");
    }

    public function epl($p)
    {
        $prjCode = $this->test_input(rawurldecode($p));
        $materials = $this->prjManM->selectEPL($prjCode);
        $this->view('project/pdetails', compact('materials'));
    }

    public function dpl($p)
    {
        $prjCode = $this->test_input(rawurldecode($p));
        $materials = $this->prjManM->selectDPL($prjCode);
        $this->view('project/ddetails', compact('materials'));
    }

    public function setProjectProgress()
    {
        //badge required
        $prjCode = $this->test_input($_POST['p']);
        $progress = $this->test_input($_POST['progress']);
        $this->prjManM->setProjectProgress($prjCode, $progress);
    }

    public function saveAllSheets()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        $allD = $_POST['allData'];
        $this->prjManM->saveAllSheets($prjCode, $allD);
    }

    public function saveAllSheetsDPL()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        $allD = $_POST['allData'];
        $this->prjManM->saveAllSheetsDPL($prjCode, $allD);
    }

    public function productList()
    {
        $prjCode = $this->test_input($_POST['prjCod']);
        echo json_encode($this->prjManM->getProduct($prjCode));
    }

    public function addingProduct()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        $prdCode = $this->test_input($_POST['prdCode']);
        $prdNumber = $this->test_input($_POST['prdNumber']);
        $this->prjManM->addProduct($prjCode, $prdCode, $prdNumber);
    }
//&margin=10&activesheet=3&title=salam

    /**
     * @throws NoFilesDefinedException
     * @throws FileNotFoundException
     * @throws CouldNotTakeBrowsershot
     */
    /**
     * @throws MpdfException
     * @throws \Exception
     */
    public function createProjectDPLPdf()
    {
        $tabcnt = $this->test_input($_POST['tabcnt']);
        $mdata = $_POST['mdata'];
        $thisurl = $_POST['thisurl'];
        $files = [];
        //does not work in windows
//        $pool = Pool::create()
//            ->concurrency(40);
        $step = 3;
        for ($j = 0; $j < $tabcnt; $j += $step) {
            for ($i = $j; $i < min($j + $step, $tabcnt); $i++) {
                $urll = $_POST['thisurl'] . '&margin=10&activesheet=' . $i . '&title=' . $mdata[$i];

                $random = random_int(100000, 200000);
                $filename = 'report' . $random . '.pdf';

                $files[] = 'd:/apache24/htdocs/mehrabad/assets/tmp/' . $filename;

//            $c = curl_init($_POST['thisurl']);
//            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//
//            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
////curl_setopt(... other options you want...)
//
//            $html = curl_exec($c);
//
//            if (curl_error($c))
//                die(curl_error($c));
//
//// Get the status code
//            $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
//
//            curl_close($c);
//        $mpdf = new Mpdf();
//        $mpdf->WriteHTML($html);
//        $mpdf->Output('d:/apache24/htdocs/mehrabad/assets/tmp/' . $filename);
//            Start-Process -FilePath "php" -ArgumentList  "-f `"d:\\apache24\\htdocs\\mehrabad\\app\\views\\project\\commandprompt00.php`" https://www.google.com 3.pdf"  -WindowStyle Hidden
//pclose(popen("start /B d:/php/php.exe \"-f `\"d:/apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" -- ".$urll." ".$filename."\"" , "r"));
                //\"-f `\"d:/apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\"  {$urll} {$filename}\" --Wait
                // print_r("start D:/php/php \"-f `\"D:/apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" {$urll} {$filename}\"" );

                //  print_r("start  D:/php/php.exe  \"-f `\"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" ".str_replace(' ','_',$urll)." ".$filename."\"");
                //  pclose(popen("start  D:/php/php.exe  \"-f `\"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" ".$urll." ".$filename."\"" , "r"));
                pclose(popen("start /min \"l{$i}\" d:/php/php.exe -f \"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php\" \"{$urll}\" \"{$filename}\"", "r"));

                // pclose(popen("powershell.exe \"Start-Process  -FilePath \"d:/php/php\" -ArgumentList  \"-f `\"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" `".$urll."` ".$filename."\"\"" , "r"));
                // print_r("start D:/php/php \" -f `\"D:/apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\"  `{$urll}` `\"{$filename}`\" \"");
                //    pclose(popen("Start-Process -FilePath \"php\" -ArgumentList \" -f `\"d:/apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\"  {$urll} {$filename}\" -WindowStyle Hidden" , "r"));
                //  exec("start  D:\\\\php\\\\php.exe \"-f `\"D:\\\\Apache24\\\\htdocs\\\\mehrabad\\\\app\\\\views\\\\project\\\\commandprompt00.php`\"\""  );
                //   Browsershot::url($urll)->setChromePath("C:\Program Files (x86)\Google\Chrome\Application\chrome.exe")->paperSize(350, 210, 'mm')->save('d:/apache24/htdocs/mehrabad/assets/tmp/' . $filename);

            }
            for ($i = $j; $i < min($j + $step, $tabcnt); $i++) {
                while (!file_exists($files[$i])) {
                    usleep(500000);
                };
            }
        }
//      sleep(30);


        $pdfMerge = new PdfMerge();

        for ($i = 0; $i < count($files); $i++) {

            $pdfMerge->add($files[$i]);
        }
        $random = random_int(100000, 200000);
        $filename = 'report' . $random . '.pdf';

        $pdfMerge->merge('d:/apache24/htdocs/mehrabad/assets/tmp/' . $filename);
        echo json_encode('assets/tmp/' . $filename);
    }

    public function test()
    {
//    pclose(popen("powershell.exe \"Start-Process  -FilePath \"d:/php/php\" -ArgumentList  \"-f `\"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" `".$urll."` ".$filename."\"\"" , "r"));
        print_r("powershell.exe \"Start-Process d:/php/php.exe -ArgumentList \"-f\" `\"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\" \"https://www.google.com\" \"2.pdf\"\"");
        popen("start d:/php/php.exe  -f \"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php\" \"https://www.google.com\" \"2.pdf\"", "r");
        // -ArgumentList \"-f\",`\"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php`\",\"https://www.google.com\",\"2.pdf\"
    }

    public function prjsaveAll()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        $this->prjManM->deletePrevious($prjCode);
        //print_r($prjCode);
        $mdata = [];
        $mdata[] = $prjCode;
        $data = $_POST['data'];
        $process = 'tech';
//print_r($data);
        for ($i = 0; $i < count($data) - 1; $i++) {
            $endc = '';
            $ende = '';
            // print_r($data);
            if (str_starts_with($data[$i]['id'], 'tech_') && str_starts_with($data[$i + 1]['id'], 'tech_') && $process == 'tech') {
                $endc = explode('_', $data[$i]['id'])[2];
                $endn = explode('_', $data[$i + 1]['id'])[2];
                if ($endc == $endn) {
                    $mdata[] = $data[$i]['value'] ?? '';
                } else {
                    $mdata[] = $data[$i]['value'] ?? '';
                    $mdata[] = IP;
                    if ($mdata[1] != '') {
                        //  print_r($mdata);
                        $this->prjManM->insertTechItems($mdata);
                    }
                    $mdata = [];
                    $mdata[] = $prjCode;
                }
            } else if (str_starts_with($data[$i]['id'], 'tech_') && $process == 'tech') {
                $mdata[] = $data[$i]['value'] ?? '';
                $mdata[] = IP;
                if ($mdata[1] != '') {
                    //  print_r($mdata);
                    $this->prjManM->insertTechItems($mdata);
                }
                $mdata = [];
                $mdata[] = $prjCode;
                $process = 'fin';
            } else if (str_starts_with($data[$i]['id'], 'fin_') && str_starts_with($data[$i + 1]['id'], 'fin_') && $process == 'fin') {
                $endc = explode('_', $data[$i]['id'])[2];
                $endn = explode('_', $data[$i + 1]['id'])[2];
                if ($endc == $endn) {
                    $mdata[] = $data[$i]['value'] ?? '';
                } else {
                    $mdata[] = $data[$i]['value'] ?? '';
                    $mdata[] = IP;
                    if ($mdata[1] != '') {
                        //    print_r($mdata);
                        $this->prjManM->insertFinItems($mdata);
                    }
                    $mdata = [];
                    $mdata[] = $prjCode;
                }
            } else if (str_starts_with($data[$i]['id'], 'fin_') && $process == 'fin') {
                //$mdata[]=$data[$i]['value']??'';
                $mdata[] = IP;
                if ($mdata[1] != '') {
                    //  print_r($mdata);
                    $this->prjManM->insertFinItems($mdata);
                }
                $process = 'fino';
                $mdata = [];
                $mdata[] = $prjCode;
            } else if (str_starts_with($data[$i]['id'], 'risk_') && str_starts_with($data[$i + 1]['id'], 'risk_')) {
                $endc = explode('_', $data[$i]['id'])[2];
                $endn = explode('_', $data[$i + 1]['id'])[2];
                if ($endc == $endn) {
                    $mdata[] = $data[$i]['value'] ?? '';
                } else {
                    $mdata[] = $data[$i]['value'] ?? '';
                    $mdata[] = IP;
                    if ($mdata[1] != '') {
                        //    print_r($mdata);
                        $this->prjManM->insertRiskItems($mdata);
                    }
                    $mdata = [];
                    $mdata[] = $prjCode;
                }
            } else if (str_starts_with($data[$i]['id'], 'risk_')) {
                $mdata[] = $data[$i]['value'] ?? '';
                $mdata[] = IP;
                if ($mdata[1] != '') {
                    //  print_r($mdata);
                    $this->prjManM->insertRiskItems($mdata);
                }
                $process = 'fino';
                $mdata = [];
                $mdata[] = $prjCode;
            } else if ($process == 'fino' && !str_starts_with($data[$i]['id'], 'checkbox')) {
                $thisdata = $data[$i]['value'] ?? '';
                // updateProjTables($prjC,$tn,$fieldn,$value)
                $tn = '';
                $field = '';
                switch ($data[$i]['id']) {
                    case 'finrefrences':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_financial_calculation_refrence';
                        break;
                    case 'fintaseere':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_payment_exchange_rate';
                        break;
                    case 'fintadil':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_payment_adjustment';
                        break;
                    case 'finzemanat':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_payment_insurance_document';
                        break;
                    case 'fintaahod':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_do_duty_payment';
                        break;
                    case 'finpish':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_advance_payment';
                        break;
                    case 'finmian':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_along_payment';
                        break;
                    case 'finhosn':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_fulfillment_price';
                        break;
                    case 'finpishdate1':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_advance_payment_date';
                        break;
                    case 'finpishreal1':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_advance_payment_real';
                        break;
                    case 'finpishdate2':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_along_payment_date';
                        break;
                    case 'finmianreal2':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_along_payment_real';
                        break;
                    case 'finpishdate3':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_complete_payment_date';
                        break;
                    case 'finclearreal3':
                        $tn = 'tbl_mehrabad_projects_financial_info';
                        $field = 'proj_complete_payment_real';
                        break;
                    case 'otherinfo_1':
                        $tn = 'tbl_mehrabad_projects_additioanl_info';
                        $field = 'list_of_equipment_in_customer_commitment';
                        break;
                    case 'otherinfo_2':
                        $tn = 'tbl_mehrabad_projects_additioanl_info';
                        $field = 'proj_packing_type';
                        break;
                    case 'otherinfo_3':
                        $tn = 'tbl_mehrabad_projects_additioanl_info';
                        $field = 'proj_other_important_notes';
                        break;
                    case 'otherinfo_5':
                        $tn = 'tbl_mehrabad_projects_additioanl_info';
                        $field = 'proj_signers';
                        break;
                }
                if ($thisdata != '' && $tn != '') $this->prjManM->updateProjTables($prjCode, $tn, $field, $thisdata);
            } else if (str_starts_with($data[$i]['id'], 'checkbox')) {
                //print_r($data[$i]['id']);print_r($data[$i]['value']);
                if ($data[$i]['id'] == 'checkbox-item-1' && $data[$i]['value'] == 100) {
                    $this->prjManM->updateProjTables($prjCode, 'tbl_mehrabad_projects_financial_info', 'proj_payment_currency_type', 1);
                } else if ($data[$i]['id'] == 'checkbox-item-2' && $data[$i]['value'] == 100) {
                    $this->prjManM->updateProjTables($prjCode, 'tbl_mehrabad_projects_financial_info', 'proj_payment_currency_type', 2);
                }
            }

        }

        echo "ok";
    }

    public function uploadPrjAppendix()
    {
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $fileContent = file_get_contents($_FILES['file']['tmp_name']);
        $projCode = $this->test_input($_POST['prjcode']);
        //$currentPath=$this->prjManM->getCurrentPath();
        $bytes = random_bytes(32);
        $fileN = bin2hex($bytes);
        $extt = explode('.', $fileName);

        $fp = fopen('d:\\apache24\\htdocs\\mehrabad\\assets\\images\\projects\\' . $fileN . '.' . $extt[count($extt) - 1], "w");
        fwrite($fp, $fileContent);
        $this->prjManM->insertUplodedFiles($projCode, $fileName, $fileN . '.' . $extt[count($extt) - 1]);
    }

    public function getProjectAttachment()
    {
        $projCode = $this->test_input($_POST['prjCod']);
        echo json_encode($this->prjManM->getProjectAttachment($projCode));
    }

    public function delDocs()
    {
        $id = $this->test_input($_POST['id']);
        $this->prjManM->delDocs($id);
    }

    /**
     * @throws CouldNotTakeBrowsershot
     */
    public function pdfCreate()
    {
        $urll = $_POST['thisurl'];

        $random = random_int(100000, 200000);
        $filename = 'report' . $random . '.pdf';
        //print_r($urll);
//        $this->pool->add(function ()  use ($urll,$filename) {
//
//
//        })->then(function ($output) use ($filename) {
//
//        })->catch(function (Throwable $exception) {
//            // Handle exception
//        });
//        $this->pool->wait();
        Browsershot::url($urll)->setChromePath("C:\Program Files (x86)\Google\Chrome\Application\chrome.exe")->paperSize(350, 210, 'mm')->save('d:/apache24/htdocs/mehrabad/assets/tmp/' . $filename);
        echo json_encode('assets/tmp/' . $filename);
    }

    public function createProjectEPLExcel()
    {
        $dpl = new DPL();
        $tenderCode = $this->test_input($_POST['prjCode']);
        $ProjData = $this->prjManM->getProjData($tenderCode)[0];
        $version = str_replace('V', '', $this->prjManM->selectEPL($tenderCode)[9]['proj_main_forms_version']);
        $allD = $_POST['allData'];
        $sheets = [];
        for ($i = 0; $i < count($allD); $i++) {
            if (!in_array($allD[$i][0], $sheets)) {
                $sheets[] = $allD[$i][0];
            }
        }
        $worksheet1 = [];
        $spreadsheet = new Spreadsheet();
        for ($i = 0; $i < count($sheets); $i++) {
            $worksheet1[] = $spreadsheet->createSheet();
            $worksheet1[$i]->setTitle($dpl->getPRODname($sheets[$i])['name']);
        }
        $materials = $spreadsheet->createSheet();
        $materials->setTitle("Materials");
        //#$index = $spreadsheet->getIndex($spreadsheet);
        //$spreadsheet->removeSheetByIndex($index);
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        $drawing1 = [];
        $drawing2 = [];
        $drawing3 = [];
        $sumrow = [];
        for ($i = 0; $i < count($sheets); $i++) {
            $prodInfo = $dpl->getPRODname($sheets[$i]);
            $worksheet1[$i]->getRowDimension((string)(1))->setRowHeight(80);
            $drawing1[$i] = new Drawing();
            $drawing1[$i]->setPath('D:\\Apache24\\htdocs\\mehrabad\\assets\\images\\customers\\' . $ProjData['logo']);
            $worksheet1[$i]->mergeCells('A1:B1');
            $drawing1[$i]->setCoordinates('A1');
            $drawing1[$i]->setOffsetX(20);
            $drawing1[$i]->setWidth(100);
            $drawing1[$i]->setWorksheet($worksheet1[$i]);
            $drawing2[$i] = new Drawing();
            $drawing2[$i]->setPath('D:\\Apache24\\htdocs\\mehrabad\\assets\\images\\picture3.png');
            $drawing2[$i]->setCoordinates('C1');
            $drawing2[$i]->setOffsetX(60);
            $drawing2[$i]->setOffsetY(5);
            $drawing2[$i]->setWidth(200);
            $drawing2[$i]->setWorksheet($worksheet1[$i]);
            $drawing3[$i] = new Drawing();
            $drawing3[$i]->setPath('D:\\Apache24\\htdocs\\mehrabad\\assets\\images\\customers\\' . $ProjData['conSultLogo']);
            $drawing3[$i]->setCoordinates('E1');
            $drawing3[$i]->setOffsetX(60);
            $drawing3[$i]->setOffsetY(5);
            $drawing3[$i]->setWidth(100);
            $drawing3[$i]->setWorksheet($worksheet1[$i]);
            $worksheet1[$i]->mergeCells('A2:B2');
            $worksheet1[$i]->setCellValue('A2', ' CLIENT: ' . $ProjData['ename']);
            $worksheet1[$i]->getStyle('A2')->getFont()->setSize(8);
            $worksheet1[$i]->mergeCells('C2:D2');
            $worksheet1[$i]->setCellValue('C2', 'MANUFACTURER: MEHRABAD INDUSTRIAL CO.');
            $worksheet1[$i]->getStyle('C2')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('C2')->getAlignment()
                ->setVertical('center');
            $worksheet1[$i]->getStyle('C2')->getFont()->setSize(8);
            $worksheet1[$i]->mergeCells('E2:F2');
            $worksheet1[$i]->setCellValue('E2', ' CONSULTANT: ' . $ProjData['conSultEname']);
            $worksheet1[$i]->getStyle('E2')->getAlignment()
                ->setHorizontal('left');
            $worksheet1[$i]->getStyle('E2')->getAlignment()
                ->setVertical('center');
            $worksheet1[$i]->getStyle('E2')->getFont()->setSize(8);

            //-----------------
            $worksheet1[$i]->mergeCells('A3:B3');
            $worksheet1[$i]->mergeCells('E3:F3');
            $worksheet1[$i]->getStyle('A3:F3')->getFont()->setSize(8);
            $worksheet1[$i]->setCellValue('A3', ' DOCUMENT NO.: ' . $tenderCode);
            $worksheet1[$i]->setCellValue('C3', ' DOCUMENT TITLE:');
            $worksheet1[$i]->setCellValue('D3', $prodInfo['voltage'] . ' ' . $prodInfo['name'] . ' ' . $prodInfo['crnt']);
            $worksheet1[$i]->setCellValue('E3', ' REVISION: ' . $version);
            $worksheet1[$i]->getStyle('A3:F3')->getAlignment()
                ->setVertical('center');
            $worksheet1[$i]->getStyle('D3')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('D3')->getFont()->setSize(11);
            //-----------------


            //-----------------
            $worksheet1[$i]->mergeCells('A4:D4');
            $worksheet1[$i]->mergeCells('E4:F4');
            $worksheet1[$i]->getStyle('A4:F4')->getAlignment()
                ->setVertical('center');
            $worksheet1[$i]->setCellValue('A4', ' PROJECT NAME: ' . $ProjData['proj_name']);
            $worksheet1[$i]->getStyle('A4:F4')->getFont()->setSize(8);
            $worksheet1[$i]->setCellValue('E4', ' DATE:' . $ProjData['proj_start_date']);
            //-----------------


            $worksheet1[$i]->mergeCells('C1:D1');
            $worksheet1[$i]->mergeCells('E1:F1');
            $worksheet1[$i]->setCellValue('A5', 'ITEM');
            $worksheet1[$i]->setCellValue('B5', 'DESCRIPTION');
            $worksheet1[$i]->setCellValue('D5', 'TECHNICAL SPECIFICATION');
            $worksheet1[$i]->setCellValue('E5', 'MANUFACTURER');
            $worksheet1[$i]->setCellValue('F5', 'MANUFACTURER');
            $worksheet1[$i]->setCellValue('G5', 'PRICE I');
            $worksheet1[$i]->setCellValue('F5', 'QTY');
            $worksheet1[$i]->setCellValue('H5', 'PRICE RIAL');
            $worksheet1[$i]->setCellValue('I5', 'TOTAL PRICE');
            $worksheet1[$i]->setCellValue('J5', 'TOTAL PRICE');
            $worksheet1[$i]->setCellValue('G6', 'UNIT');
            $worksheet1[$i]->setCellValue('I6', '€');
            $worksheet1[$i]->setCellValue('J6', 'RIAL');
            $worksheet1[$i]->mergeCells('A5:A6');
            $worksheet1[$i]->mergeCells('B5:C6');
            $worksheet1[$i]->mergeCells('D5:D6');
            $worksheet1[$i]->mergeCells('E5:E6');
            $worksheet1[$i]->mergeCells('F5:F6');
            $worksheet1[$i]->mergeCells('G6:H6');
            $worksheet1[$i]->getStyle('A5:A6')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('B5:C6')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('D5:D6')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('E5:E6')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('G6:H6')->applyFromArray($styleArray);


            //$worksheet1[$i]->getStyle('A5:A6')->getAlignment()->setAlignment(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $worksheet1[$i]->getStyle('A5:A6')->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $worksheet1[$i]->getStyle('A5:A6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('B5:C6')->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $worksheet1[$i]->getStyle('B5:C6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('D5:D6')->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $worksheet1[$i]->getStyle('D5:D6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('E5:E6')->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $worksheet1[$i]->getStyle('E5:E6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('F5:F6')->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $worksheet1[$i]->getStyle('F5:F6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('G6:H6')->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $worksheet1[$i]->getStyle('G6:H6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('G5')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('G5')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('H5')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('H5')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('I5')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('J5')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('J5')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('I6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('I6')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('J6')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('J6')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('I5')->applyFromArray($styleArray);
            $worksheet1[$i]->getStyle('F5:F6')->applyFromArray($styleArray);
            $worksheet1[$i]->getColumnDimension('A')->setWidth(40, 'pt');
            $worksheet1[$i]->getColumnDimension('B')->setWidth(80, 'pt');
            $worksheet1[$i]->getColumnDimension('C')->setWidth(80, 'pt');
            $worksheet1[$i]->getColumnDimension('D')->setWidth(160, 'pt');
            $worksheet1[$i]->getColumnDimension('E')->setWidth(70, 'pt');
            $worksheet1[$i]->getColumnDimension('F')->setWidth(60, 'pt');
            $worksheet1[$i]->getColumnDimension('G')->setWidth(80, 'pt');
            $worksheet1[$i]->getColumnDimension('H')->setWidth(100, 'pt');
            $worksheet1[$i]->getColumnDimension('I')->setWidth(100, 'pt');
            $worksheet1[$i]->getColumnDimension('J')->setWidth(100, 'pt');
            //----------------
            //$worksheet1[$i]->getRowDimension('6')->setRowHeight(20);
            //$worksheet1[$i]->getRowDimension((string)(7))->setRowHeight(20);
            //----------------

        }
        $itemcnt = 1;
        $sheetcnt = 0;
        for ($i = 0; $i < count($allD) - 1; $i++) {
            if ($allD[$i][0] == $allD[$i + 1][0]) {
                $worksheet1[$sheetcnt]->setCellValue('A' . (6 + $itemcnt), $itemcnt);
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->applyFromArray($styleArray);
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('00FFFF');
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


                $worksheet1[$sheetcnt]->mergeCells('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt));

                $worksheet1[$sheetcnt]->setCellValue('B' . (6 + $itemcnt), '  ' . $allD[$i][1]);
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('left');
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->applyFromArray($styleArray);
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('00FFFF');
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getAlignment()->setVertical('center');

                $worksheet1[$sheetcnt]->setCellValue('D' . (6 + $itemcnt), $allD[$i][2]);
                $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))
                    ->getAlignment()->setWrapText(true);

                $worksheet1[$sheetcnt]->setCellValue('E' . (6 + $itemcnt), $allD[$i][3]);
                $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('F' . (6 + $itemcnt), $allD[$i][4]);
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('G' . (6 + $itemcnt), $allD[$i][5]);
                $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('H' . (6 + $itemcnt), ($allD[$i][6]));
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getNumberFormat()
                    ->setFormatCode('#,###');

                $worksheet1[$sheetcnt]->setCellValue('I' . (6 + $itemcnt), '=F' . (6 + $itemcnt) . '*G' . (6 + $itemcnt));
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getNumberFormat()
                    ->setFormatCode('#,###');

                $worksheet1[$sheetcnt]->setCellValue('J' . (6 + $itemcnt), '=F' . (6 + $itemcnt) . '*H' . (6 + $itemcnt));
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getNumberFormat()
                    ->setFormatCode('#,###');

                $itemcnt++;
            } else {

                $worksheet1[$sheetcnt]->setCellValue('A' . (6 + $itemcnt), $itemcnt);
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->applyFromArray($styleArray);
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('00FFFF');
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('B' . (6 + $itemcnt), '  ' . $allD[$i][1]);
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('left');
                $worksheet1[$sheetcnt]->mergeCells('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt));
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->applyFromArray($styleArray);
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('00FFFF');
                $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('D' . (6 + $itemcnt), $allD[$i][2]);
                $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))
                    ->getAlignment()->setWrapText(true);

                $worksheet1[$sheetcnt]->setCellValue('E' . (6 + $itemcnt), $allD[$i][3]);
                $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('F' . (6 + $itemcnt), $allD[$i][4]);
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()
                    ->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->applyFromArray($styleArray);

                $worksheet1[$sheetcnt]->setCellValue('F' . (6 + $itemcnt), $allD[$i][4]);
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->applyFromArray($styleArray);
                $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet1[$sheetcnt]->setCellValue('G' . (6 + $itemcnt), $allD[$i][5]);
                $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


                $worksheet1[$sheetcnt]->setCellValue('H' . (6 + $itemcnt), ($allD[$i][6]));
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getNumberFormat()
                    ->setFormatCode('#,###');

                $worksheet1[$sheetcnt]->setCellValue('I' . (6 + $itemcnt), '=F' . (6 + $itemcnt) . '*G' . (6 + $itemcnt));
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getNumberFormat()
                    ->setFormatCode('#,###');

                $worksheet1[$sheetcnt]->setCellValue('J' . (6 + $itemcnt), '=F' . (6 + $itemcnt) . '*H' . (6 + $itemcnt));
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getNumberFormat()
                    ->setFormatCode('#,###');

//                $worksheet1[$sheetcnt]->getStyle('G1:K100')->getFill()
//                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//                    ->getStartColor()->setARGB('888888');
//                $worksheet1[$sheetcnt]->getStyle('A'.(6+$itemcnt+1).':K100')->getFill()
//                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//                    ->getStartColor()->setARGB('888888');
                $sumrow[$sheetcnt] = (6 + $itemcnt + 1);
                $worksheet1[$sheetcnt]->setCellValue('A' . (6 + $itemcnt + 1), 'SUM');
                $worksheet1[$sheetcnt]->mergeCells('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1));
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1))->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('888888');

                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1))->applyFromArray($styleArray);

                $worksheet1[$sheetcnt]->setCellValue('I' . (6 + $itemcnt + 1), '=sum(I7:I' . (6 + $itemcnt) . ')');
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->getNumberFormat()
                    ->setFormatCode('#,###');

                $worksheet1[$sheetcnt]->setCellValue('J' . (6 + $itemcnt + 1), '=sum(J7:J' . (6 + $itemcnt) . ')');
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->getAlignment()->setHorizontal('center');
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->applyFromArray($styleArray);
                //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->getAlignment()
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->getNumberFormat()
                    ->setFormatCode('#,###');
                $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':J' . (6 + $itemcnt + 1))->getFont()->setSize(12);

                $worksheet1[$sheetcnt]->getPageSetup()->setPrintArea('A1:F' . (6 + $itemcnt + 1));


                $itemcnt = 1;
                $sheetcnt++;
            }
        }

        $worksheet1[$sheetcnt]->setCellValue('A' . (6 + $itemcnt), $itemcnt);
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getAlignment()
            ->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->applyFromArray($styleArray);
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('00FFFF');
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $worksheet1[$sheetcnt]->setCellValue('B' . (6 + $itemcnt), '  ' . $allD[count($allD) - 1][1]);
        $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt))->getAlignment()
            ->setHorizontal('left');
        $worksheet1[$sheetcnt]->mergeCells('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt));
        $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->applyFromArray($styleArray);
        $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('00FFFF');
        $worksheet1[$sheetcnt]->getStyle('B' . (6 + $itemcnt) . ':C' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


        $worksheet1[$sheetcnt]->setCellValue('D' . (6 + $itemcnt), $allD[count($allD) - 1][2]);
        $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))->getAlignment()
            ->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('D' . (6 + $itemcnt))
            ->getAlignment()->setWrapText(true);

        $worksheet1[$sheetcnt]->setCellValue('E' . (6 + $itemcnt), $allD[count($allD) - 1][3]);
        $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->getAlignment()
            ->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->applyFromArray($styleArray);
        $worksheet1[$sheetcnt]->getStyle('E' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);


        $worksheet1[$sheetcnt]->setCellValue('F' . (6 + $itemcnt), $allD[count($allD) - 1][4]);
        $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()
            ->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->applyFromArray($styleArray);
        $worksheet1[$sheetcnt]->getStyle('F' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $worksheet1[$sheetcnt]->setCellValue('G' . (6 + $itemcnt), $allD[count($allD) - 1][5]);
        $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('G' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $worksheet1[$sheetcnt]->setCellValue('H' . (6 + $itemcnt), ($allD[$i][6]));
        $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet1[$sheetcnt]->getStyle('H' . (6 + $itemcnt))->getNumberFormat()
            ->setFormatCode('#,###');

        $worksheet1[$sheetcnt]->setCellValue('I' . (6 + $itemcnt), '=F' . (6 + $itemcnt) . '*G' . (6 + $itemcnt));
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt))->getNumberFormat()
            ->setFormatCode('#,###');

        $worksheet1[$sheetcnt]->setCellValue('J' . (6 + $itemcnt), '=F' . (6 + $itemcnt) . '*H' . (6 + $itemcnt));
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt))->getNumberFormat()
            ->setFormatCode('#,###');
        $sumrow[$sheetcnt] = (6 + $itemcnt + 1);
        $worksheet1[$sheetcnt]->setCellValue('A' . (6 + $itemcnt + 1), 'SUM');
        $worksheet1[$sheetcnt]->mergeCells('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1));
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1))->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('888888');
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':H' . (6 + $itemcnt + 1))->applyFromArray($styleArray);

        $worksheet1[$sheetcnt]->setCellValue('I' . (6 + $itemcnt + 1), '=sum(I7:I' . (6 + $itemcnt) . ')');
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet1[$sheetcnt]->getStyle('I' . (6 + $itemcnt + 1))->getNumberFormat()
            ->setFormatCode('#,###');

        $worksheet1[$sheetcnt]->setCellValue('J' . (6 + $itemcnt + 1), '=sum(J7:J' . (6 + $itemcnt) . ')');
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->getAlignment()->setHorizontal('center');
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->applyFromArray($styleArray);
        //$worksheet1[$sheetcnt]->getColumnDimension('D')->setAutoSize(true);
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $worksheet1[$sheetcnt]->getStyle('J' . (6 + $itemcnt + 1))->getNumberFormat()
            ->setFormatCode('#,###');
        $worksheet1[$sheetcnt]->getStyle('A' . (6 + $itemcnt + 1) . ':J' . (6 + $itemcnt + 1))->getFont()->setSize(12);

//        $worksheet1[$sheetcnt]->getStyle('G1:K100')->getFill()
//            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//            ->getStartColor()->setARGB('888888');
//        $worksheet1[$sheetcnt]->getStyle('A'.(6+$itemcnt+1).':K100')->getFill()
//            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
//            ->getStartColor()->setARGB('888888');

        $worksheet1[$sheetcnt]->getPageSetup()->setPrintArea('A1:F' . (6 + $itemcnt + 1));


        /////////////////////////////Materials
        ///
        ///
        ///
        ///


        $allProd = $this->prjManM->getAllProd($tenderCode);
        for ($i = 0; $i < count($allProd); $i++) {
            $materials->getRowDimension((string)(10 + $i))->setRowHeight(30);
            $prod = $dpl->getPRODname($allProd[$i]['proj_item_mah_cod']);
            $materials->setCellValue('B' . (10 + $i), $i + 1);
            $materials->getStyle('B' . (10 + $i))->getAlignment()->setHorizontal('center');
            $materials->getStyle('B' . (10 + $i))->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $materials->getStyle('B' . (10 + $i))->applyFromArray($styleArray);

            $materials->setCellValue('C' . (10 + $i), '  ' . $prod['voltage'] . ' ' . $prod['name'] . ' - ' . $prod['crnt']);
            $materials->getStyle('C' . (10 + $i))->getAlignment()->setHorizontal('left');
            $materials->getStyle('C' . (10 + $i))->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $materials->getStyle('C' . (10 + $i))->applyFromArray($styleArray);
            $materials->getStyle('C' . (6 + $itemcnt))->getAlignment()
                ->setHorizontal('left');

            $materials->setCellValue('D' . (10 + $i), $allProd[$i]['proj_item_number']);
            $materials->getStyle('D' . (10 + $i))->getAlignment()->setHorizontal('center');
            $materials->getStyle('D' . (10 + $i))->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $materials->getStyle('D' . (10 + $i))->applyFromArray($styleArray);
            $materials->getStyle('D' . (6 + $itemcnt))->getAlignment()
                ->setHorizontal('center');

        }

        $materials->getColumnDimension('A')->setVisible(false);
        $materials->getRowDimension('1')->setVisible(false);
        $materials->setCellValue('B2', 'MATERIAL LIST');
        $materials->mergeCells('B2:D2');
        $materials->getStyle('B2:D2')->applyFromArray($styleArray);

        $materials->getStyle('B2:D2')->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $materials->getStyle('B2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $materials->getRowDimension('2')->setRowHeight(40);

        $materials->getStyle('B2:D2')->getFont()->setSize(18);

        $materials->getStyle('B3:D3')->applyFromArray($styleArray);
        $materials->mergeCells('B3:D3');
        $materials->getStyle('B3:D3')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B3:D3')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('3')->setRowHeight(20);
        $materials->setCellValue('B3', ' CLIENT: ' . $ProjData['ename']);
        $materials->getStyle('B3')->getFont()->setSize(8);

        $materials->getStyle('B4:D4')->applyFromArray($styleArray);
        $materials->mergeCells('B4:D4');
        $materials->getStyle('B4:D4')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B4:D4')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('4')->setRowHeight(20);
        $materials->setCellValue('B4', ' CONSULTANT: ' . $ProjData['conSultEname']);
        $materials->getStyle('B4')->getFont()->setSize(8);


        $materials->getStyle('B5:D5')->applyFromArray($styleArray);
        $materials->mergeCells('B5:D5');
        $materials->getStyle('B5:D5')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B5:D5')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('5')->setRowHeight(20);
        $materials->setCellValue('B5', ' PROJECT NAME: ' . $ProjData['proj_name']);
        $materials->getStyle('B5')->getFont()->setSize(8);


        $materials->getStyle('B6:D6')->applyFromArray($styleArray);
        $materials->mergeCells('B6:D6');
        $materials->getStyle('B6:D6')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B6:D6')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('6')->setRowHeight(20);
        $materials->setCellValue('B6', ' DOCUMENT NO.: ' . $ProjData['proj_code']);
        $materials->getStyle('B6')->getFont()->setSize(8);

        $materials->getStyle('B7:D7')->applyFromArray($styleArray);
        $materials->mergeCells('B7:D7');
        $materials->getStyle('B7:D7')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B7:D7')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('7')->setRowHeight(20);
        $materials->setCellValue('B7', ' DATE: ' . $ProjData['proj_start_date'] . '                                                                                                               REVISION: ' . $version);
        $materials->getStyle('B7')->getFont()->setSize(8);

        $materials->getStyle('B8:B9')->applyFromArray($styleArray);
        $materials->mergeCells('B8:B9');
        $materials->setCellValue('B8', 'ITEM');
        $materials->getStyle('B8:B9')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B8:B9')->getAlignment()->setHorizontal('center');
        $materials->getStyle('B8:B9')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('34e8eb');
        $materials->getStyle('B8')->getFont()->setSize(14);
        //34cceb
        $materials->mergeCells('C8:C9');
        $materials->setCellValue('C8', 'Description');
        $materials->getStyle('C8:C9')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('C8:C9')->getAlignment()->setHorizontal('center');
        $materials->getStyle('C8:C9')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('34e8eb');
        $materials->getStyle('C8')->getFont()->setSize(14);

        $materials->mergeCells('D8:D9');
        $materials->setCellValue('D8', 'Qty');
        $materials->getStyle('D8:D9')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('D8:D9')->getAlignment()->setHorizontal('center');
        $materials->getStyle('D8:D9')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('34e8eb');
        $materials->getStyle('D8')->getFont()->setSize(14);

        $materials->getRowDimension('8')->setRowHeight(30);
        $materials->getRowDimension('9')->setRowHeight(30);
        $materials->getColumnDimension('C')->setWidth(430, 'pt');
        $materials->getRowDimension((10 + count($allProd) + 1))->setVisible(false);
        $materials->getRowDimension((10 + count($allProd) + 2))->setVisible(false);
        $materials->getRowDimension((10 + count($allProd) + 3))->setVisible(false);

        $styleArray1 = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ];
        //$materials->getStyle('B2:D'.(10+count($allProd)+1))->applyFromArray($styleArray1);

        $materials->setCellValue('B' . (10 + count($allProd)), 'SUM');
        $materials->getRowDimension((string)(10 + count($allProd)))->setRowHeight(30);
        $materials->mergeCells('B' . (10 + count($allProd)) . ':C' . (10 + count($allProd)));
        $materials->getStyle('B' . (10 + count($allProd)) . ':C' . (10 + count($allProd)))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $materials->getStyle('B' . (10 + count($allProd)) . ':C' . (10 + count($allProd)))->getAlignment()->setHorizontal('center');
        $materials->getStyle('B' . (10 + count($allProd)) . ':C' . (10 + count($allProd)))->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('34e8eb');
        $materials->getStyle('B' . (10 + count($allProd)) . ':D' . (10 + count($allProd)))->applyFromArray($styleArray);

        $materials->setCellValue('D' . (10 + count($allProd)), '=sum(D10:D' . (10 + count($allProd) - 1) . ')');
        $materials->getStyle('D' . (10 + count($allProd)))->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('34e8eb');
        $materials->getStyle('D' . (10 + count($allProd)))->getAlignment()->setHorizontal('center');
        $materials->getStyle('D' . (10 + count($allProd)))->getAlignment()
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $materials->getStyle('B' . (10 + count($allProd)) . ':D' . (10 + count($allProd)))->getFont()->setSize(14);

        ///
        ///
        /// /////////////////////////////
        $spreadsheet->removeSheetByIndex(0);
        $writer = new Xlsx($spreadsheet);
        $filename = 'assets\\tmp\\' . random_int(1000, 9999) . '.xlsx';
        $filenamepdf = 'assets\\tmp\\' . random_int(1000, 9999) . '.pdf';
        $className = \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf::class;
        IOFactory::registerWriter('Pdf', $className);
        $writerpdf = new \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf($spreadsheet);
        $writerpdf->setPaperSize(9);
        $writerpdf->setOrientation('portrait');
        $writerpdf->writeAllSheets();
        $writer->save($filename);

        for ($i = 0; $i < count($sheets); $i++) {
//            $worksheet1[$i]->getColumnDimension('G')->setVisible(false);
//            //$worksheet1[$i]->getColumnDimension('G')->setWidth(0, 'pt');
//            $worksheet1[$i]->getColumnDimension('H')->setVisible(false);
//            $worksheet1[$i]->getColumnDimension('I')->setVisible(false);
//            $worksheet1[$i]->getColumnDimension('J')->setVisible(false);
            $worksheet1[$i]->getRowDimension($sumrow[$i])->setVisible(false);
            $worksheet1[$i]->removeColumn('G', 4);
//            $worksheet1[$i]->getColumnDimension('G')->setWidth(2, 'pt');
//            $worksheet1[$i]->getColumnDimension('H')->setWidth(2, 'pt');
//            $worksheet1[$i]->getColumnDimension('I')->setWidth(2, 'pt');
//            $worksheet1[$i]->getColumnDimension('J')->setWidth(2, 'pt');
            // $sumrow[$i]
            //$worksheet1[$i]->getColumnDimension('K')->setWidth(2, 'mm');
            //$worksheet1[$i]->getStyle('F1:F10')->applyFromArray($styleArray1);
            // $worksheet1[$i]->insertNewColumnBefore('G', 1);
            // $worksheet1[$i]->getColumnDimension('G')->setWidth(0, 'pt');
            $worksheet1[$i]->getStyle('F1')
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THIN)
                ->setColor(new Color('000000'));

        }
        $writerpdf->save($filenamepdf);
        echo json_encode([$filename, $filenamepdf]);
    }

    public function getAllBpmData($prjCode)
    {
        $dat1 = $this->prjManM->getAllBpmData($prjCode);
        return $dat1;
    }

    public function modalShow($p)
    {

        $allbpmData = $this->prjManM->getAllBpmData($this->test_input(rawurldecode($p)));

        $this->view('project/test', compact('allbpmData'));
    }

    public function showProjectLOG()
    {
        $prjCode = $this->test_input($_POST['prjCod']);
        $dat1 = $this->prjManM->showProjectLOG($prjCode);
        //print_r($dat1);
        echo json_encode($dat1);
    }

    public function signPrj()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        //////Badge needed
        $this->prjManM->signPrj($prjCode);
        echo json_encode($_SESSION['tke']);
    }

    public function prjNotAccepted()
    {
        //print_r($_POST);
        $prjCode = $this->test_input($_POST['prjCode']);
        $mcause = $this->test_input($_POST['mcause']);
        ////////Badge needed
        $this->prjManM->prjNotAccepted($prjCode, $mcause);
    }

    public function prjAccepted()
    {
        //print_r($_POST);
        $prjCode = $this->test_input($_POST['prjCode']);

        ////////Badge needed
        $this->prjManM->prjAccepted($prjCode);
    }

    public function signEPL()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        //////Badge needed
        $this->prjManM->signEPL($prjCode);
        echo json_encode($_SESSION['tke']);
    }

    public function EPLNotAccepted()
    {
        //print_r($_POST);
        $prjCode = $this->test_input($_POST['prjCode']);
        $mcause = $this->test_input($_POST['mcause']);
        ////////Badge needed
        $this->prjManM->EPLNotAccepted($prjCode, $mcause);
    }

    public function EPLAccepted()
    {
        //print_r($_POST);
        $prjCode = $this->test_input($_POST['prjCode']);

        ////////Badge needed
        $this->prjManM->EPLAccepted($prjCode);
    }

    public function signDPL()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        //////Badge needed
        $this->prjManM->signDPL($prjCode);
        echo json_encode($_SESSION['tke']);
    }

    public function DPLNotAccepted()
    {
        //print_r($_POST);
        $prjCode = $this->test_input($_POST['prjCode']);
        $mcause = $this->test_input($_POST['mcause']);
        ////////Badge needed
        $this->prjManM->DPLNotAccepted($prjCode, $mcause);
    }

    public function DPLAccepted()
    {
        //print_r($_POST);
        $prjCode = $this->test_input($_POST['prjCode']);

        ////////Badge needed
        $this->prjManM->DPLAccepted($prjCode);
    }

    public function addcoltoend()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        $colname = $this->test_input($_POST['colname']);
        $mah_cod = $this->test_input($_POST['mah_cod']);

        echo json_encode($this->prjManM->addcoltoend($prjCode, $mah_cod, $colname));
    }

    public function dellastcol()
    {
        $prjCode = $this->test_input($_POST['prjCode']);
        $mah_cod = $this->test_input($_POST['mah_cod']);

        echo json_encode($this->prjManM->dellastcol($prjCode, $mah_cod));
    }

    public function closeprj()
    {
        $prjCode = $this->test_input($_POST['p']);
        $this->prjManM->closeprj($prjCode);
    }

    public function changeBOM()
    {
        $newval = $this->test_input($_POST['newval']);
        $field = $this->test_input($_POST['field']);
        $prj_cod = $this->test_input($_POST['prj_cod']);
        $this->prjManM->changeBOM($prj_cod,$field,$newval);
    }
}