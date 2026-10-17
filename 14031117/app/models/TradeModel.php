<?php

namespace App\Models;

class TradeModel extends Model
{

    public function setPrice($id, $p, $value)
    {
        if ($p <= 3) $this->update("update tbl_mehrabad_projects_demands set price{$p}=? where id=? and bought_iscomplete=0 and buy_req_status<50", [$value, $id]);
        else $this->update("update tbl_mehrabad_projects_demands set price_final=? where id=? and bought_iscomplete=0 and buy_req_status<50", [$value, $id]);
    }

    public function setTradeLevel($id, $value)
    {
        $this->update("update tbl_mehrabad_projects_trade_levels set maxval=? where id=?", [$value, $id]);
    }

    public function insertUplodedFiles($projCode, $fileName, $fileN, $buyNo)
    {
        $this->insert('tbl_mehrabad_projects_buy_req_docs', ['proj_code', 'buy_no', 'filename', 'filelink', 'trkh', 'host', 'user_id'],
            [$projCode, $buyNo, $fileName, $fileN, explode(' ', persianNow)[0], IP, $_SESSION['tke']]);
    }

    public function signBuyReq($p, $b, $type)
    {
        switch ($type) {
            case "معاملات خرد":
                $this->update("update tbl_mehrabad_projects_demands set buy_req_status=4,buy_req_type=?,buy_req_start_buying_date where proj_code=? and buy_no=? ", [$type, explode(' ', persianNow)[0], $p, $b]);
                break;
            case "معاملات متوسط":
                $this->update("update tbl_mehrabad_projects_demands set buy_req_status=10,buy_req_type=? where proj_code=? and buy_no=? ", [$type, $p, $b]);
                break;
            case "معاملات کلان":
                $this->update("update tbl_mehrabad_projects_demands set buy_req_status=11,buy_req_type=? where proj_code=? and buy_no=? ", [$type, $p, $b]);
                break;
        }
        $this->insert('tbl_mehrabad_projects_buy_req_sign', ['proj_code', 'buy_no', 'trkh', 'user_id', 'host'],
            [$p, $b, explode(' ', persianNow)[0], $_SESSION['tke'], IP]);
    }

    public function closeBuyReq(?string $p, ?string $b)
    {
        $this->update("update tbl_mehrabad_projects_demands set buy_req_status=100,bought_iscomplete=1,
                                         buy_req_end_buying_date=? where proj_code=? and buy_no=?", [persianNow, $p, $b]);
        $this->insert('tbl_mehrabad_projects_buy_req_sign', ['proj_code', 'buy_no', 'trkh', 'user_id', 'host', 'descriptions'],
            [$p, $b, explode(' ', persianNow)[0], $_SESSION['tke'], IP, 'درخواست بسته شد']);
    }

    public function issueBuyCommand(?string $p, ?string $b)
    {
        $this->update("update tbl_mehrabad_projects_demands set buy_req_status=26
                                          where proj_code=? and buy_no=?", [$p, $b]);
        $this->insert('tbl_mehrabad_projects_buy_req_sign', ['proj_code', 'buy_no', 'trkh', 'user_id', 'host', 'descriptions'],
            [$p, $b, explode(' ', persianNow)[0], $_SESSION['tke'], IP, 'دستور خرید صادر شد']);
    }

    public function getproperpacking()
    {
        $result = $this->selectAll("select top 1 * from tbl_mehrabad_projects_demands where buy_packing_no is not null order by order_no_time desc ");
        $mret = "00001";
        if (count($result) > 0) {
            $mret = substr("000000" . (intval($result[0]['buy_packing_no']) + 1), -5);
        }
        return $mret;
    }

    public function setpackno(?string $packno, mixed $mdata)
    {
        $logmnj[0] = [$mdata[0]['id'], $mdata[0]['info']];

        $cnt=1;
        for ($i = 1; $i < count($mdata); $i++) {
            if ($mdata[$i]['info'] != $mdata[$i-1]['info']) {
                $logmnj[$cnt] = [$mdata[$i]['id'], $mdata[$i]['info']];
                $cnt++;
            }

        }

        for ($i = 0; $i < count($logmnj); $i++) {
            $tmp=explode("_",$logmnj[$i][1]);
            $p=$tmp[0];
            $b=$tmp[1];
            $this->update("update tbl_mehrabad_projects_demands set buy_req_status=28,buy_packing_no=?, buy_packing_date=?
                                     where proj_code=? and buy_no=?", [$packno,persianNow,$p,$b]);
            $this->insert('tbl_mehrabad_projects_buy_req_sign', ['proj_code', 'buy_no', 'trkh', 'user_id', 'host', 'descriptions'],
                [$p, $b, explode(' ', persianNow)[0], $_SESSION['tke'], IP, 'برای درخواست خرید '.$b." پکینگ ".$packno." صادر شد"]);
        }

    }
    public function getBuyOrderswithCommandTrade()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date,v_mehrabad_projects_buy.buy_req_type
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=0 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') and v_mehrabad_projects_buy.buy_req_status=26
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getBuyOrderPackingList()
    {
        return $this->selectAll("select buy_packing_no,min(buy_packing_date) as buy_packing_date from v_mehrabad_projects_buy where v_mehrabad_projects_buy.buy_req_status=28 and 
                                                                      (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                                                   group by buy_packing_no,buy_packing_date   ");
    }
    public function getinBuyOrdersTrade()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date,v_mehrabad_projects_buy.buy_req_type
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=0 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') and v_mehrabad_projects_buy.buy_req_status>=28
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getPackingData($pack,  $packd)
    {

        return $this->selectAll("select * from v_mehrabad_projects_buy where (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                      and buy_packing_no=? and buy_packing_date=?
                                     order by equip,spec",[ $pack,  $packd]);

        // and buy_packing_no=? and buy_packing_date=?
       // ,[$pack, $packd]
    }

    public function packingcompleted(?string $pack, mixed $packd)
    {
        $this->query("update tbl_mehrabad_projects_demands set buy_req_status=30 where (deleted_at is null or deleted_at='') 
                                      and buy_packing_no=? and buy_packing_date=?",[ $pack, $packd]);
        $result=$this->selectAll("select proj_code,buy_no from tbl_mehrabad_projects_demands where (deleted_at is null or deleted_at='') 
                                      and buy_packing_no=? and buy_packing_date=? group by proj_code,buy_no",[ $pack, $packd]);
        for($i=0;$i<count($result);$i++){
        $this->insert('tbl_mehrabad_projects_buy_req_sign', ['proj_code', 'buy_no', 'trkh', 'user_id', 'host', 'descriptions'],
            [$result[$i]['proj_code'],$result[$i]['buy_no'] , explode(' ', persianNow)[0],
                $_SESSION['tke'], IP, "عملیات خرید شماره درخواست ". $pack." برای پروژه ".$result[$i]['proj_code']." در پکینگ شماره ".$pack." پایان یافت"]);
        }
    }
}