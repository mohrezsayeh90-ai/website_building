<?php

namespace App\Models;

class StoreModel extends Model
{
    public function sabtDemanNo($p1, $p2)
    {
        $this->update("update tbl_mehrabad_projects_demands set demand_no=? where order_no_time=?", [$p2, $p1]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(504, 507)',  'درخواست کالا با شماره (' . $p2. ') ایجاد شد.', 'supply');
        }
    }

    public function draftAll($prjCode, $demandNo, $draftNo)
    {
        $getallinCom = $this->selectAll("select * from tbl_mehrabad_projects_demands where qty_draft<qty_demand and proj_code=? and demand_no=?  ", [$prjCode, $demandNo]);
        $this->update("update tbl_mehrabad_projects_demands 
    set qty_draft=qty_demand ,iscompleted=1,confirmer=? where proj_code=? and demand_no=?", [$_SESSION['tke'].";".IP.";".tr_num(jdate('Y/m/d H:i:s')), $prjCode, $demandNo]);
        for ($i = 0; $i < count($getallinCom); $i++) {
            $this->insert('tbl_mehrabad_projects_drafts', ['proj_code', 'deman_no', 'draft_no', 'date', 'host', 'user_id', 'demand_row_id', 'demand_row_hvl_no'],
                [$prjCode, $demandNo, $draftNo, persianNow, IP, $_SESSION['tke'], $getallinCom[$i]['id'], $getallinCom[$i]['qty_demand'] - $getallinCom[$i]['qty_draft']]);
        }
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(503, 504, 507)',  'حواله ی شماره ی ('.$draftNo.') برای درخواست کالا با شماره (' . $demandNo. ') ایجاد شد.', 'supply');
        }
    }

    public function buyAll($prjCode, $demandNo, $buyNo)
    {
        $getallinCom = $this->selectAll("select * from tbl_mehrabad_projects_demands where qty_buy<qty_demand-qty_draft and proj_code=? and demand_no=?  ", [$prjCode, $demandNo]);
        $this->update("update tbl_mehrabad_projects_demands set qty_buy = qty_demand - qty_draft,buy_no=?  where proj_code=? and demand_no=?", [$buyNo,$prjCode, $demandNo]);
        for ($i = 0; $i < count($getallinCom); $i++) {
            $this->insert('tbl_mehrabad_projects_drafts', ['proj_code', 'deman_no', 'draft_no', 'date', 'host', 'user_id', 'demand_row_id', 'demand_row_hvl_no','buyordraft'],
                [$prjCode, $demandNo, $buyNo, persianNow, IP, $_SESSION['tke'], $getallinCom[$i]['id'], $getallinCom[$i]['qty_demand']-$getallinCom[$i]['qty_draft'],'buy']);
        }
    }

