<?php

namespace App\Controllers;
use APP\Models\ViewModel as Sgn;

class View extends Controller
{
    public function index()
    {
        $db= new Sgn();
        $all = $db->getAll();
        $this->view('assign', compact('all'));
    }
    public function details()
    {
        $db= new Sgn();
        echo json_encode($db->details($this->test_input($_POST["code"])));

    }
    public function document()
    {
        $db= new Sgn();
        echo json_encode($db->documents($this->test_input($_POST["code"])));

    }
    public function upload()
    {
        $code =$this->test_input($_POST["code"]);
        $tmp ='';
        foreach ($_FILES["files"]["name"] as $itm){
           $tmp .= $this->validateExt($itm) ? :'0';
        }
        if(str_contains($tmp, '0')){
            echo json_encode(['فقط فرمت های تصویر و pdf مجاز هستند!', 'error']);
        }else{
            $db= new Sgn();
            $files= $db->existFiles($code);
            $path= __DIR__.'\..\..\assets\images\products\\';
            if($files){
                foreach ($files as $file){
                    unlink($path.$file["nam"]);
                }
            }
            $uploads = $this->uploadMultipleFiles($_FILES["files"], 'products');
            foreach ($uploads as $up){
                if(is_array($up)){
                   $db->uploadFile($up, $code);
                }
            }
            echo json_encode(['بارگذاری موفقیت آمیز!', 'success']);
        }
    }
    public function assign()
    {
        $db= new Sgn();
        $res =$db->assignTender($this->test_input($_POST["tender"]), $this->test_input($_POST["pro"]));
        echo $res;
    }
}