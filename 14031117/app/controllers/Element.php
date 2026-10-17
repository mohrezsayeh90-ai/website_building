<?php

namespace App\Controllers;

use App\Models\ElementModel as Elem;

class Element extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][0]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new Elem();
            $all = $db->all();
            $this->view('elements', compact('all'));
        }else $this->view('auth/404');
    }

    public function smb()
    {
        $db = new Elem();
        
        $id = $this->test_input($_POST['elementID']);
        if (isset($_POST['elementPro'])) {
            $elem = $_POST['elementPro'];
            $brand = $this->test_input($_POST['brand']);
            $specification = $this->test_input($_POST['specification']);
            $equipment =$this->test_input($_POST['equipment']);
            if ($elem == 1) {
                $fields = ['description', 'type', 'manufacturer'];
                $fValues = [$equipment, $specification == null ? '' : $specification
                    , $brand == null ? '' : $brand];
                //print_r($fields);
                if ($id == 0) $db->submitElement($fields, $fValues);
                else {
                    $db->updateElement($fValues[0],  $fValues[1],  $fValues[2], $id);
                }
            } else if ($elem == 2) {
                $db->delete($id);
            }
        }
        
        $this->redirect('element');
    }

}