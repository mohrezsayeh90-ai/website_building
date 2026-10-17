<?php

namespace App\Models;

class DetailModel extends Model
{
    public function selectMaterials($tenderid)
    {
        $tenderData = $this->selectOne("select tbl_mehrabad_monaqese.*,a1.* from tbl_mehrabad_monaqese 
    inner join tbl_mehrabad_motaqazian as a1 on tbl_mehrabad_monaqese.customercod=a1.cod  where tbl_mehrabad_monaqese.id=?", [$tenderid]);
        $materials = $this->selectAll("select  tbl_mehrabad_monaqese_mahsoul.* , tbl_mehrabad_mahsoul.* 
         from tbl_mehrabad_monaqese_mahsoul inner join tbl_mehrabad_mahsoul on tbl_mehrabad_mahsoul.code=tbl_mehrabad_monaqese_mahsoul.mah_cod
         where tbl_mehrabad_monaqese_mahsoul.mon_cod=?", [$tenderData['code']]);
        $searchall = $this->selectAll("select replace(replace(description,'\n',''),'\r','') as description,replace(replace(type,'\n',''),'\r','') as type,manufacturer from tbl_mehrabad_search ");
        $searchdes = $this->selectAll("select replace(replace(description,'\n',''),'\r','') as description from tbl_mehrabad_search group by description");
        $searchdtyp = $this->selectAll("select replace(replace(type,'\n',''),'\r','') as type from tbl_mehrabad_search group by type");
        $searchdmanufact = $this->selectAll("select manufacturer from tbl_mehrabad_search group by manufacturer");
        ///
        for ($i = 0; $i < count($searchdtyp); $i++) {
            $searchdtyp[$i]['clue'] = '';
            for ($j = 0; $j < count($searchall); $j++) {
                if ($searchall[$j]['type'] == $searchdtyp[$i]['type'] && !str_contains($searchdtyp[$i]['clue'], ";" . $searchall[$j]['description'] . ";"))
                    $searchdtyp[$i]['clue'] .= ";" . $searchall[$j]['description'] . ";";
            }
        }
        for ($i = 0; $i < count($searchdmanufact); $i++) {
            $searchdmanufact[$i]['clue'] = '';
            for ($j = 0; $j < count($searchall); $j++) {
                if ($searchall[$j]['manufacturer'] == $searchdmanufact[$i]['manufacturer'] && !str_contains($searchdmanufact[$i]['clue'], ";" . $searchall[$j]['description'] . ";"))
                    $searchdmanufact[$i]['clue'] .= ";" . $searchall[$j]['description'] . ";";
            }
        }
        ///

        $searchall = $this->selectAll("select replace(replace(description,'\n',''),'\r','') as description,replace(replace(type,'\n',' '),'\r','') as type,manufacturer from tbl_mehrabad_grp_search");
        $searchgrpdes = $this->selectAll("select replace(replace(description,'\n',''),'\r','') as description from tbl_mehrabad_grp_search group by description");
        $searchgrptyp = $this->selectAll("select replace(replace(type,'\n',''),'\r','') as type from tbl_mehrabad_grp_search group by type");
        $searchgrpmanufact = $this->selectAll("select manufacturer from tbl_mehrabad_grp_search group by manufacturer");
        ///
        for ($i = 0; $i < count($searchgrptyp); $i++) {
            $searchgrptyp[$i]['clue'] = '';
            for ($j = 0; $j < count($searchall); $j++) {
                if ($searchall[$j]['type'] == $searchgrptyp[$i]['type'] && !str_contains($searchgrptyp[$i]['clue'], ";" . $searchall[$j]['description'] . ";"))
                    $searchgrptyp[$i]['clue'] .= ";" . $searchall[$j]['description'] . ";";
            }
        }
        for ($i = 0; $i < count($searchgrpmanufact); $i++) {
            $searchgrpmanufact[$i]['clue'] = '';
            for ($j = 0; $j < count($searchall); $j++) {
                if ($searchall[$j]['manufacturer'] == $searchgrpmanufact[$i]['manufacturer'] && !str_contains($searchgrpmanufact[$i]['clue'], ";" . $searchall[$j]['description'] . ";"))
                    $searchgrpmanufact[$i]['clue'] .= ";" . $searchall[$j]['description'] . ";";
            }
        }
        ///

        $epl = $this->selectAll("select * from tbl_mehrabad_monaqese_epl where mon_cod=? order by id", [$tenderData['code']]);
        $epleassheetcontrol = $this->selectAll("select * from tbl_mehrabad_monaqese_eas_sheet_control where mon_cod=? order by id", [$tenderData['code']]);
        return array($tenderData, $materials, $searchdes, $searchgrpdes, $searchdtyp, $searchgrptyp, $searchdmanufact, $searchgrpmanufact, $epl, $epleassheetcontrol);
    }

    public function saveAllSheets($tc, $ad)
    {
        $this->query("delete from tbl_mehrabad_monaqese_epl where mon_cod=?", [$tc]);
        for ($i = 0; $i < count($ad); $i++) {
            if ($ad[$i][7] == "") {
                $ad[$i][7] = "Normal";
                // print_r($ad);
            }
            if ($ad[$i][7] != 'Foreign Accessories')
                $this->insert('tbl_mehrabad_monaqese_epl', ['mon_cod', 'mah_cod', 'equip', 'type', 'manufact', 'qty', 'price_i', 'price_r', 'row_type'],
                    [$tc, $ad[$i][0], $ad[$i][1], $ad[$i][2], $ad[$i][3], $ad[$i][4], $ad[$i][5], $ad[$i][6], $ad[$i][7]]);
            else {

                $this->insert('tbl_mehrabad_monaqese_epl', ['mon_cod', 'mah_cod', 'equip', 'type', 'manufact', 'qty', 'price_i', 'price_r', 'row_type', 'real_foreign'],
                    [$tc, $ad[$i][0], $ad[$i][1], $ad[$i][2], $ad[$i][3], $ad[$i][4], $ad[$i][5], $ad[$i][6], $ad[$i][7], $ad[$i][4] * $ad[$i][5]]);
            }
        }
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'جزئیات فرم EPL مناقصه با کد (' . $tc . ') بروزرسانی شد.', 'tender');
        }
    }

