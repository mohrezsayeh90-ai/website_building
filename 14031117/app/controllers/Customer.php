<?php

namespace App\Controllers;

use APP\Models\CustomerModel as cus;

class Customer extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][3]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new cus();
            $id = $db->id();
            $code = $id!=0 ? 'MOT-' . substr('0000' . ($id + 1), -4) : 'MOT-0001';
            if (isset($_POST['getallcustomers']) && $_POST['getallcustomers']) {
                echo json_encode($db->allcustomers());
            } else if (isset($_POST['delCustomer']) && $_POST['delCustomer']) {
                $cusCod = $this->test_input($_POST['cusCod']);

                $db->delcustomer($cusCod);
            } else if (isset($_POST['editCustomer']) && $_POST['editCustomer']) {
                $cusCod = $this->test_input($_POST['cusCod']);

                echo json_encode($db->selectcustomer($cusCod));
            } else {
                $this->view('customers', compact('code'));
            }
        } else $this->view('auth/404');

    }

    public function submit()
    {
        if ((isset($_POST["name"]) && $_POST["name"] != NULL) && (isset($_POST["address"]) && $_POST["address"] != NULL)
            && (isset($_POST["phone2"]) && $_POST["phone1"] != NULL) && (isset($_POST["eName"]) && $_POST["eName"] != NULL)) {
//            $_SESSION["cusCode"] = $_POST["cusCode"];
//            $_SESSION["name"] = $_POST["name"];
//            $_SESSION["eName"] = $_POST["eName"];
//            $_SESSION["identitiy"] = $_POST["identitiy"];
//            $_SESSION["phone1"] = $_POST["phone1"];
//            $_SESSION["phone2"] = $_POST["phone2"];
//            $_SESSION["fax"] = $_POST["fax"];
//            $_SESSION["email"] = $_POST["email"];
//            $_SESSION["address"] = $_POST["address"];
//            $_SESSION["postCode"] = $_POST["postCode"];
            $name = $this->test_input($_POST["name"]);
            $cod = $this->test_input($_POST["cusCode"]);
            $identity = tr_num($this->test_input($_POST["identitiy"]));
            $type = $this->test_input($_POST["cusType"]);
            $mobile = tr_num($this->test_input($_POST["phone2"]));
            $tel = tr_num($this->test_input($_POST["phone1"]));
            $fax = $this->test_input($_POST["fax"]);
            $email = tr_num($this->test_input($_POST["email"]));
            $address = tr_num($this->test_input($_POST["address"]));
            $post = tr_num($this->test_input($_POST["postCode"]));
            $ename = tr_num($this->test_input($_POST["eName"]));
            $connector = tr_num($this->test_input($_POST["connector"]));
            $cusrole = 0;
            if (isset($_POST["cusRole1"]))
                $cusrole += $_POST["cusRole1"];
            if (isset($_POST["cusRole2"]))
                $cusrole += $_POST["cusRole2"];
            $logo = '';
            try {
                $upload = $this->uploadFile($_FILES["files"], 'customers');
                if (isset($upload) && $upload)
                    $logo = $upload[0];

            } catch (TypeError $ex) {

            }

            $db = new cus();
            if (isset($_POST["editCustomers"]) && $_POST["editCustomers"] == 1) {
                $_SESSION["editCustomers"] = $_POST["editCustomers"];
                $res = $db->editCus($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post, $ename, $cusrole, $logo, $connector);
            } else {
                $res = $db->submitCus($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post, $ename, $cusrole, $logo, $connector);
            }
            if ($res == 1) {
                $this->flash("message", 'ثبت موفقیت آمیز');
                $this->flash("success", '');
                unset($_SESSION["name"]);
                unset($_SESSION["identitiy"]);
                unset($_SESSION["phone1"]);
                unset($_SESSION["phone2"]);
                unset($_SESSION["fax"]);
                unset($_SESSION["editCustomer"]);
                unset($_SESSION["cusCode"]);
                unset($_SESSION["email"]);
                unset($_SESSION["address"]);
                unset($_SESSION["postCode"]);
                unset($_SESSION["eName"]);
                unset($_SESSION["connector"]);
            } else  $this->flash("message", 'خطایی رخ داده است!!');
            $this->redirect('customer');
        } else {
            $this->flash("message", 'ورودی های ستاره دار الزامی هستند!');
            $this->redirect('customer');
        }
    }

    public function getNames($nam)
    {
        $db = new cus();
        $names = $db->companies($this->test_input(rawurldecode($nam)));
        echo json_encode($names);
    }

    public function getDetails()
    {
        $db = new cus();
        $details = $db->detail($this->test_input($_POST["text"]));
        echo json_encode($details);
    }

    public function closeEdit()
    {
        //session_destroy();
        $this->redirect('customer');
    }
}