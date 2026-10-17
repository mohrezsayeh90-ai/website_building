<?php

namespace App\Controllers;

use App\Models\TenderModel as Ten;

class Tender extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][5]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new Ten();
            if (isset($_POST['delTender']) && $_POST['delTender']) {
                $db->deleteTender($this->test_input($_POST['tenderCode']));
            } else {
                $id = $db->id();
                $code = $id ? 'LOM-' . substr('000000' . ($id + 1), -6) : 'LOM-000001';
                //$code = $id ? 'TEN' . date('dm') . ($id['id'] + 1) : 'TEN' . date('dm') . 1;
                $all = $db->getAll();
                $tenders = $db->getTenders();
                $this->view('tender', compact('code', 'all', 'tenders'));
            }
        } else $this->view('auth/404');
    }

    public function submit()
    {
//&& (isset($_FILES) && empty($_FILES['files']['error'][0] && $_POST["option"] === '-1')) && (isset($_POST["tenDate"]) && $_POST["tenDate"] != NULL)
        if ((isset($_POST["tenName"]) && $_POST["tenName"] != NULL)
            && (isset($_POST["tenCus"]) && $_POST["tenCus"] != NULL) &&
            (isset($_POST["tenDocDate"]) && $_POST["tenDocDate"] != NULL)) {
//            $_SESSION["tenName"] = $_POST["tenName"];
//            $_SESSION["tenCus"] = $_POST["tenCus"];
//            $_SESSION["tenDocDate"] = $_POST["tenDocDate"];
//            $_SESSION["tenDate"] = $_POST["tenDate"];
            $name = $this->test_input($_POST["tenName"]);
            $cod = $this->test_input($_POST["tenCode"]);
            $date = $this->test_input($_POST["tenDate"]);
            $dueDate = $this->test_input($_POST["tenDocDate"]);
            $cus = $this->test_input($_POST["tenCus"]);
            $tmp = '';
            if ($_FILES["files"]) {
                foreach ($_FILES["files"]["name"] as $itm) {
                    $tmp .= $this->validateOfficeExt($itm) ?: '0';
                }
            }
            if (1 == 2) {
                $this->flash('message', 'فرمت غیرمجاز!');
            } else {
                $db = new Ten();
                $files = $db->submitTender($name, $cod, $date, $dueDate, $cus);
                $path = __DIR__ . '\..\..\assets\images\tenders\\';
                $result = '';
                if ($files !== null && (isset($_FILES['files']['name'][0]) && strlen($_FILES['files']['name'][0]) > 3)) {
                    $db->deleteOldfiles($cod);
                    foreach ($files as $file) {
                        unlink($path . $file["nam"]);
                    }

                }
                if (isset($_FILES['files']['name'][0]) && strlen($_FILES['files']['name'][0]) > 3) {
                    $upload = $this->uploadMultipleFiles($_FILES["files"], 'tenders');

                    foreach ($upload as $itm) {
                        $upl = $db->uploadFiles($itm[0], $itm[1], $cod);

                    }
                }
//                if (!str_contains($result, '0')) {
//                    $this->flash('message', 'موفقیت آمیز!');
//                    $this->flash('success', '');
//                    unset($_SESSION["tenName"]);
//                } else $this->flash('message', 'خطایی پیش آمد!!');
            }
            $this->redirect('tender');
        } else {
            $this->flash("message", 'تمامی ورودی ها و اسناد مربوطه را وارد نمائید!');
            $this->redirect('tender');
        }
    }

    public function edit()
    {
        $db = new Ten();
        $code = $this->test_input($_POST["code"]);
        $info = $db->editInfo($code);
        echo json_encode($info);
    }

}