    public function getPRODname($prodCode)
    {
        $mname = $this->selectOne("select * from tbl_mehrabad_mahsoul where code=?", [$prodCode]);
        $this->closeConnection();
        return $mname;
    }

    public function getAllProd($tenderCode)
    {
        $mname = $this->selectAll("select * from tbl_mehrabad_monaqese_mahsoul where mon_cod=?", [$tenderCode]);
        $this->closeConnection();
        return $mname;
    }

    public function setpifor($mon_cod, $mah_cod, $value)
    {
        $this->query("update tbl_mehrabad_monaqese_epl set real_foreign=0 where mon_cod=? and mah_cod=?", [$mon_cod, $mah_cod]);
        $this->query("update top (1) tbl_mehrabad_monaqese_epl set real_foreign=? where mon_cod=? and mah_cod=?", [$value, $mon_cod, $mah_cod]);
        $this->closeConnection();
    }

    public function checkproposal($mon_cod)
    {
        //checkproposal
        $s = $this->selectAll("select * from tbl_mehrabad_monaqese_proposal where mon_cod=? order by id", [$mon_cod]);
        $this->closeConnection();
        return count($s) == 0 ? 0 : $s;
    }
    public function checkproposal2($mon_cod)
    {
        //checkproposal
        $s = $this->selectAll("select * from tbl_mehrabad_monaqese_proposal where mon_cod=? and parameter like 'ps_%' order by id", [$mon_cod]);
        $this->closeConnection();
        return count($s) == 0 ? 0 : $s;
    }
    public function checkproposal3($mon_cod)
    {
        //checkproposal
        $s = $this->selectAll("select * from tbl_mehrabad_monaqese_proposal where mon_cod=? and parameter like 'extra_%' order by id", [$mon_cod]);
        $this->closeConnection();
        return count($s) == 0 ? 0 : $s;
    }
    public function createproposal($mon_cod, $dat)
    {
        // print_r($dat);
        foreach ($dat as $data) {
            $this->insert("tbl_mehrabad_monaqese_proposal", ['mon_cod', 'parameter', 'pval', 'user_id', 'host'],
                [$mon_cod, $data['id'], $data['value'], $_SESSION['tke'], IP]);
        }
        $this->closeConnection();
    }

    public function setparameter($mon_cod, $parameter, $pval)
    {
        $this->query("update tbl_mehrabad_monaqese_proposal set pval=? where mon_cod=? and parameter=?", [$pval, $mon_cod, $parameter]);
    }

