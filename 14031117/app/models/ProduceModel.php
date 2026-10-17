<?php

namespace App\Models;

class ProduceModel extends Model
{
    public function getIncompleteProjProduce()
    {
        $tmp = $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_status<100 and tbl_mehrabad_projects.proj_status>=12 and 
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='') 
                                    order by tbl_mehrabad_projects.proj_start_date desc");
        for ($i = 0; $i < count($tmp); $i++) {
            $tmp00 = $this->selectAll("select sum(qty+spare+col1+col2+col3+col4+col5) as tedadKol from tbl_mehrabad_projects_dpl where prj_cod=?", [$tmp[$i]['proj_code']]);
            if (count($tmp00) > 0) {
                $tmp[$i]['tedadKol'] = $tmp00[0]['tedadKol'];

            } else
                $tmp[$i]['tedadKol'] = 1;
            $tmp00 = $this->selectAll("select sum(qty_demand) as tedadD from tbl_mehrabad_projects_demands where proj_code=?", [$tmp[$i]['proj_code']]);
            if (count($tmp00) > 0) {
                $tmp[$i]['tedadD'] = $tmp00[0]['tedadD'];

            } else
                $tmp[$i]['tedadD'] = 0;
            $tmp00 = $this->selectAll("select sum(demand_row_hvl_no) as tedadR from tbl_mehrabad_projects_drafts where buyordraft='draft' and proj_code=?", [$tmp[$i]['proj_code']]);
            if (count($tmp00) > 0) {
                $tmp[$i]['tedadR'] = $tmp00[0]['tedadR'];

            } else
                $tmp[$i]['tedadR'] = 0;
        }
        return $tmp;
    }

    public function getcompleteOrders()
    {
        return $this->selectAll("select distinct tbl_mehrabad_projects_demands.order_no_time,tbl_mehrabad_projects_demands.demand_no,
                tbl_mehrabad_projects_demands.expense_code1,tbl_mehrabad_projects_demands.completeddate
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from tbl_mehrabad_projects_demands inner join 
                                    tbl_mehrabad_projects
                                    on tbl_mehrabad_projects_demands.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects_demands.iscompleted=1 and 
                                          (tbl_mehrabad_projects_demands.deleted_at is null or tbl_mehrabad_projects_demands.deleted_at='') 
                                    
                                    order by tbl_mehrabad_projects_demands.order_no_time desc");
    }

    public function getIncompleteOrders()
    {
        return $this->selectAll("select distinct tbl_mehrabad_projects_demands.order_no_time,tbl_mehrabad_projects_demands.demand_no,tbl_mehrabad_projects_demands.expense_code1
              ,tbl_mehrabad_projects_demands.iscompleted
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from tbl_mehrabad_projects_demands inner join 
                                    tbl_mehrabad_projects
                                    on tbl_mehrabad_projects_demands.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects_demands.iscompleted=0 and 
                                          (tbl_mehrabad_projects_demands.deleted_at is null or tbl_mehrabad_projects_demands.deleted_at='') 
                                    
                                    order by tbl_mehrabad_projects_demands.order_no_time desc");
    }

    public function registerDemand($data, $dno, $ddate)
    {
        for ($i = 0; $i < count($data); $i++) {
            $this->insert('tbl_mehrabad_projects_demands', ['proj_code', 'mah_cod', 'equip', 'spec', 'manufact', 'qty_demand',
                'orderno', 'description', 'expense_code1', 'host', 'order_no_time', 'unit', 'document_no', 'document_date', 'applicator'],
                [$data[$i]['proj_code'], $data[$i]['mah_cod'], $data[$i]['equip'], $data[$i]['spec'],
                    $data[$i]['manufact'], $data[$i]['qty_demand'], $data[$i]['orderno'], $data[$i]['description'],
                    $data[$i]['expense_code1'], IP, $data[$i]['order_no_time'], $data[$i]['unit'], $dno, $ddate, $_SESSION['tke'] . ";" . IP . ";" . tr_num(jdate('Y/m/d H:i:s'))]);
        }
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(503, 504, 507)', 'درخواست کالای جدیدی برای پروژه با کد (' . $data[0]['proj_code'] . ') ایجاد شد.', 'supply');
        }
        $this->closeConnection();
    }

    public function getQtydeman_draft($prjCode)
    {
        return $this->selectAll('select proj_code,mah_cod,equip,spec,manufact,sum(qty_demand) as qty_demand, sum(qty_draft) as qty_draft , 0 as search
                                     from tbl_mehrabad_projects_demands where 
                                     proj_code=? group by proj_code,mah_cod,equip,spec,manufact', [$prjCode]);

    }

    public function demandDetails($prjCode, $orderTime)
    {
        return $this->selectAll("select  tbl_mehrabad_projects_demands.*,tbl_mehrabad_projects_demands.expense_code1,
        tbl_mehrabad_projects_demands.id as idd,tbl_mehrabad_projects_demands.proj_code as prjCod
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from tbl_mehrabad_projects_demands inner join 
                                    tbl_mehrabad_projects
                                    on tbl_mehrabad_projects_demands.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where  tbl_mehrabad_projects_demands.proj_code=? and 
                                          tbl_mehrabad_projects_demands.order_no_time=? and
                                          (tbl_mehrabad_projects_demands.deleted_at is null or tbl_mehrabad_projects_demands.deleted_at='') 
                                    
                                    order by tbl_mehrabad_projects_demands.id", [$prjCode, $orderTime]);
    }

    public function getallDraft($p, $d)
    {
        return $this->selectAll("select distinct proj_code,draft_no, left(date,10) as date,user_id  
                                from tbl_mehrabad_projects_drafts where buyordraft=N'draft' and proj_code=? and deman_no=? order by date ", [$p, $d]);
    }

    public function getallBought($p, $d)
    {
        return $this->selectAll("select distinct proj_code,draft_no, left(date,10) as date,user_id  
                                from tbl_mehrabad_projects_drafts where buyordraft=N'buy' and proj_code=? and deman_no=? order by date ", [$p, $d]);
    }

    public function getIncompleteBuyOrders()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=0 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getCompleteBuyOrders()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=1 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getBuyOrders($p, $b)
    {
//        print_r("select v_mehrabad_projects_buy.*,left(v_mehrabad_projects_buy.date,10) as date10
//                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
//                                   from v_mehrabad_projects_buy inner join
//                                    tbl_mehrabad_projects
//                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on
//                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on
//                                        tbl_mehrabad_projects.proj_consultant=a2.cod
//                                    where v_mehrabad_projects_buy.proj_code='$p' and
//                                        v_mehrabad_projects_buy.draft_no='$b' and
//                                        v_mehrabad_projects_buy.buyordraft=N'buy' and
//                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='')
//
//                                   order by v_mehrabad_projects_buy.id");
        return $this->selectAll("select v_mehrabad_projects_buy.*,left(v_mehrabad_projects_buy.date,10) as date10
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.proj_code='$p' and
                                        v_mehrabad_projects_buy.draft_no='$b' and
                                        v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                   order by v_mehrabad_projects_buy.id");
    }

    public function getIncompleteBuyOrdersTrade()
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
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') and v_mehrabad_projects_buy.buy_req_status>0
                                   and v_mehrabad_projects_buy.buy_req_status<12
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getCompleteBuyOrdersTrade()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date,v_mehrabad_projects_buy.buy_req_type
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=1 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getIncompleteBuyOrdersTransact()
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
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') and v_mehrabad_projects_buy.buy_req_status>10
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getCompleteBuyOrdersTransact()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date,v_mehrabad_projects_buy.buy_req_type
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=1 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getIncompleteBuyOrdersManager()
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
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') and v_mehrabad_projects_buy.buy_req_status>5
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getCompleteBuyOrdersManager()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date,v_mehrabad_projects_buy.buy_req_type
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=1 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getIncompleteBuyOrdersDirectors()
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
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') and v_mehrabad_projects_buy.buy_req_status>10
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getCompleteBuyOrdersDirectors()
    {
        return $this->selectAll("select distinct v_mehrabad_projects_buy.proj_code,v_mehrabad_projects_buy.demand_no,v_mehrabad_projects_buy.order_no_time,
                v_mehrabad_projects_buy.expense_code1,v_mehrabad_projects_buy.buy_no,left(v_mehrabad_projects_buy.date,10) as date,v_mehrabad_projects_buy.buy_req_type
                ,tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
                                   from v_mehrabad_projects_buy inner join 
                                    tbl_mehrabad_projects
                                    on v_mehrabad_projects_buy.proj_code=tbl_mehrabad_projects.proj_code left join tbl_mehrabad_motaqazian as a1 on 
                                        tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where v_mehrabad_projects_buy.bought_iscomplete=1 and v_mehrabad_projects_buy.buyordraft=N'buy' and 
                                          (v_mehrabad_projects_buy.deleted_at is null or v_mehrabad_projects_buy.deleted_at='') 
                                  
                                    order by left(v_mehrabad_projects_buy.date,10) desc");
    }

    public function getTradeLevels()
    {
        return $this->selectAll("select * from tbl_mehrabad_projects_trade_levels order by id");
    }

    public function getSigns($prjCode, $buyNo)
    {
        return $this->selectAll("select * from tbl_mehrabad_projects_buy_req_sign where proj_code=? and buy_no=? order by trkh desc,id desc", [$prjCode, $buyNo]);
    }

    public function getbuyDocs($prjCode, $buyNo)
    {
        return $this->selectAll("select * from tbl_mehrabad_projects_buy_req_docs where proj_code=? and buy_no=? order by trkh,id", [$prjCode, $buyNo]);
    }


}