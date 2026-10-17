<?php

namespace App\Models;

class PrjManModel extends Model
{
    public function getIncompleteProj($stat=0)
    {
      if($stat==0)  return $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_status<100 and 
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='') 
                                    order by tbl_mehrabad_projects.proj_start_date desc");
      else
          return $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_status<100 and tbl_mehrabad_projects.proj_status>=$stat and
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='') 
                                    order by tbl_mehrabad_projects.proj_start_date desc");
    }
    public function getcompleteProj()
    {
       return $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_status>=100 and 
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='') 
                                    order by tbl_mehrabad_projects.proj_start_date desc");

    }

    public function getProjData($projC)
    {
        return $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_code='$projC' and tbl_mehrabad_projects.proj_status<=100 and 
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='') 
                                    order by tbl_mehrabad_projects.proj_start_date desc");
    }

    public function getOtherProjData($projC)
    {
        // print_r($projC);
        $first1 = $this->selectAll("select * from tbl_mehrabad_projects_technical_items where proj_code=?", [$projC]);
        $second1 = $this->selectAll("select * from tbl_mehrabad_projects_financial_items where proj_code=?", [$projC]);
        $third1 = $this->selectAll("select * from tbl_mehrabad_projects_risk where proj_code=?", [$projC]);
        $dat4 = $this->selectAll("select * from tbl_mehrabad_projects_financial_info where proj_code=?", [$projC]);
        $dat5 = $this->selectAll("select * from tbl_mehrabad_projects_additioanl_info where proj_code=?", [$projC]);
        $dat6 = $this->selectOne("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? and main_form_process_step_id='p2000'", [$projC]);
//print_r($first1);
        return array($first1, $second1, $third1, $dat4, $dat5,$dat6);
    }

    public function getTenders()
    {
        return $this->selectAll("select  tbl_mehrabad_monaqese.* , tbl_mehrabad_motaqazian.nam from tbl_mehrabad_monaqese left join tbl_mehrabad_motaqazian
                                        on tbl_mehrabad_monaqese.customercod=tbl_mehrabad_motaqazian.cod  where 
                                        tbl_mehrabad_monaqese.status=100 and (tbl_mehrabad_monaqese.related_project_code 
                                            is null or tbl_mehrabad_monaqese.related_project_code='')");
    }

    public function extractTenders($prjCode, $tenderCode)
    {
        $this->query("update tbl_mehrabad_monaqese set related_project_code=? where code=?", [$prjCode, $tenderCode]);
        $this->query("update tbl_mehrabad_projects set proj_status=1 , proj_tender_code_default=? where proj_code=?", [$tenderCode, $prjCode]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'مناقصه با کد ('.$tenderCode.') به پروژه با کد (' . $prjCode . ') تخصیص یافت.', 'project');
        }
        $this->query("delete from tbl_mehrabad_projects_epl where prj_cod=?", [$prjCode]);
        $this->query("delete from tbl_mehrabad_projects_dpl where prj_cod=?", [$prjCode]);
        $allEpn = $this->selectAll("select '{$prjCode}' as prj,mah_cod,equip,type,manufact,qty,price_i,price_r,'system' as host,row_type,real_foreign
                             from tbl_mehrabad_monaqese_epl
                             where mon_cod=?  order by id", [$tenderCode]);
        // print_r($allEpn);
        for ($i = 0; $i < count($allEpn); $i++) {
            $data = [];
            $datadpl=[];
            $data[] = $allEpn[$i]['prj'];
            $data[] = $allEpn[$i]['mah_cod'];
            $data[] = $allEpn[$i]['equip'];
            $data[] = $allEpn[$i]['type'];
            $data[] = $allEpn[$i]['manufact'];
            $data[] = $allEpn[$i]['qty'];
            $data[] = $allEpn[$i]['price_i'];
            $data[] = $allEpn[$i]['price_r'];
            $data[] = $allEpn[$i]['host'];
            $data[] = $allEpn[$i]['row_type'];
            $data[] = $allEpn[$i]['real_foreign'];
            $dataDpl=$data;
            $dataDpl[] = $allEpn[$i]['prj'];
            $dataDpl[] = tr_num(jdate('Y/m/d'));
            $this->insert('tbl_mehrabad_projects_epl', ['prj_cod', 'mah_cod', 'equip', 'type', 'manufact', 'qty', 'price_i', 'price_r', 'host', 'row_type','real_foreign'],
                $data);
            $this->insert('tbl_mehrabad_projects_dpl', ['prj_cod', 'mah_cod', 'equip', 'type', 'manufact', 'qty', 'price_i',
                'price_r', 'host', 'row_type','real_foreign','document_no','document_date'],
                $dataDpl);
        }
        $materials = $this->selectAll("select  tbl_mehrabad_monaqese_mahsoul.* , tbl_mehrabad_mahsoul.* 
         from tbl_mehrabad_monaqese_mahsoul inner join tbl_mehrabad_mahsoul on tbl_mehrabad_mahsoul.code=tbl_mehrabad_monaqese_mahsoul.mah_cod
         where tbl_mehrabad_monaqese_mahsoul.mon_cod=?", [$tenderCode]);
        $maxthserialno=1;
        $tmp00=$this->selectAll("select max(cast(proj_item_order_no as numeric)) + 1 as serialno from tbl_mehrabad_projects_technical_items");
        if(count($tmp00)>0)$maxthserialno=$tmp00[0]['serialno']==null?1:$tmp00[0]['serialno'];
        $this->query("delete from tbl_mehrabad_projects_technical_info where proj_code=?", [$prjCode]);
        $this->query("delete from tbl_mehrabad_projects_technical_items where proj_code=?", [$prjCode]);
        $this->insert('tbl_mehrabad_projects_technical_info', ['proj_code', 'host'],
            [$prjCode, IP]);
        for ($i = 0; $i < count($materials); $i++) {
            $this->insert('tbl_mehrabad_projects_technical_items', ['proj_code', 'proj_item_description', 'proj_item_number',
                'proj_item_panel_type', 'host', 'proj_item_mah_cod','proj_item_order_no'],
                [$prjCode, $materials[$i]['name'] . ' ' . $materials[$i]['voltage'] . ' ' . $materials[$i]['crnt'],
                    $materials[$i]['tedad'], $materials[$i]['type1'], IP, $materials[$i]['code'],substr('000000'.($maxthserialno+$i),-6)]);
        }
        $this->query("delete from tbl_mehrabad_projects_financial_info where proj_code=?", [$prjCode]);
        $this->query("delete from tbl_mehrabad_projects_financial_items where proj_code=?", [$prjCode]);
        $this->insert('tbl_mehrabad_projects_financial_info', ['proj_code', 'host'],
            [$prjCode, IP]);
        for ($i = 0; $i < count($materials); $i++) {
            $this->insert('tbl_mehrabad_projects_financial_items', ['proj_code', 'proj_f_item_description', 'proj_f_item_numbers', 'host', 'proj_f_item_mah_cod'],
                [$prjCode, $materials[$i]['name'] . ' ' . $materials[$i]['voltage'] . ' ' . $materials[$i]['crnt'],
                    $materials[$i]['tedad'], IP, $materials[$i]['code']]);
        }
        //p1000
        $bpmData = $this->getOneRowBPM($prjCode,'p1000');
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1 where proj_code=? and process_step_id=?", [$prjCode, 'p1000']);
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p1000',$bpmData['owners'],'prjman','cloud-upload','استخراج داده از مناقصه '.$tenderCode,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
    }

    public function getOneRowBPM($prjCode, $step_id)
    {
        return $this->selectOne("select * from tbl_mehrabad_projects_bpm_info where proj_code=? and process_step_id=?", [$prjCode, $step_id]);
    }

    public function selectEPL($prjCode)
    {
        $projData = $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_code='$prjCode' and tbl_mehrabad_projects.proj_status<=100 and 
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='')")[0];
        $materials = [];
        $tmp = $this->selectAll("select mah_cod,max(id) from  tbl_mehrabad_projects_epl where prj_cod=?  group by mah_cod order by max(id)", [$prjCode]);
        print_r($tmp);
        for ($i = 0; $i < count($tmp); $i++) {
            $materials[] = $this->selectAll("select   tbl_mehrabad_mahsoul.* , tbl_mehrabad_projects_technical_items.proj_item_number as tedad
         from tbl_mehrabad_mahsoul inner join tbl_mehrabad_projects_technical_items on code=proj_item_mah_cod 
         where code=?", [$tmp[$i]['mah_cod']])[0];
        }
//        $materials=$this->selectAll("select  tbl_mehrabad_monaqese_mahsoul.* , tbl_mehrabad_mahsoul.*
//         from tbl_mehrabad_monaqese_mahsoul inner join tbl_mehrabad_mahsoul on tbl_mehrabad_mahsoul.code=tbl_mehrabad_monaqese_mahsoul.mah_cod
//         where tbl_mehrabad_monaqese_mahsoul.mon_cod=?",[$prjCode]);
        $searchall=$this->selectAll("select replace(replace(description,'\n',' '),'\r','') as description,replace(replace(type,'\n',' '),'\r','') as type,manufacturer from tbl_mehrabad_search ");
        $searchdes = $this->selectAll("select replace(replace(description,'\n',' '),'\r','') as description from tbl_mehrabad_search group by description");
        $searchdtyp = $this->selectAll("select replace(replace(type,'\n',''),'\r','') as type from tbl_mehrabad_search group by type");
        $searchdmanufact = $this->selectAll("select manufacturer from tbl_mehrabad_search group by manufacturer");
        ///
        for($i=0;$i<count($searchdtyp);$i++)
        {
            $searchdtyp[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['type']==$searchdtyp[$i]['type'] && !str_contains($searchdtyp[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchdtyp[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        for($i=0;$i<count($searchdmanufact);$i++)
        {
            $searchdmanufact[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['manufacturer']==$searchdmanufact[$i]['manufacturer'] && !str_contains($searchdmanufact[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchdmanufact[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        ///
        $searchall=$this->selectAll("select replace(replace(description,'\n',' '),'\r','') as description,replace(replace(type,'\n',' '),'\r','') as type,manufacturer from tbl_mehrabad_grp_search");
        $searchgrpdes = $this->selectAll("select replace(replace(description,'\n',' '),'\r','') as description from tbl_mehrabad_grp_search group by description");
        $searchgrptyp = $this->selectAll("select replace(replace(type,'\n',' '),'\r','') as type from tbl_mehrabad_grp_search group by type");
        $searchgrpmanufact = $this->selectAll("select manufacturer from tbl_mehrabad_grp_search group by manufacturer");
        ///
        for($i=0;$i<count($searchgrptyp);$i++)
        {
            $searchgrptyp[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['type']==$searchgrptyp[$i]['type'] && !str_contains($searchgrptyp[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchgrptyp[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        for($i=0;$i<count($searchgrpmanufact);$i++)
        {
            $searchgrpmanufact[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['manufacturer']==$searchgrpmanufact[$i]['manufacturer'] && !str_contains($searchgrpmanufact[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchgrpmanufact[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        ///


        $epl = $this->selectAll("select * from tbl_mehrabad_projects_epl where prj_cod=? order by id", [$prjCode]);
        $dat6 = $this->selectOne("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? and main_form_process_step_id='p6000'", [$prjCode]);
        return array($projData, $materials, $searchdes, $searchgrpdes, $searchdtyp, $searchgrptyp, $searchdmanufact, $searchgrpmanufact, $epl,$dat6);
    }

    public function selectDPL($prjCode)
    {
        $projData = $this->selectAll("select tbl_mehrabad_projects.*,a1.*,a2.nam as conSultNam,a2.logo as conSultLogo,a2.ename as conSultEname,a2.email as conSultEmali
    from tbl_mehrabad_projects inner join tbl_mehrabad_motaqazian as a1
                                    on tbl_mehrabad_projects.proj_customer=a1.cod left join tbl_mehrabad_motaqazian as a2 on 
                                        tbl_mehrabad_projects.proj_consultant=a2.cod
                                    where tbl_mehrabad_projects.proj_code='$prjCode' and tbl_mehrabad_projects.proj_status<=100 and 
                                          (tbl_mehrabad_projects.deleted_at is null or tbl_mehrabad_projects.deleted_at='')")[0];
        $materials = [];
        $tmp = $this->selectAll("select mah_cod,max(id) from tbl_mehrabad_projects_epl where prj_cod=? group by mah_cod order by max(id)", [$prjCode]);
        for ($i = 0; $i < count($tmp); $i++) {
            $materials[] = $this->selectAll("select   tbl_mehrabad_mahsoul.* , tbl_mehrabad_projects_technical_items.proj_item_number as tedad
         from tbl_mehrabad_mahsoul inner join tbl_mehrabad_projects_technical_items on code=proj_item_mah_cod 
         where code=?", [$tmp[$i]['mah_cod']])[0];
        }
//        $materials=$this->selectAll("select  tbl_mehrabad_monaqese_mahsoul.* , tbl_mehrabad_mahsoul.*
//         from tbl_mehrabad_monaqese_mahsoul inner join tbl_mehrabad_mahsoul on tbl_mehrabad_mahsoul.code=tbl_mehrabad_monaqese_mahsoul.mah_cod
//         where tbl_mehrabad_monaqese_mahsoul.mon_cod=?",[$prjCode]);
        $searchall=$this->selectAll("select replace(replace(description,'\\n',' '),'\\r',' ') as description,replace(replace(type,'\\n',' '),'\\r',' ') as type,manufacturer from tbl_mehrabad_search ");
        $searchdes = $this->selectAll("select replace(replace(description,'\\n',' '),'\\r',' ') as description from tbl_mehrabad_search group by description");
        $searchdtyp = $this->selectAll("select replace(replace(type,'\\n',' '),'\\r',' ') as type from tbl_mehrabad_search group by type");
        $searchdmanufact = $this->selectAll("select manufacturer from tbl_mehrabad_search group by manufacturer");
        ///
        for($i=0;$i<count($searchdtyp);$i++)
        {
            $searchdtyp[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['type']==$searchdtyp[$i]['type'] && !str_contains($searchdtyp[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchdtyp[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        for($i=0;$i<count($searchdmanufact);$i++)
        {
            $searchdmanufact[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['manufacturer']==$searchdmanufact[$i]['manufacturer'] && !str_contains($searchdmanufact[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchdmanufact[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        ///
        $searchall=$this->selectAll("select replace(replace(description,'\\n',' '),'\\r',' ') as description,replace(replace(type,'\\n',' '),'\\r',' ') as type,manufacturer from tbl_mehrabad_grp_search");
        $searchgrpdes = $this->selectAll("select replace(replace(description,'\\n',' '),'\\r',' ') as description from tbl_mehrabad_grp_search group by description");
        $searchgrptyp = $this->selectAll("select replace(replace(type,'\\n',' '),'\\r',' ') as type from tbl_mehrabad_grp_search group by type");
        $searchgrpmanufact = $this->selectAll("select manufacturer from tbl_mehrabad_grp_search group by manufacturer");
        ///
        for($i=0;$i<count($searchgrptyp);$i++)
        {
            $searchgrptyp[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['type']==$searchgrptyp[$i]['type'] && !str_contains($searchgrptyp[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchgrptyp[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        for($i=0;$i<count($searchgrpmanufact);$i++)
        {
            $searchgrpmanufact[$i]['clue']='';
            for($j=0;$j<count($searchall);$j++)
            {
                if($searchall[$j]['manufacturer']==$searchgrpmanufact[$i]['manufacturer'] && !str_contains($searchgrpmanufact[$i]['clue'],";".$searchall[$j]['description'].";"))
                    $searchgrpmanufact[$i]['clue'].=";".$searchall[$j]['description'].";";
            }
        }
        ///


        $dpl = $this->selectAll("select * from tbl_mehrabad_projects_dpl where prj_cod=? order by id", [$prjCode]);
        $dat6 = $this->selectOne("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? and main_form_process_step_id='p8000'", [$prjCode]);
        $cnt=0;
        $dpladdedcol[$cnt]=[$dpl[0]['mah_cod'],0];
        if($dpl[0]['col1name']!="")$dpladdedcol[0][1]+=1;
        if($dpl[0]['col2name']!="")$dpladdedcol[0][1]+=1;
        if($dpl[0]['col3name']!="")$dpladdedcol[0][1]+=1;
        if($dpl[0]['col4name']!="")$dpladdedcol[0][1]+=1;
        if($dpl[0]['col5name']!="")$dpladdedcol[0][1]+=1;
        for($i=1;$i<count($dpl);$i++)
        {
            if($dpl[$i]['mah_cod']!=$dpl[$i-1]['mah_cod'])
            {
                $cnt++;
                $dpladdedcol[$cnt]=[$dpl[$i]['mah_cod'],0];
                if($dpl[$i]['col1name']!="")$dpladdedcol[$cnt][1]+=1;
                if($dpl[$i]['col2name']!="")$dpladdedcol[$cnt][1]+=1;
                if($dpl[$i]['col3name']!="")$dpladdedcol[$cnt][1]+=1;
                if($dpl[$i]['col4name']!="")$dpladdedcol[$cnt][1]+=1;
                if($dpl[$i]['col5name']!="")$dpladdedcol[$cnt][1]+=1;
            }
        }
        return array($projData, $materials, $searchdes, $searchgrpdes, $searchdtyp, $searchgrptyp, $searchdmanufact, $searchgrpmanufact, $dpl,$dat6,$dpladdedcol);
    }

    public function saveAllSheets($tc, $ad)
    {
        $this->query("delete from tbl_mehrabad_projects_epl where prj_cod=?", [$tc]);
        for ($i = 0; $i < count($ad); $i++) {
            if($ad[$i][7]=="")
            {
                $ad[$i][7]="Normal";
                // print_r($ad);
            }
            if($ad[$i][7]!='Foreign Accessories')
                $this->insert('tbl_mehrabad_projects_epl',['mon_cod','mah_cod','equip','type','manufact','qty','price_i','price_r','row_type'],
                    [$tc,$ad[$i][0],$ad[$i][1],$ad[$i][2],$ad[$i][3],$ad[$i][4],$ad[$i][5],$ad[$i][6],$ad[$i][7]]);
            else
                $this->insert('tbl_mehrabad_projects_epl',['mon_cod','mah_cod','equip','type','manufact','qty','price_i','price_r','row_type','real_foreign'],
                    [$tc,$ad[$i][0],$ad[$i][1],$ad[$i][2],$ad[$i][3],$ad[$i][4],$ad[$i][5],$ad[$i][6],$ad[$i][7],$ad[$i][4]*$ad[$i][5]]);
//            $this->insert('tbl_mehrabad_projects_epl', ['prj_cod', 'mah_cod', 'equip', 'type', 'manufact', 'qty', 'price_i', 'price_r', 'row_type'],
//                [$tc, $ad[$i][0], $ad[$i][1], $ad[$i][2], $ad[$i][3], $ad[$i][4], $ad[$i][5], $ad[$i][6], $ad[$i][7]]);
        }
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'فرم EPL برای پروژه با کد (' . $tc . ') ایجاد شد.', 'project');
        }
    }

    public function saveAllSheetsDPL($tc, $ad)
    {
$tmp = $this->selectAll("select * from tbl_mehrabad_projects where proj_code=?",[$tc]);
        $this->query("delete from tbl_mehrabad_projects_DPL where prj_cod=?", [$tc]);
        for ($i = 0; $i < count($ad); $i++) {
            if($ad[$i][10]=="")
            {
                $ad[$i][10]="Normal";
                // print_r($ad);
            }
            $this->insert('tbl_mehrabad_projects_dpl', ['prj_cod', 'mah_cod', 'equip', 'type', 'manufact', 'unit', 'qty',
                'spare', 'totalqty', 'orderno', 'description', 'row_type','col1','col2','col3','col4','col5','col1name','col2name','col3name',
                'col4name','col5name','document_no','document_date'],
                [$tc, $ad[$i][0], $ad[$i][1], $ad[$i][2], $ad[$i][3], $ad[$i][4], $ad[$i][5], $ad[$i][6],
                    $ad[$i][7], $ad[$i][8], $ad[$i][9], $ad[$i][10],
                    $ad[$i][11], $ad[$i][12], $ad[$i][13], $ad[$i][14], $ad[$i][15],
                    $ad[$i][16], $ad[$i][17], $ad[$i][18], $ad[$i][19], $ad[$i][20],$tmp[0]['document_no'],$tmp[0]['document_date']]);
        }
//        if ($_SESSION['tkeNn']) {
//            $bdg = new Badge();
//            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'فرم DPL برای پروژه با کد (' . $tc . ') ایجاد شد.', 'project');
//        }
    }

    public function getAllProd($tenderCode)
    {
        $mname = $this->selectAll("select * from tbl_mehrabad_projects_technical_items where proj_code=?", [$tenderCode]);
        return $mname;
    }

    public function getProduct($prjCod)
    {
        return $this->selectAll("select * from tbl_mehrabad_mahsoul where code not in (select proj_item_mah_cod from tbl_mehrabad_projects_technical_items
                                 where   proj_code=?)", [$prjCod]);
    }

    public function addProduct($prjCode, $prdCode, $prdNumber)
    {

        $prdInfo = $this->selectOne("select * from tbl_mehrabad_mahsoul where code=?", [$prdCode]);
        $mahjoz = $this->selectAll("select description from tbl_mehrabad_joziat_mahsoul where mahsoul_cod=? order by id", [$prdCode]);
        for ($j = 0; $j < count($mahjoz); $j++) {
            $this->insert('tbl_mehrabad_projects_epl', ['prj_cod', 'mah_cod', 'equip', 'qty', 'host'],
                [$prjCode, $prdCode, $mahjoz[$j]['description'], $prdNumber, IP]);
        }
        $this->insert('tbl_mehrabad_projects_technical_items', ['proj_code', 'proj_item_description', 'proj_item_number',
            'proj_item_panel_type', 'host', 'proj_item_mah_cod'],
            [$prjCode, $prdInfo['name'] . ' ' . $prdInfo['voltage'] . ' ' . $prdInfo['crnt'],
                $prdNumber, $prdInfo['type1'], IP, $prdCode]);
        $this->insert('tbl_mehrabad_projects_financial_items', ['proj_code', 'proj_f_item_description', 'proj_f_item_numbers',
            'host', 'proj_f_item_mah_cod'],
            [$prjCode, $prdInfo['name'] . ' ' . $prdInfo['voltage'] . ' ' . $prdInfo['crnt'],
                $prdNumber, IP, $prdCode]);

        $this->closeConnection();
    }

    public function deletePrevious($prjCode)
    {
        $this->query("delete from tbl_mehrabad_projects_technical_items where proj_code=?", [$prjCode]);
        $this->query("delete from tbl_mehrabad_projects_financial_items where proj_code=?", [$prjCode]);
        $this->query("delete from tbl_mehrabad_projects_risk where proj_code=?", [$prjCode]);
    }

    public function insertTechItems($data)
    {
        $this->insert('tbl_mehrabad_projects_technical_items', ['proj_code', 'proj_item_mah_cod', 'proj_item_description', 'proj_item_number', 'proj_item_panel_type',
            'proj_item_ptFix', 'proj_item_color', 'proj_item_access_type', 'proj_item_cover', 'proj_item_protection_grade',
            'proj_item_breaking_power', 'proj_item_order_no', 'proj_item_serial_no', 'host'],
            $data);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'اطلاعات فنی پروژه با کد (' . $data[0] . ') ایجاد شد.', 'project');
            $this->closeConnection();
        }
    }

    public function insertFinItems($data)
    {
        $this->insert('tbl_mehrabad_projects_financial_items', ['proj_code', 'proj_f_item_mah_cod', 'proj_f_item_description',
            'proj_f_item_numbers', 'proj_f_item_cost_rial', 'proj_f_item_cost_euro', 'host'],
            $data);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'اطلاعات مالی پروژه با کد (' . $data[0] . ') ایجاد شد.', 'project');
        }
        $this->closeConnection();
    }

    public function insertRiskItems($data)
    {
        $this->insert('tbl_mehrabad_projects_risk', ['proj_code', 'risk_description', 'risk_occurence_probability',
            'risk_effects', 'risk_coping_strategy', 'host'],
            $data);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'ریسک های پروژه با کد (' . $data[0] . ') ایجاد شد.', 'project');
        }
        $this->closeConnection();
    }

    public function updateProjTables($prjC, $tn, $fieldn, $value)
    {
        $check = $this->selectAll("select * from {$tn} where proj_code=?", [$prjC]);
        if (count($check) == 0)
            $this->insert($tn, ['proj_code'], [$prjC]);
        $this->query("update {$tn} set {$fieldn}=? where proj_code=?", [$value, $prjC]);
    }

    public function insertUplodedFiles($prjCode, $f1, $f2)
    {
        // $this->query("delete from tbl_mehrabad_projects_attachments where proj_code=?",[$prjCode]);
        $this->insert('tbl_mehrabad_projects_attachments', ['proj_code', 'attachment_name', 'attachment_file', 'host'],
            [$prjCode, $f1, $f2, IP]);
    }

    public function getProjectAttachment($prjCode)
    {
        $docs = $this->selectAll("select * from tbl_mehrabad_projects_attachments where (deleted_at is null or deleted_at='') and proj_code=?", [$prjCode]);
        //  print_r($docs);
        for ($i = 0; $i < count($docs); $i++) {
            $docs[$i]['date'] = tr_num(jdate('Y/m/d H:i:s', strtotime($docs[$i]['created_at'])));
        }
        return $docs;
    }

    public function delDocs($id)
    {
        $this->query("update tbl_mehrabad_projects_attachments set deleted_at='" . tr_num(jdate('Y/m/d H:i:s')) . "' where id=?", [$id]);
        //  print_r($docs);

    }

    public function getAllBpmData($prjCode)
    {
        $dat1 = $this->selectAll("select * from tbl_mehrabad_projects_bpm_info where proj_code=? order by id", [$prjCode]);
        $dat2 = $this->selectAll("select * from tbl_mehrabad_projects_bmp_privileges where proj_code=? order by id", [$prjCode]);
        $dat3 = $this->selectAll("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? order by id", [$prjCode]);
        $dat4 = $this->selectAll("select * from tbl_mehrabad_projects_bpm_log where proj_code=? order by id desc", [$prjCode]);
        $dat5 = $this->selectOne("select proj_name from tbl_mehrabad_projects where proj_code=? ", [$prjCode]);
        return array($dat1, $dat2, $dat3, $dat4, $dat5);
    }

    public function showProjectLOG($prjCode)
    {
        return $this->selectAll("select * from tbl_mehrabad_projects_bpm_log where proj_code=? order by id desc", [$prjCode]);
    }
    public function signPrj($prjCode)
    {
        //p2000
        $bpmData = $this->getOneRowBPM($prjCode,'p2000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p2000',$bpmData['owners'],'prjman','signing','شناسنامه پروژه امضاء شد',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->NextStepBPM($prjCode, 'p2000');
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(501, 507)',  'شناسنامه پروژه با کد ' . $prjCode . ' امضاء شده و آماده بررسی شما می باشد', 'project');
        }
    }

    private function NextStepBPM($prjCode, $step_id,$status=3)
     {
         $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed1=1 where proj_code=? and process_step_id=?", [$prjCode, $step_id]);
         $this->query("update tbl_mehrabad_projects set proj_status={$status} where proj_code=?", [$prjCode]);
     }
    public function prjNotAccepted($prjCode,$cause)
    {
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)',  'شناسنامه پروژه با کد ' . $prjCode . 'بررسی شده و به دلیل «' . $cause . '» مورد تایید واقع نشد!', 'project');
        }
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=0,signed1=0 where proj_code=? and process_step_id=?", [$prjCode, 'p2000']);
        $this->query("update tbl_mehrabad_projects set proj_status=1 where proj_code=?", [$prjCode]);
        $version=$this->selectOne("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? and main_form_process_step_id=?",[$prjCode, 'p2000']);
        $nextVersion='V'.substr('00'.(str_replace('V','',$version['proj_main_forms_version'])+1),-2);
      //  print_r($nextVersion);
        $this->query("update tbl_mehrabad_projects_bpm_mainform_version set proj_main_forms_version=?
                                                      where proj_code=? and main_form_process_step_id=?", [$nextVersion,$prjCode,'p2000']);
        $bpmData = $this->getOneRowBPM($prjCode,'p3000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p3000',$bpmData['owners'],'prjman/showprj','Decision Making','شناسنامه پروژه به دلیل «' . $cause . '» تایید نشد ',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p3000',$bpmData['owners'],'prjman/showprj','Form version changed','نسخه فرم شناسنامه پروژه عوض شد',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
    }
    public function prjAccepted($prjCode)
    {
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500,507)',  'شناسنامه پروژه با کد ' . $prjCode . ' بررسی و تایید شد. لطفا فرم EPL آماده شود.', 'project');
        }
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p3000']);
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p4000']);
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p5000']);
        $this->query("update tbl_mehrabad_projects set proj_status=6 where proj_code=?", [$prjCode]);
               //  print_r($nextVersion);
        $this->query("update tbl_mehrabad_projects_bpm_mainform_version set proj_main_forms_last_accepted_date=?
                                                      where proj_code=? and main_form_process_step_id=?", [tr_num(jdate('Y/m/d H:i:s')),$prjCode,'p2000']);
        $bpmData = $this->getOneRowBPM($prjCode,'p3000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p3000',$bpmData['owners'],'prjman/showprj','Decision Making','شناسنامه پروژه تایید نهایی شد' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
    }
    public function signEPL($prjCode)
    {
        //p6000

        $bpmData = $this->getOneRowBPM($prjCode,'p6000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p6000',$bpmData['owners'],'prjman/epl','signing','اسناد EPL پروژه امضاء شد',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->NextStepBPM($prjCode, 'p6000',7);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(501, 507)',  'فرم EPL پروژه با کد ' . $prjCode . ' امضاء شده و آماده بررسی شما می باشد', 'project');
        }
    }
    public function EPLNotAccepted($prjCode,$cause)
    {
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)',  'فرم EPL پروژه با کد ' . $prjCode . 'بررسی شده و به دلیل «' . $cause . '» مورد تایید واقع نشد!', 'project');
        }
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=0,signed1=0 where proj_code=? and process_step_id=?", [$prjCode, 'p6000']);
        $this->query("update tbl_mehrabad_projects set proj_status=6 where proj_code=?", [$prjCode]);
        $version=$this->selectOne("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? and main_form_process_step_id=?",[$prjCode, 'p6000']);
        $nextVersion='V'.substr('00'.(str_replace('V','',$version['proj_main_forms_version'])+1),-2);
        //  print_r($nextVersion);
        $this->query("update tbl_mehrabad_projects_bpm_mainform_version set proj_main_forms_version=?
                                                      where proj_code=? and main_form_process_step_id=?", [$nextVersion,$prjCode,'p6000']);
        $bpmData = $this->getOneRowBPM($prjCode,'p7000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p7000',$bpmData['owners'],'prjman/epl','Decision Making','اسناد EPL پروژه به دلیل «' . $cause . '» تایید نشد ',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p7000',$bpmData['owners'],'prjman/epl','DOC version changed','نسخه اسناد EPL پروژه عوض شد',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
    }
    public function EPLAccepted($prjCode)
    {
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500,502,507)',  'فرم EPL پروژه با کد ' . $prjCode . ' بررسی و تایید شد و آماده بررسی مهندسی پروژه می باشد.', 'project');
        }
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p6000']);
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p7000']);
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p9000']);
        $this->query("update tbl_mehrabad_projects set proj_status=8 where proj_code=?", [$prjCode]);
        //  print_r($nextVersion);
        $this->query("update tbl_mehrabad_projects_bpm_mainform_version set proj_main_forms_last_accepted_date=?
                                                      where proj_code=? and main_form_process_step_id=?", [tr_num(jdate('Y/m/d H:i:s')),$prjCode,'p6000']);
        $bpmData = $this->getOneRowBPM($prjCode,'p7000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p7000',$bpmData['owners'],'prjman/epl','Decision Making','اسناد EPL پروژه تایید نهایی شد' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->query("delete from tbl_mehrabad_projects_dpl where prj_cod=?", [$prjCode]);
        $allEpl=$this->selectAll("select * from tbl_mehrabad_projects_epl where prj_cod=? order by id",[$prjCode]);
        $myitems=$this->selectAll("select * from tbl_mehrabad_projects_technical_items  where proj_code=?", [$prjCode]);
        for($i=0;$i<count($allEpl);$i++)
        {
            ///////new
            $zarib=1;
            for($j=0;$j<count($myitems);$j++){
                if($allEpl[$i]['mah_cod']==$myitems[$j]['proj_item_mah_cod']){
                    $zarib=$myitems[$j]['proj_item_number'];
                    break;
                }
            }
            //////new
            $this->insert('tbl_mehrabad_projects_dpl', ['prj_cod', 'mah_cod', 'equip',
                'type', 'manufact', 'qty', 'totalqty', 'row_type','host','document_no','document_date'],
                [$prjCode, $allEpl[$i]['mah_cod'],$allEpl[$i]['equip'],
                    $allEpl[$i]['type'],$allEpl[$i]['manufact'],$allEpl[$i]['qty']*$zarib,$allEpl[$i]['totalqty']*$zarib,
                    $allEpl[$i]['row_type'],IP,$prjCode,tr_num(jdate('Y/m/d'))]);
        }
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p7000',$bpmData['owners'],'prjman/epl','Create DPL','ایجاد مکانیزه اسناد DPL' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
    }
    public function signDPL($prjCode)
    {
        //p6000

        $bpmData = $this->getOneRowBPM($prjCode,'p8000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p8000',$bpmData['owners'],'prjman/dpl','signing','اسناد DPL پروژه امضاء شد',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->NextStepBPM($prjCode, 'p8000',10);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)',  'فرم DPL پروژه با کد ' . $prjCode . ' امضاء شده و آماده بررسی شما می باشد', 'project');
        }
    }
    public function DPLNotAccepted($prjCode,$cause)
    {
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(502, 507)',  'فرم DPL پروژه با کد ' . $prjCode . 'بررسی شده و به دلیل «' . $cause . '» مورد تایید واقع نشد!', 'project');
        }
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=0,signed1=0 where proj_code=? and process_step_id=?", [$prjCode, 'p8000']);
        $this->query("update tbl_mehrabad_projects set proj_status=8 where proj_code=?", [$prjCode]);
        $version=$this->selectOne("select * from tbl_mehrabad_projects_bpm_mainform_version where proj_code=? and main_form_process_step_id=?",[$prjCode, 'p8000']);
        $nextVersion='V'.substr('00'.(str_replace('V','',$version['proj_main_forms_version'])+1),-2);
        //  print_r($nextVersion);
        $this->query("update tbl_mehrabad_projects_bpm_mainform_version set proj_main_forms_version=?
                                                      where proj_code=? and main_form_process_step_id=?", [$nextVersion,$prjCode,'p8000']);
        $bpmData = $this->getOneRowBPM($prjCode,'p10000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p10000',$bpmData['owners'],'prjman/dpl','Decision Making','اسناد DPL پروژه به دلیل «' . $cause . '» تایید نشد ',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p10000',$bpmData['owners'],'prjman/dpl','DOC version changed','نسخه اسناد DPL پروژه عوض شد',tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
    }
    public function DPLAccepted($prjCode)
    {
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(502, 507)',  'فرم DPL پروژه با کد ' . $prjCode . ' بررسی و تایید شد!', 'project');
        }
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p8000']);
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p10000']);
        $this->query("update tbl_mehrabad_projects_bpm_info set passed=1,signed2=1 where proj_code=? and process_step_id=?", [$prjCode, 'p11000']);
        $this->query("update tbl_mehrabad_projects set proj_status=12 where proj_code=?", [$prjCode]);
        //  print_r($nextVersion);
        $this->query("update tbl_mehrabad_projects_bpm_mainform_version set proj_main_forms_last_accepted_date=?
                                                      where proj_code=? and main_form_process_step_id=?", [tr_num(jdate('Y/m/d H:i:s')),$prjCode,'p8000']);
        $bpmData = $this->getOneRowBPM($prjCode,'p10000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p10000',$bpmData['owners'],'prjman/Dpl','Decision Making','اسناد DPL پروژه تایید نهایی شد' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);

    }

    public function setProjectProgress( $prjCode,  $progress)
    {
        $this->query("update tbl_mehrabad_projects set proj_physical_progress=? where proj_code=?", [$progress,$prjCode]);
        $bpmData = $this->getOneRowBPM($prjCode,'p12000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p12000',$bpmData['owners'],'produce/tab1','Managing','میزان پیشرفت پروژه به روز شد' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'میزان پیشرفت پروژه (' . $prjCode . ') تغییر یافت.', 'project');
        }
    }

    public function addcoltoend(?string $prjCode, ?string $mah_cod, ?string $colname)
    {
        $colno=0;

        $result=$this->selectOne("select * from tbl_mehrabad_projects_dpl where prj_cod=? and mah_cod=?",[$prjCode,$mah_cod]);
        for($j=1;$j<=5;$j++)
        {
            if($result["col".$j."name"]=="")
            {
                $colno=$j;
                break;
            }
        }
       if($colno!=0) {
           $this->query("update tbl_mehrabad_projects_dpl set col".$colno."=0,col".$colno."name=? where prj_cod=? and mah_cod=?",[$colname,$prjCode,$mah_cod]);
           return "ok";
       }
           else
       return "impossible";
    }

    public function dellastcol(?string $prjCode, ?string $mah_cod)
    {
        $colno=0;

        $result=$this->selectOne("select * from tbl_mehrabad_projects_dpl where prj_cod=? and mah_cod=?",[$prjCode,$mah_cod]);
        for($j=1;$j<=5;$j++)
        {
            if($result["col".$j."name"]=="")
            {
                $colno=$j-1;
                break;
            }
        }
       if($colno>0){
           $this->query("update tbl_mehrabad_projects_dpl set col".$colno."=0,col".$colno."name='' where prj_cod=? and mah_cod=?",[$prjCode,$mah_cod]);
           return "ok";
       }
       else
           return "impossible";

    }

    public function closeprj(?string $prjCode)
    {
        $this->query("update tbl_mehrabad_projects set proj_status=100 where proj_code=?", [$prjCode]);
        $bpmData = $this->getOneRowBPM($prjCode,'p12000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p12000',$bpmData['owners'],'prjman/tab1','Managing','پروژه بسته شد' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        $bpmData = $this->getOneRowBPM($prjCode,'p20000');
        $this->insert('tbl_mehrabad_projects_bpm_log', ['proj_code', 'process_step_id', 'projects_members',
            'work_page', 'activities', 'log_descriptions', 'date', 'host','user_id'],
            [$prjCode, 'p20000',$bpmData['owners'],'prjman/tab1','Managing','پروژه بسته شد' ,tr_num(jdate('Y/m/d H:i:s')),IP,$_SESSION['tke']]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501,502, 507)',  'پروژه با کد (' . $prjCode . ') بسته شد.', 'project');
        }
        $this->closeConnection();
    }

    public function changeBOM(?string $prj_cod, ?string $field, ?string $newval)
    {
        $this->query("update tbl_mehrabad_projects_dpl set $field=? where prj_cod=? ",[$newval,$prj_cod]);
        $this->query("update tbl_mehrabad_projects set $field=? where proj_code=? ",[$newval,$prj_cod]);
    }
}