    public function jusgetepl(?string $qq)
    {
        $tenderData = $this->selectOne("select tbl_mehrabad_monaqese.*,a1.* from tbl_mehrabad_monaqese 
    inner join tbl_mehrabad_motaqazian as a1 on tbl_mehrabad_monaqese.customercod=a1.cod  where tbl_mehrabad_monaqese.code=?", [$qq]);
        $materials = $this->selectAll("select  tbl_mehrabad_monaqese_mahsoul.* , tbl_mehrabad_mahsoul.* 
         from tbl_mehrabad_monaqese_mahsoul inner join tbl_mehrabad_mahsoul on tbl_mehrabad_mahsoul.code=tbl_mehrabad_monaqese_mahsoul.mah_cod
         where tbl_mehrabad_monaqese_mahsoul.mon_cod=?", [$qq]);
        $epl = $this->selectAll("select * from tbl_mehrabad_monaqese_epl where mon_cod=? order by id", [$qq]);
        return array($tenderData, $materials, $epl);
    }

    public function easpcs(?string $id, ?string $value, ?string $mon_cod)
    {
        $tmp = $this->selectOne("select * from tbl_mehrabad_monaqese_eas where mon_cod=? and cellid=?", [$mon_cod, $id]);
        if ($tmp && count($tmp) > 0) {
            $this->query("update tbl_mehrabad_monaqese_eas set celvalue=?,updated_at=?,user_id=?,host=? where 
                                                                      mon_cod=? and cellid=?            ",
                [$value, georgianNow, $_SESSION['tke'], IP, $mon_cod, $id]);
        } else {
            $this->insert("tbl_mehrabad_monaqese_eas", ['celvalue', 'user_id', 'host', 'mon_cod', 'cellid'],
                [$value, $_SESSION['tke'], IP, $mon_cod, $id]);
        }
    }

    public function easpcs_y(?string $id, ?string $value, $year)
    {
        $tmp = $this->selectOne("select * from tbl_mehrabad_monaqese_eas_y where mon_cod=? and cellid=?", [$year, $id]);
        if ($tmp && count($tmp) > 0) {
            $this->query("update tbl_mehrabad_monaqese_eas_y set celvalue=?,updated_at=?,user_id=?,host=? where mon_cod=? and cellid=?",
                [str_replace(',', '', $value), georgianNow, $_SESSION['tke'], IP, $year, $id]);
        } else {
            $this->insert("tbl_mehrabad_monaqese_eas_y", ['celvalue', 'user_id', 'host', 'mon_cod', 'cellid'],
                [str_replace(',', '', $value), $_SESSION['tke'], IP, $year, $id]);
        }
    }

    public function geteas(?string $mon_cod)
    {
        $eas = $this->selectAll("select * from tbl_mehrabad_monaqese_eas where mon_cod=?", [$mon_cod]);
        if (count($eas) == 0) {
            $eas = $this->selectAll("select * from tbl_mehrabad_monaqese_eas_y where mon_cod=? and (celvalue!='' or celvalue is not null)",
                [substr(persianNow, 0, 4)]);
            for ($i = 0; $i < count($eas); $i++) {
                $this->insert("tbl_mehrabad_monaqese_eas", ['celvalue', 'user_id', 'host', 'mon_cod', 'cellid'],

                    [$eas[$i]['celvalue'], $_SESSION['tke'], IP, $mon_cod, $eas[$i]['cellid']]);
            }
        }

        return $eas;
    }

    public function getequphistory($equip, $type)
    {
        // print_r($equip);
//        $equip=preg_replace( "/[\W]/", '', $equip);
//        $type=preg_replace( "/[\W]/", '', $type);
        //  print_r($type);

        $result = $this->selectAll("select top 500 * from tbl_mehrabad_monaqese_epl where dbo.RemoveNonAlphaCharacters(equip)=?
                                                and dbo.RemoveNonAlphaCharacters(type)=? order by created_at desc", [$equip, $type]);

        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['trkh'] = tr_num(jdate('Y/m/d', strtotime($result[$i]['created_at'])));
        }
        $result1 = $this->selectAll("select top 500 * from tbl_mehrabad_projects_demands where dbo.RemoveNonAlphaCharacters(equip)=? 
                                                    and dbo.RemoveNonAlphaCharacters(spec)=? order by order_no_time desc", [$equip, $type]);

        for ($i = 0; $i < count($result1); $i++) {
            $result1[$i]['trkh'] = tr_num(jdate('Y/m/d', strtotime($result1[$i]['created_at'])));
        }
//print_r($result1);
        return array($result, $result1);
    }

    public function declareControl(?string $mon_cod, ?string $sheet)
    {
        $this->insert("tbl_mehrabad_monaqese_eas_sheet_control", ['user_id', 'host', 'mon_cod', 'eas_sheet'],
            [$_SESSION['tke'], IP, $mon_cod, $sheet]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $sh = '';
            switch ($sheet) {
                case 'controlSheet1':
                    $sh = 'Processing Cost';
                    break;
                case 'controlSheet2':
                    $sh = 'EAS';
                    break;
                case 'controlSheet3':
                    $sh = 'Financial Calculation';
            }
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'جزئیات فرم ' . $sh . ' مناقصه با کد (' . $mon_cod . ') ایجاد شد.', 'tender');
        }
        $this->closeConnection();
    }

    public function controleplprice(?string $equip, ?string $spec, ?string $price, ?string $no)
    {
        $equip = preg_replace("/[\W]/", '', $equip);
        $spec = preg_replace("/[\W]/", '', $spec);
        //  print_r(preg_replace( "/[\W]/", '', $spec));
//print_r($this->selectAll("select dbo.RemoveNonAlphaCharacters('$equip') as t1,dbo.RemoveNonAlphaCharacters('$spec') as t2"));
//        print_r("select top 3 price_i,price_r  from tbl_mehrabad_monaqese_epl where dbo.RemoveNonAlphaCharacters(equip)=N'$equip' and
//                dbo.RemoveNonAlphaCharacters(type)=N'$spec'      order by mon_cod desc");
        $result = $this->selectAll("select top 3 price_i,price_r  from tbl_mehrabad_monaqese_epl where dbo.RemoveNonAlphaCharacters(equip)='$equip' and 
                left(dbo.RemoveNonAlphaCharacters(type),10)=left('$spec',10)      order by mon_cod desc");
        $good = "green";
        $price_i = 0;
        $price_r = 0;
//print_r(count($result));
        for ($i = 0; $i < count($result); $i++) {
            $price_i += $result[$i]['price_i'] / count($result);
            $price_r += $result[$i]['price_r'] / count($result);
        }
        if ($no == "r" && $price_r != 0) {
            if (abs($price - $price_r) > $price_r * 0.5) $good = "red";
        } else if ($no == "i" && $price_i != 0) {
            if (abs($price - $price_i) > $price_i * 0.5) $good = "red";
        }
        return $good;
    }

    public function extractEpl(?string $tenderCode)
    {
        $mahsoulat = $this->selectAll("select mah_cod from tbl_mehrabad_monaqese_mahsoul where mon_cod=? order by id ", [$tenderCode]);
        $oldmonaqese = $this->selectAll("select top 100 * from tbl_mehrabad_monaqese where code<>? and status>2 order by id desc", [$tenderCode]);
        $extepl = [];
        for ($i = 0; $i < count($mahsoulat); $i++) {
            $extepl[$i] = $this->selectAll("select * from tbl_mehrabad_monaqese_epl where mon_cod=? and mah_cod=? order by id ", [$tenderCode, $mahsoulat[$i]['mah_cod']]);
        }
        for ($i = 0; $i < count($mahsoulat); $i++) {
            for($j=0;$j<count($oldmonaqese);$j++){
                $tmp=$this->selectAll("select * from tbl_mehrabad_monaqese_epl where mon_cod=? and mah_cod=? order by id ", [$oldmonaqese[$j]['code'], $mahsoulat[$i]['mah_cod']]);
                if(count($tmp)>0)
                {
                    $extepl[$i]=$tmp;
                    break;
                }
            }
        }
        $this->query("delete from tbl_mehrabad_monaqese_epl where mon_cod=?",[$tenderCode]);
        for ($i = 0; $i < count($mahsoulat); $i++) {
            for ($j = 0; $j < count($extepl[$i]); $j++) {
                $this->insert('tbl_mehrabad_monaqese_epl', ['mon_cod', 'mah_cod', 'equip', 'type', 'manufact', 'qty', 'price_i', 'price_r', 'row_type', 'real_foreign'],
                    [$tenderCode, $extepl[$i][$j]['mah_cod'], $extepl[$i][$j]['equip'], $extepl[$i][$j]['type'], $extepl[$i][$j]['manufact'], $extepl[$i][$j]['qty'],
                        $extepl[$i][$j]['price_i'], $extepl[$i][$j]['price_r'], $extepl[$i][$j]['row_type'], $extepl[$i][$j]['real_foreign']]);
            }
        }
        $this->query("update tbl_mehrabad_monaqese set product_extraction=1 where code=?",[$tenderCode]);

    }



}