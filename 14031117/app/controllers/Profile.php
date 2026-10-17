<?php

namespace App\Controllers;

use App\Models\ProfileModel as model;

class Profile extends Controller
{
    public function show($id)
    {
        $userId = $this->test_input(rawurldecode($id));
        $db = new model();
        $user = $db->user($userId);
        return $this->view('profile', compact('user'));
    }

    public function submit()
    {
        // echo __DIR__;
        //print_r($_POST);print_r($_FILES);
        $db = new model();
        if (isset($_FILES) && isset($_FILES['file']) && $this->validateExt($_FILES["file"]["name"])) {
            $upload = $this->uploadFile($_FILES['file'], '\profiles');
            $currentAx = $db->current_AX();
            if (isset($currentAx['ax'])) {
                $pathToFile = __DIR__ . '\..\..\assets\images\profiles\\' . $currentAx['ax'];
                unlink($pathToFile);
            }
            $ax = $upload[0];
            if ($ax) $_SESSION['ax'] = $ax;
             $db->submitProfile($ax);
        }
        if (isset($_FILES) && isset($_FILES['sign']) && $this->validateExt($_FILES["sign"]["name"])) {
            $upload1 = $this->uploadFile($_FILES['sign'], '\signs');
            $currentAx1 = $db->current_sign();
           // print_r($currentAx1);
            if (isset($currentAx1['signature'])) {
                $pathToFile = __DIR__ . '\..\..\assets\images\signs\\' . $currentAx1['signature'];
                unlink($pathToFile);
            }
            $sign = $upload1[0];
            $db->submitSign($sign);
        }

        $data = json_decode($_POST['data']);

        $email = $data->email ? $this->test_input($data->email) : NULL;
        $phone = $data->phone ? $this->test_input($data->phone) : NULL;
        $address = $data->address ? $this->test_input($data->address) : NULL;
        if ($data->password) {
            $pas = password_hash($this->test_input($data->password),PASSWORD_DEFAULT);
             $db->changePassword($pas);
        }
         $db->submitChange($email, $phone, $address);
        $user= $db->user($_SESSION['tkn']);
        echo json_encode($user);
    }
}