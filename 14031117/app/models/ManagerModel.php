<?php

namespace App\Models;

class ManagerModel extends Model
{

    public function rejectBuyReq( $p,  $b,  $type)
    {
        $this->insert('tbl_mehrabad_projects_buy_req_sign',['proj_code','buy_no','trkh','user_id','host','descriptions','accepted'],
            [$p,$b,explode(' ',persianNow)[0],$_SESSION['tke'],IP,$type,0]);
        $this->update("update tbl_mehrabad_projects_demands set buy_req_status=1 where proj_code=? and buy_no=? ", [ $p, $b]);
    }

    public function acceptBuyReq(?string $p, ?string $b, ?string $type)
    {
        $this->insert('tbl_mehrabad_projects_buy_req_sign',['proj_code','buy_no','trkh','user_id','host','descriptions','accepted'],
            [$p,$b,explode(' ',persianNow)[0],$_SESSION['tke'],IP,$type,1]);
    }
}