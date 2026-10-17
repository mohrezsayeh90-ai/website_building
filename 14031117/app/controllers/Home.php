<?php

namespace App\Controllers;

use App\Models\Badge;

class Home extends Controller
{
    public function index()
    {
        $bdg = new Badge();
        $badges = $bdg->getBadges($_SESSION['tkeNn']);
        $cnt=0;
        foreach ($badges as $badge) {
            if(!$badge['seen_at']) $cnt = $cnt+1;
        }
        return $this->view("home", compact("badges", 'cnt'));
    }

    public function badge()
    {
        $bdg = new Badge();
        $badges = $bdg->getBadges($_SESSION['tkeNn']);
        $cnt=0;
        foreach ($badges as $badge) {
            if(!$badge['seen_at']) $cnt = $cnt+1;
        }
        return $this->view("home", compact("badges", "cnt"));
    }
    public function notification()
    {
        $bdg = new Badge();
        $badges = $bdg->unreadBadges($_SESSION['tkeNn']);
       echo json_encode($badges);
    }
    public function seen()
    {
        $bdg = new Badge();
        $badge = $bdg->seenBadge($this->test_input($_POST["q"]));
        echo json_encode($badge);
    }

    public function seenAll(){
        $bdg = new Badge();
        $badge = $bdg->seenAllBadges();
        echo json_encode($badge);
    }
}