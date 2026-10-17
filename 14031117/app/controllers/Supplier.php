<?php

namespace App\Controllers;

use APP\Models\SupplierModel as sup;

class Supplier extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][4]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new sup();
            $id = $db->id();
            $code = $id!=0 ? 'SUP-' . substr('0000' . ($id + 1), -4) : 'SUP-0001';
            $this->view('supplier', compact('code'));
        }else $this->view('auth/404');
    }

    public function submit()
    {

        if ((isset($_POST["name"]) && $_POST["name"] != NULL) && (isset($_POST["address"]) && $_POST["address"] != NULL)
            && (isset($_POST["phone2"]) && $_POST["phone1"] != NULL) && (isset($_POST["eName"]) && $_POST["eName"] != NULL)) {
            $_SESSION["supCode"] = $_POST["supCode"];
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["eName"] = $_POST["eName"];
            $_SESSION["identity"] = $_POST["identity"];
            $_SESSION["phone1"] = $_POST["phone1"];
            $_SESSION["phone2"] = $_POST["phone2"];
            $_SESSION["fax"] = $_POST["fax"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["address"] = $_POST["address"];
            $_SESSION["postCode"] = $_POST["postCode"];
            $name = $this->test_input($_POST["name"]);
            $cod = $this->test_input($_POST["supCode"]);
            $identity = tr_num($this->test_input($_POST["identity"]));
            $type = $this->test_input($_POST["supType"]);
            $mobile = tr_num($this->test_input($_POST["phone2"]));
            $tel = tr_num($this->test_input($_POST["phone1"]));
            $fax = $this->test_input($_POST["fax"]);
            $email = tr_num($this->test_input($_POST["email"]));
            $address = tr_num($this->test_input($_POST["address"]));
            $post = tr_num($this->test_input($_POST["postCode"]));
            $eName = tr_num($this->test_input($_POST["eName"]));
            $score = tr_num($this->test_input($_POST["score"]));
            $accountno = tr_num($this->test_input($_POST["shaba"]));
            $logo = '';
            try {
                $upload = $this->uploadFile($_FILES["files"], 'suppliers');
                if (isset($upload) && $upload)
                    $logo = $upload[0];

            } catch (TypeError $ex) {

            }

            $db = new sup();
            if (isset($_POST["editSupplier"]) && $_POST["editSupplier"] == 1) {
                $_SESSION["editSupplier"] = $_POST["editSupplier"];
                $res = $db->editSup($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post, $eName, $logo,$accountno,$score);
            } else {
                $res = $db->submitSup($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post, $eName, $logo,$accountno,$score);
            }
            if ($res == 1) {
                $this->flash("message", 'ثبت موفقیت آمیز');
                $this->flash("success", '');
                unset($_SESSION["name"]);
                unset($_SESSION["identitiy"]);
                unset($_SESSION["phone1"]);
                unset($_SESSION["phone2"]);
                unset($_SESSION["fax"]);
                unset($_SESSION["editSupplier"]);
                unset($_SESSION["supCode"]);
                unset($_SESSION["email"]);
                unset($_SESSION["address"]);
                unset($_SESSION["postCode"]);
                unset($_SESSION["eName"]);
                unset($_SESSION["score"]);
                unset($_SESSION["shaba"]);
            } else  $this->flash("message", 'خطایی رخ داده است!!');
           $this->redirect('Supplier');
        } else {
            $this->flash("message", 'ورودی های ستاره دار الزامی هستند!');
            $this->redirect('Supplier');
        }
    }

    public function getNames($nam)
    {
        $db = new sup();
        $names = $db->companies($this->test_input(rawurldecode($nam)));
        echo json_encode($names);
    }

    public function getAll()
    {
        $db = new sup();
        echo json_encode($db->allSupplier());
    }

    public function edit()
    {
        $db = new sup();
        $supCod = $this->test_input($_POST['supCod']);
        echo json_encode($db->selectSupplier($supCod));;
    }

    public function delete()
    {
        $db = new sup();
        $supCod = $this->test_input($_POST['supCod']);
        $db->delSupplier($supCod);
    }
//    public function getDetails()
//    {
//        $db = new sup();
//        $details = $db->detail($this->test_input($_POST["text"]));
//        echo json_encode($details);
//    }
//    public function closeEdit()
//    {
//        session_destroy();
//        $this->redirect('Supplier');
//    }
}