<?php

namespace App\Controllers;
use App\Models\GroupModel as Gp;

class Group extends Controller
{
    public function index()
    {
        if (isset($_SESSION['access']) && $_SESSION['access'][1]['access'] == 1 || isset($_SESSION['admin'])) {
            $db = new Gp();
            $all = $db->all();
            $this->view('groups', compact('all'));
        }else $this->view('auth/404');

    }

    public function submit()
    {
        $db = new Gp();
        $id = $this->test_input($_POST['elementID']);
        if (isset($_POST['elementPro'])) {
            $grp = $_POST['elementPro'];
            $brand = $this->test_input($_POST['brand']);
            $specification = $this->test_input($_POST['specification']);
            $equipment =$this->test_input($_POST['equipment']); 
            if ($grp == 1) {
                $fields = ['description', 'type', 'manufacturer'];
                $fValues = [$equipment, $specification == null ? '' : $specification
                    , $brand == null ? '' : $brand];
                //print_r($fileds);
                if ($id == 0) $db->submitGroup($fields, $fValues);
                else {
                    $db->updateGroup($fValues[0],  $fValues[1],  $fValues[2], $id);
                }
            } else if ($grp == 2) {
                $db->delete($id);
            }
        }
        $this->redirect('group');
    }
}