    public function registerDraft($prjCode, $demandNo, $draftNo, $id, $No)
    {
        $this->update("update tbl_mehrabad_projects_demands set confirmer=?,qty_draft=qty_draft+? 
                                     where id=?", [$_SESSION['tke'].";".IP.";".tr_num(jdate('Y/m/d H:i:s')),$No, $id]);
        $remained = $this->selectAll("select * from tbl_mehrabad_projects_demands where qty_draft<qty_demand and proj_code=? and demand_no=?  ", [$prjCode, $demandNo]);
        if (count($remained) == 0) {
            $this->update("update tbl_mehrabad_projects_demands set qty_draft=qty_demand ,iscompleted=1,
                                     confirmer=? where proj_code=? and demand_no=?", [$_SESSION['tke'].";".IP.";".tr_num(jdate('Y/m/d H:i:s')), $prjCode, $demandNo]);
        }
        $this->insert('tbl_mehrabad_projects_drafts', ['proj_code', 'deman_no', 'draft_no', 'date', 'host', 'user_id', 'demand_row_id', 'demand_row_hvl_no'],
            [$prjCode, $demandNo, $draftNo, persianNow, IP, $_SESSION['tke'], $id, $No]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(503, 504, 507)',  'حواله ی شماره ی ('.$draftNo.') برای درخواست کالا با شماره (' . $demandNo. ') ایجاد شد.', 'supply');
        }
        $this->closeConnection();
    }
    public function registerBuy($prjCode, $demandNo, $buyNo, $id, $No)
    {
        $this->update("update tbl_mehrabad_projects_demands set qty_buy=qty_buy+?,buy_no=? where id=?", [$No,$buyNo, $id]);
//        $remained = $this->selectAll("select * from tbl_mehrabad_projects_demands where qty_draft<qty_demand and proj_code=? and demand_no=?  ", [$prjCode, $demandNo]);
//        if (count($remained) == 0) {
//            $this->update("update tbl_mehrabad_projects_demands set qty_draft=qty_demand ,iscompleted=1 where proj_code=? and demand_no=?", [$prjCode, $demandNo]);
//        }
        $this->insert('tbl_mehrabad_projects_drafts', ['proj_code', 'deman_no', 'draft_no', 'date', 'host', 'user_id', 'demand_row_id', 'demand_row_hvl_no','buyordraft'],
            [$prjCode, $demandNo, $buyNo, persianNow, IP, $_SESSION['tke'], $id, $No,'buy']);
        $this->closeConnection();
    }

    public function setreqDate( $id,  $dvalue)
    {
        $this->update("update tbl_mehrabad_projects_demands set buy_req_trkh=? where id=?", [ $dvalue, $id]);
    }
    public function setreqDescriptions( $id,  $dvalue)
    {
        $this->update("update tbl_mehrabad_projects_demands set buy_req_descriptions=? where id=?", [ $dvalue, $id]);
    }

    public function signBuyReq( $p, $b)
    {
        $this->update("update tbl_mehrabad_projects_demands set buy_req_status=1 where proj_code=? and buy_no=? and (buy_req_status is null or buy_req_status=0)", [ $p, $b]);
        $this->insert('tbl_mehrabad_projects_buy_req_sign',['proj_code','buy_no','trkh','user_id','host'],
            [$p,$b,explode(' ',persianNow)[0],$_SESSION['tke'],IP]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(505, 504, 507)',  'درخواست خرید با شماره ی ('.$b.') برای برای پروژه با کد (' . $p. ') ایجاد شد.', 'supply');
        }
        $this->closeConnection();
        $this->closeConnection();

    }

    public function closeDemand($p,$d,$desc)
    {
        $b='';
        $bb=$this->selectAll("select top 1 buy_no from tbl_mehrabad_projects_demands where  proj_code=? and demand_no=? and buy_no is not null", [ $p, $d]);
        try {
          if(count($bb)>0)  $b=$bb[0]['buy_no'];
        }
        catch (Exception $e)
        {

        }
        $this->update("update tbl_mehrabad_projects_demands set completeddate=?,iscompleted=1,description=? 
                                     where proj_code=? and demand_no=?", [tr_num(jdate('Y/m/d')),$desc, $p, $d]);
        $this->insert('tbl_mehrabad_projects_buy_req_sign',['proj_code','buy_no','trkh','user_id','host','descriptions'],
            [$p,$b,explode(' ',persianNow)[0],$_SESSION['tke'],IP,"به دلیل «" .$desc."» و با هماهنگی مدیران مربوطه این درخواست بسته شد."]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(504, 505, 507)',  'درخواست خرید با شماره (' . $b. ') بسته شد.', 'supply');
        }
        $this->closeConnection();
    }

    public function getproperdemandno(?string $demandNo)
    {
        $year=tr_num(jdate('Y'));
        $yearstart=jalali_to_gregorian($year,1,1);

        $strton=strtotime($yearstart[2].".".$yearstart[1].".".$yearstart[0]);
        $result=$this->selectAll("select top 1 * from tbl_mehrabad_projects_demands where (order_no_time > ? ) and 
                                                        demand_no is not null order by cast(demand_no as numeric) desc ",[$strton]);
        $mret="00001";
        if(count($result)>0)
        {
            $mret=substr("000000".(intval($result[0]['demand_no'])+1),-5);
        }
        //return $yearstart[2].".".$yearstart[1].".".$yearstart[0];
        return $mret;
    }

    public function getproperdraftno()
    {
        $result=$this->selectAll("select top 1 * from tbl_mehrabad_projects_drafts where buyordraft='draft' order by date desc ");
        $mret="00001";
        if(count($result)>0)
        {
            $mret=substr("000000".(intval($result[0]['draft_no'])+1),-5);
        }
        return $mret;
    }

    public function getproperbuyno()
    {
        $result=$this->selectAll("select top 1 * from tbl_mehrabad_projects_drafts where buyordraft='buy' order by date desc ");
        $mret="00001";
        if(count($result)>0)
        {
            $mret=substr("000000".(intval($result[0]['draft_no'])+1),-5);
        }
        return $mret;
    }
}