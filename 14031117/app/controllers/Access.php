<?php

namespace App\Controllers;

use App\Models\AccessModel as AC;

class Access extends Controller
{
    public function index()
    {
        if (isset($_SESSION['admin'])) {
        $this->view('auth/access');
        } else $this->view('auth/404');
    }

    public function user()
    {
        $user = $this->test_input($_POST["user"]);
        $pass = password_hash($this->test_input($_POST["pass"]),PASSWORD_DEFAULT);
        $role = $this->test_input($_POST["role"]);
        $team = $this->test_input($_POST["team"]);
        $db = new AC();
        $userInfo = $db->submitUser($user, $pass, $role);
        $teamInfo = $db->userTeams($user, $team);
        if ($teamInfo && $userInfo) echo json_encode(1);
    }
}