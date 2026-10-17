<?php

namespace App\Controllers;
use App\models\loginModel as lgn;
use System\Traits\Auth;

class login extends Controller
{
    use Auth;
        public function index()
        {
            $this->view('auth/login');
        }
        public function check()
        {

            $db = new lgn();
            $message = [];
//echo $_SESSION["tke"];
            if (isset($_POST['submit'])) {
                $name = $this->test_input($_POST['userName']);
                $pas = $this->test_input($_POST['password']);
                if (!$name || !$pas) {
                    $message['message'] = 'ورودی ها نمی توانند خالی باشند!';
                } else {
                    $user = $db->selectUser($name);
                    if (!$user) {
                        $message['message'] = 'نام کاربری یا رمز ورود اشتباه است!';
                    } else {
                        if (password_verify($pas, $user['userPas'])) {
                            $exist = $db->existLogin($user["id"]);
                            if ($exist) {
                                $db->deleteSession($user["id"]);
                                if ($exist['IP'] !== IP) {///**when user is loginModel with another PC***////
                                    $message['message'] = 'دسترسی ممنوع!!';
                                } else
                                {
                                    $this->extracted($db, $user, georgianNow);
                                }
                            } else {
                                $this->extracted($db, $user, georgianNow);
                            }
                            //}
                        } else
                            $message['message'] = 'رمز ورود اشتباه است!';
                    }
                }
            }
            $this->view('auth/login', compact('message'));
       }

    /**
     * @param lgn $db
     * @param mixed $user
     * @param string $georgianNow
    // * @param mixed $ip
     * @return void
     */
    public function extracted(lgn $db, mixed $user, string $georgianNow): void
    {
        $token = $this->GUID();
        $insert = $db->login($user['id'], $token, strtotime($georgianNow), $this->expireTime30($georgianNow));
        if ($insert == 1) {
            $_SESSION["tkn"] = $user['id'];
            $_SESSION["tke"] = $user['userName'];
            $_SESSION["tkeNn"] = $user['userName'];
            if($user['ax'])$_SESSION['ax'] =$user['ax'];
            $_SESSION["tke"] = $user['userName'];
            if (isset( $_SESSION["tke"]) &&  $_SESSION["tke"] === 'admin') $_SESSION['admin']=$_SESSION["tke"];  //** admin **//
            $_SESSION["tim"] = (int)$user['team'];
            if($_SESSION["tim"]!=0 )$_SESSION["access"] = $this->access($_SESSION["tim"]);
            $this->redirect('/home');
        }
    }
    public function loginSystem()
    {
        $db = new lgn();
        if (isset($_SESSION['tkn'])) {
            $isLogin = $db->existLogin($_SESSION['tkn']);
            if ($isLogin && $isLogin['IP'] === IP) {
                if (strtotime(georgianNow) < $isLogin['expireDate']) {
                    ////update time in every page
                    $update = $db->updateTkn($_SESSION['tkn']);
                    if ($update == 1) {
                       return 200;
                    }
                } else{
                    $db->deleteSession($_SESSION['tkn']);
                   session_destroy();
                    $this->redirect('/login');///time expired
                }
            }else{
                $db->deleteSession($_SESSION['tkn']);
               session_destroy();
                $this->redirect('/login');///not login
            }
        } else {///session expired
            $db->deleteSession($_SESSION['tkn']);
            session_destroy();
            $this->redirect('/login');}
    }
    public function logOut()
    {
        $db = new lgn();
        $db->deleteSession($_SESSION['tkn']);
        session_destroy();
    }
}