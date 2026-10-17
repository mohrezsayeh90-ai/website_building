<?php

namespace App\Controllers;

use App\Models\ProductModel as Pro;

class Product extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][2]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new Pro();
            $id = $db->id();
            $code = $id>0 ? 'PRO-' . substr('0000' . ($id + 1), -4) : 'PRO-0001';
            if (isset($_POST['getallproducts']) && $_POST['getallproducts']) {
                echo json_encode($db->allproducts());
            } else if (isset($_POST['delProduct']) && $_POST['delProduct']) {
                $prdCod = $this->test_input($_POST['prdCod']);

                $db->delproduct($prdCod);
            } else if (isset($_POST['editProduct']) && $_POST['editProduct']) {
                $prdCod = $this->test_input($_POST['prdCod']);

                echo json_encode($db->selectproduct($prdCod));
            } else {
                $all = $db->getAll();
                $allequip = $db->getAllequip();
                foreach ($all as $key => $itm) {
                    $all[$key] = array_merge(['files' => $db->getFiles($itm['code'])], $itm);
                }
                $this->view('product', compact('code', 'all', 'allequip'));
            }
        } else $this->view('auth/404');

    }

    public function setName($nam, $cod)
    {
        $db = new Pro();
        if (isset($cod)) {
            $db->editName($this->test_input(rawurldecode($nam)), $this->test_input(rawurldecode($cod)));
        } else {
            $id = $db->proName($this->test_input(rawurldecode($nam)));
            echo json_encode($id);
        }
    }

    public function getNames($nam)
    {
        $db = new Pro();
        $names = $db->proNames($this->test_input(rawurldecode($nam)));
        echo json_encode($names);
    }

    public function upload()
    {
        $code = $this->test_input($_POST["code"]);
        $tmp = '';
        foreach ($_FILES["files"]["name"] as $itm) {
            $tmp .= $this->validateExt($itm) ?: '0';
        }
        if (str_contains($tmp, '0')) {
            echo json_encode(['فقط فرمت های تصویر و pdf مجاز هستند!', 'error']);
        } else {
            $db = new Pro();
            $files = $db->existFiles($code);
            $path = __DIR__ . '\..\..\assets\images\products\\';
            if ($files) {
                foreach ($files as $file) {
                    unlink($path . $file["nam"]);
                }
            }
            $uploads = $this->uploadMultipleFiles($_FILES["files"], 'products');
            foreach ($uploads as $up) {
                if (is_array($up)) {
                    $db->uploadFile($up, $code);
                }
            }
            echo json_encode(['بارگذاری موفقیت آمیز!', 'success']);
        }
    }

    public function submit()
    {

        if ((isset($_POST["proName"]) && $_POST["proName"] != NULL)) {
            //&& (isset($_FILES) && empty($_FILES['files']['error'][0]))
            $_SESSION["proName"] = $_POST["proName"];
            $_SESSION["proVolt"] = $_POST["proVolt"];
            $_SESSION["proAmp"] = $_POST["proAmp"];
            $_SESSION["proModel"] = $_POST["proModel"];
            $_SESSION["proType"] = $_POST["proType"];
            $name = $this->test_input($_POST["proName"]);
            $cod = $this->test_input($_POST["proCode"]);
            $eq = $this->test_input($_POST["assignData"]);
            $provolt = $this->test_input($_POST["proVolt"]);
            $proamp = $this->test_input($_POST["proAmp"]);
            $promodel = $this->test_input($_POST["proModel"]);
            $protype = $this->test_input($_POST["proType"]);
                $db = new Pro();
                $logo = $this->uploadFile($_FILES["files"], 'products')[0];
//                $file=fopen('d:/1.txt',"w");
//                fwrite($file,$name.$cod.$logo.$eq.$provolt.$proamp.$promodel.$protype);
//                fclose($file);
                //print_r($logo);
                $files = $db->submitProduct($name, $cod, $logo, $eq, $provolt, $proamp, $promodel, $protype);
                unset($_SESSION["proName"]);
                unset($_SESSION["proVolt"]);
                unset($_SESSION["proAmp"]);
                unset($_SESSION["proModel"]);
                unset($_SESSION["proType"]);


            $this->redirect('product');
        } else {
            $this->flash("message", 'نام و اسناد الزامی هستند!');
            $this->redirect('product');
        }
    }
    public function duplicate()
    {
        $db = new Pro();
        $prdCod = $this->test_input($_POST["prdCod"]);
        $id = $db->id();
        $code = $id>0 ? 'PRO-' . substr('0000' . ($id + 1), -4) : 'PRO-0001';
        $db->duplicate($prdCod,$code);
    }
}