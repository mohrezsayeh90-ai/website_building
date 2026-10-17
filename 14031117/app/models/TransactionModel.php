<?php

namespace App\Models;

class TransactionModel extends Model
{

    public function signBuyReq( $p,  $b,  $type)
    {

        $this->insert('tbl_mehrabad_projects_buy_req_sign',['proj_code','buy_no','trkh','user_id','host','descriptions'],
            [$p,$b,explode(' ',persianNow)[0],$_SESSION['tke'],IP,$type]);
    }
}