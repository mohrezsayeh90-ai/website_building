<?php

namespace App\Controllers;

use App\Models\DetailModel as DPL;
use Karriere\PdfMerge\PdfMerge;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Detail extends Controller
{
    public function show($id)
    {
        $id = $this->test_input(rawurldecode($id));
        $mdl = new DPL();
        if (isset($_POST['saveAllSheets']) && $_POST['saveAllSheets']) {
            $tenderCode = $this->test_input($_POST['tenderCode']);
            $allD = $_POST['allData'];
            $mdl->saveAllSheets($tenderCode, $allD);
        } else {
            $materials = $mdl->selectMaterials($id);
            $this->view('details', compact('materials'));
        }

    }

    public function proposal($id)
    {
        $id = $this->test_input(rawurldecode($id));
        $mdl = new DPL();
        $materials = $mdl->selectMaterials($id);
        $eplsum[0]['mon_cod'] = $materials[8][0]['mon_cod'];
        $eplsum[0]['mah_cod'] = $materials[8][0]['mah_cod'];
        $eplsum[0]['col_r'] = 0;
        $eplsum[0]['col_i'] = 0;
        $eplsum[0]['col_vcb'] = 0;
        $eplsum[0]['col_for'] = 0;
        $cnt = 0;
        for ($i = 0; $i < count($materials[8]) - 1; $i++) {
            if ($eplsum[$cnt]['mah_cod'] == $materials[8][$i]['mah_cod']) {
                if ($materials[8][$i]['row_type'] != "VCB") {
                    $eplsum[$cnt]['col_r'] += $materials[8][$i]['price_r'] * $materials[8][$i]['qty'];
                    $eplsum[$cnt]['col_i'] += $materials[8][$i]['price_i'] * $materials[8][$i]['qty'];
                    $eplsum[$cnt]['col_for'] += $materials[8][$i]['real_foreign'] ?? 0;
                } else if ($materials[8][$i]['row_type'] === "VCB") {
                    $eplsum[$cnt]['col_vcb'] += $materials[8][$i]['price_r'] * $materials[8][$i]['qty'];
                    $eplsum[$cnt]['col_for'] += $materials[8][$i]['real_foreign'] ?? 0;
                }
            } else {
                $cnt++;
                $eplsum[$cnt]['mon_cod'] = $materials[8][$i]['mon_cod'];
                $eplsum[$cnt]['mah_cod'] = $materials[8][$i]['mah_cod'];
                $eplsum[$cnt]['col_r'] = 0;
                $eplsum[$cnt]['col_i'] = 0;
                $eplsum[$cnt]['col_vcb'] = 0;
                $eplsum[$cnt]['col_for'] = 0;
                if ($materials[8][$i]['row_type'] != "VCB") {
                    $eplsum[$cnt]['col_r'] += $materials[8][$i]['price_r'] * $materials[8][$i]['qty'];
                    $eplsum[$cnt]['col_i'] += $materials[8][$i]['price_i'] * $materials[8][$i]['qty'];
                    $eplsum[$cnt]['col_for'] += $materials[8][$i]['real_foreign'] ?? 0;
                } else if ($materials[8][$i]['row_type'] === "VCB") {
                    $eplsum[$cnt]['col_vcb'] += $materials[8][$i]['price_r'] * $materials[8][$i]['qty'];
                    $eplsum[$cnt]['col_for'] += $materials[8][$i]['real_foreign'] ?? 0;
                }
            }

        }

        if ($eplsum[$cnt]['mah_cod'] == $materials[8][count($materials[8]) - 1]['mah_cod']) {
            if ($materials[8][count($materials[8]) - 1]['row_type'] != "VCB") {
                $eplsum[$cnt]['col_r'] += $materials[8][count($materials[8]) - 1]['price_r'] * $materials[8][count($materials[8]) - 1]['qty'];
                $eplsum[$cnt]['col_i'] += $materials[8][count($materials[8]) - 1]['price_i'] * $materials[8][count($materials[8]) - 1]['qty'];
                $eplsum[$cnt]['col_for'] += $materials[8][count($materials[8]) - 1]['real_foreign'] ?? 0;
            } else if ($materials[8][count($materials[8]) - 1]['row_type'] === "VCB") {
                $eplsum[$cnt]['col_vcb'] += $materials[8][count($materials[8]) - 1]['price_r'] * $materials[8][count($materials[8]) - 1]['qty'];
                $eplsum[$cnt]['col_for'] += $materials[8][count($materials[8]) - 1]['real_foreign'] ?? 0;
            }
        } else {
            $cnt++;
            $eplsum[$cnt]['mon_cod'] = $materials[8][count($materials[8]) - 1]['mon_cod'];
            $eplsum[$cnt]['mah_cod'] = $materials[8][count($materials[8]) - 1]['mah_cod'];
            $eplsum[$cnt]['col_r'] = 0;
            $eplsum[$cnt]['col_i'] = 0;
            $eplsum[$cnt]['col_vcb'] = 0;
            $eplsum[$cnt]['col_for'] = 0;
            if ($materials[8][count($materials[8]) - 1]['row_type'] != "VCB") {
                $eplsum[$cnt]['col_r'] += $materials[8][count($materials[8]) - 1]['price_r'] * $materials[8][count($materials[8]) - 1]['qty'];
                $eplsum[$cnt]['col_i'] += $materials[8][count($materials[8]) - 1]['price_i'] * $materials[8][count($materials[8]) - 1]['qty'];
                $eplsum[$cnt]['col_for'] += $materials[8][count($materials[8]) - 1]['real_foreign'] ?? 0;
            } else if ($materials[8][count($materials[8]) - 1]['row_type'] === "VCB") {
                $eplsum[$cnt]['col_vcb'] += $materials[8][count($materials[8]) - 1]['price_r'] * $materials[8][count($materials[8]) - 1]['qty'];
                $eplsum[$cnt]['col_for'] += $materials[8][count($materials[8]) - 1]['real_foreign'] ?? 0;
            }
        }
        //print_r($eplsum);
        $this->view('eas', compact('materials', 'eplsum'));
    }

    public function setpifor()
    {
        $mdl = new DPL();
        $mon_cod = $this->test_input($_POST["mon_cod"]);
        $mah_cod = $this->test_input($_POST["mah_cod"]);
        $value = $this->test_input($_POST["value"]);
        $mdl->setpifor($mon_cod, $mah_cod, $value);
    }

    public function getDetails()
    {
        $db = new Pro();
        $details = $db->getDetails($this->test_input($_POST['code']));
        echo json_encode($details);
    }

    public function searchDetails($nam)
    {
        $db = new Pro();
        $det = $db->searchDetails($this->test_input(rawurldecode($nam)));
        echo json_encode($det);
    }

    public function searchTypes($type)
    {
        $db = new Pro();
        $types = $db->searchTypes($this->test_input(rawurldecode($type)));
        echo json_encode($types);
    }

    public function searchProducers($nam)
    {
        $db = new Pro();
        $names = $db->searchProducers($this->test_input(rawurldecode($nam)));
        echo json_encode($names);
    }

    public function details()
    {
        $desc = $this->test_input($_POST["desc"]);
        $type = $this->test_input($_POST["type"]);
        $company = $this->test_input($_POST["company"]);
        $product = $this->test_input($_POST["code"]);
        $db = new Pro();
        if (isset($_POST["id"])) {
            $db->editDetails($product, $desc, $type, $company, $this->test_input($_POST["id"]));
        } else {
            $db->addDetails($product, $desc, $type, $company);
        }
    }

    public function createTenderExcel()
    {
        $dpl = new DPL();
        $tenderCode = $this->test_input($_POST['tenderCode']);
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
            $drawing1[$i]->setPath('D:\\Apache24\\htdocs\\mehrabad\\assets\\images\\img.png');
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
            $drawing3[$i]->setPath('D:\\Apache24\\htdocs\\mehrabad\\assets\\images\\picture2.png');
            $drawing3[$i]->setCoordinates('E1');
            $drawing3[$i]->setOffsetX(60);
            $drawing3[$i]->setOffsetY(5);
            $drawing3[$i]->setWidth(100);
            $drawing3[$i]->setWorksheet($worksheet1[$i]);
            $worksheet1[$i]->mergeCells('A2:B2');
            $worksheet1[$i]->setCellValue('A2', ' CLIENT: FARA GOSTAR BISTOON');
            $worksheet1[$i]->getStyle('A2')->getFont()->setSize(8);
            $worksheet1[$i]->mergeCells('C2:D2');
            $worksheet1[$i]->setCellValue('C2', 'MANUFACTURER: MEHRABAD INDUSTRIAL CO.');
            $worksheet1[$i]->getStyle('C2')->getAlignment()
                ->setHorizontal('center');
            $worksheet1[$i]->getStyle('C2')->getAlignment()
                ->setVertical('center');
            $worksheet1[$i]->getStyle('C2')->getFont()->setSize(8);
            $worksheet1[$i]->mergeCells('E2:F2');
            $worksheet1[$i]->setCellValue('E2', ' CONSULTANT: GHODS NIROO ENGINEERING CO.');
            $worksheet1[$i]->getStyle('E2')->getAlignment()
                ->setHorizontal('left');
            $worksheet1[$i]->getStyle('E2')->getAlignment()
                ->setVertical('center');
            $worksheet1[$i]->getStyle('E2')->getFont()->setSize(8);

            //-----------------
            $worksheet1[$i]->mergeCells('A3:B3');
            $worksheet1[$i]->mergeCells('E3:F3');
            $worksheet1[$i]->getStyle('A3:F3')->getFont()->setSize(8);
            $worksheet1[$i]->setCellValue('A3', ' DOCUMENT NO.: LOM-403098-SARVESTAN');
            $worksheet1[$i]->setCellValue('C3', ' DOCUMENT TITLE:');
            $worksheet1[$i]->setCellValue('D3', $prodInfo['voltage'] . ' ' . $prodInfo['name'] . ' ' . $prodInfo['crnt']);
            $worksheet1[$i]->setCellValue('E3', ' REVISION: 01');
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
            $worksheet1[$i]->setCellValue('A4', ' PROJECT NAME: EXTENSION OF SHAHRAK-E-EMAM REZA 63/20 KV SUBSTATION');
            $worksheet1[$i]->getStyle('A4:F4')->getFont()->setSize(8);
            $worksheet1[$i]->setCellValue('E4', ' DATE:1403 / 09 / 05');
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


        $allProd = $dpl->getAllProd($tenderCode);
        for ($i = 0; $i < count($allProd); $i++) {
            $materials->getRowDimension((string)(10 + $i))->setRowHeight(30);
            $prod = $dpl->getPRODname($allProd[$i]['mah_cod']);
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

            $materials->setCellValue('D' . (10 + $i), $allProd[$i]['tedad']);
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
        $materials->setCellValue('B3', ' CLIENT: .................');
        $materials->getStyle('B3')->getFont()->setSize(8);

        $materials->getStyle('B4:D4')->applyFromArray($styleArray);
        $materials->mergeCells('B4:D4');
        $materials->getStyle('B4:D4')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B4:D4')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('4')->setRowHeight(20);
        $materials->setCellValue('B4', ' CONSULTANT: …................................');
        $materials->getStyle('B4')->getFont()->setSize(8);


        $materials->getStyle('B5:D5')->applyFromArray($styleArray);
        $materials->mergeCells('B5:D5');
        $materials->getStyle('B5:D5')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B5:D5')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('5')->setRowHeight(20);
        $materials->setCellValue('B5', ' PROJECT NAME: …...........................................');
        $materials->getStyle('B5')->getFont()->setSize(8);


        $materials->getStyle('B6:D6')->applyFromArray($styleArray);
        $materials->mergeCells('B6:D6');
        $materials->getStyle('B6:D6')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B6:D6')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('6')->setRowHeight(20);
        $materials->setCellValue('B6', ' DOCUMENT NO.: LOM-403098-SARVESTAN');
        $materials->getStyle('B6')->getFont()->setSize(8);

        $materials->getStyle('B7:D7')->applyFromArray($styleArray);
        $materials->mergeCells('B7:D7');
        $materials->getStyle('B7:D7')->getAlignment()
            ->setVertical('center');
        $materials->getStyle('B7:D7')->getAlignment()->setHorizontal('left');
        $materials->getRowDimension('7')->setRowHeight(20);
        $materials->setCellValue('B7', ' DATE:1403 / 09 / 05                                                                                                               REVISION: 01');
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

    public function createmyPdffile()
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

                if ($i < $tabcnt - 1)
                    pclose(popen("start /min \"l{$i}\" d:/php/php.exe -f \"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php\" \"{$urll}\" \"{$filename}\"", "r"));
                else
                    pclose(popen("start /min \"l{$i}\" d:/php/php.exe -f \"D:/Apache24/htdocs/mehrabad/app/views/project/commandprompt00.php\" \"{$urll}\" \"{$filename}\" \"Portrait\"", "r"));

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

    public function checkproposal()
    {
        $dpl = new DPL();
        $mon_cod = $this->test_input($_POST['mon_cod']);
        echo json_encode($dpl->checkproposal($mon_cod));
    }

    public function createproposal()
    {
        $dpl = new DPL();
        $mon_cod = $this->test_input($_POST['mon_cod']);
        $dat = $_POST['dat'];
        $dpl->createproposal($mon_cod, $dat);
    }

    public function setparameter()
    {
        $dpl = new DPL();
        $mon_cod = $this->test_input($_POST['mon_cod']);
        $parameter = $this->test_input($_POST['parameter']);
        $pval = $this->test_input($_POST['pval']);
        $dpl->setparameter($mon_cod, $parameter, $pval);
    }

    public function setparametery()
    {
        $dpl = new DPL();
        $year = $this->test_input($_POST['year']);
        $parameter = $this->test_input($_POST['parameter']);
        $pval = $this->test_input($_POST['pval']);
        $dpl->easpcs_y($parameter, $pval, $year);
    }

    public function print($q)
    {
        $qq = $this->test_input(rawurldecode($q));
        $dpl = new DPL();
        $letter = $dpl->checkproposal2($qq);
        $otherdata = $dpl->checkproposal3($qq);
        $epl = $dpl->jusgetepl($qq);
        $eplm = [];
        $cnt = 0;
        $eplcnt = [];
        for ($i = 0; $i < count($epl[2]); $i++) {
            if ($i < count($epl[2]) - 1) {
                if ($epl[2][$i]['mah_cod'] == $epl[2][$i + 1]['mah_cod']) {
                    $eplm[$cnt][] = $epl[2][$i];
                    isset($eplcnt[$cnt]) ? $eplcnt[$cnt]++ : $eplcnt[$cnt] = 1;
                } else if ($epl[2][$i]['mah_cod'] != $epl[2][$i + 1]['mah_cod']) {
                    $eplm[$cnt][] = $epl[2][$i];
                    isset($eplcnt[$cnt]) ? $eplcnt[$cnt]++ : $eplcnt[$cnt] = 1;
                    $cnt++;
                }
            } else {
                if ($epl[2][$i]['mah_cod'] == $epl[2][$i - 1]['mah_cod']) {
                    $eplm[$cnt][] = $epl[2][$i];
                    isset($eplcnt[$cnt]) ? $eplcnt[$cnt]++ : $eplcnt[$cnt] = 1;
                } else if ($epl[2][$i]['mah_cod'] != $epl[2][$i - 1]['mah_cod']) {

                    $eplm[$cnt][] = $epl[2][$i];
                    isset($eplcnt[$cnt]) ? $eplcnt[$cnt]++ : $eplcnt[$cnt] = 1;

                }
            }
        }
      // print_r($eplcnt);
        for ($i = count($eplcnt) - 1; $i >= 0; $i--) {
            if ($eplcnt[$i] == 1) {
                array_splice($eplm,$i,1);
            }
        }
       // print_r($eplm);
        //$epl=$this->selectAll("select * from tbl_mehrabad_monaqese_epl where mon_cod=? order by id",[$tenderData['code']]);
        $this->view('proposal', compact('letter', 'epl', 'eplm','otherdata'));
    }

    public function easpcs()
    {
        $dpl = new DPL();
        $id = $this->test_input($_POST['id']);
        $value = $this->test_input($_POST['value']);
        $mon_cod = $this->test_input($_POST['mon_cod']);
        $dpl->easpcs($id, $value, $mon_cod);
    }

    public function geteas()
    {
        $dpl = new DPL();
        $mon_cod = $this->test_input($_POST['mon_cod']);
        $result = $dpl->geteas($mon_cod);
        echo json_encode(count($result) > 0 ? $result : null);
    }

//    public function getequphistory()
//    {
//        $equip = $this->test_input($_POST['equip']);
//        $dpl = new DPL();
//        $result = $dpl->getequphistory($equip);
//        echo json_encode(count($result) > 0 ? $result : null);
//    }

    public function statics($q, $qq, $type)
    {
        $q = rawurldecode($q);
        $qq = rawurldecode($qq);
        $type = rawurldecode($type);
        //print_r($type);
        $dpl = new DPL();
        [$allData, $allData1] = $dpl->getequphistory($qq, $type);
        $this->view('reports/statisticalpriceinfoepl', compact('q', 'allData', 'allData1', 'type'));
    }

    public function controlsheets()
    {
        $dpl = new DPL();
        $mon_cod = $this->test_input($_POST['mon_cod']);
        $sheet = $this->test_input($_POST['sheetC']);

        $result = $dpl->declareControl($mon_cod, $sheet);

    }

    public function controleplprice()
    {
        $dpl = new DPL();
        $equip = $_POST['equip'];
        $spec = $_POST['spec'];
        $price = $this->test_input($_POST['price']);
        $no = $this->test_input($_POST['no']);
        echo json_encode($dpl->controleplprice($equip, $spec, $price, $no));
    }
    public function extractEpl()
    {
        $dpl = new DPL();
        $tenderCode = $this->test_input($_POST['tenderCode']);
        $dpl->extractEpl($tenderCode);
    }

}
