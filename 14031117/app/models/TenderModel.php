<?php

namespace App\Models;

class TenderModel extends Model
{
    public function id()
    {
        $id = $this->selectOne("SELECT TOP 1 code FROM tbl_mehrabad_monaqese ORDER BY code DESC");

        $this->closeConnection();
        return intval(str_replace('LOM-','',$id['code']));
    }

    public function getTenders()
    {
        $all = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese");
        $this->closeConnection();
        return $all;
    }
    public function getAll()
    {
        $all = $this->selectAll("SELECT cod+':::'+nam as nam FROM tbl_mehrabad_motaqazian WHERE deleted_at IS NULL or deleted_at='' ");
        $this->closeConnection();
        return $all;
    }

    public function getFiles($cod)
    {
        $all = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_files WHERE mon_cod='$cod'");
        $this->closeConnection();
        return $all;
    }

    public function submitTender($nam, $cod, $date, $due, $cus)
    {
        $customer=explode(':::',$cus)[0];
        $exist = $this->selectOne("SELECT id FROM tbl_mehrabad_monaqese WHERE code=?", [$cod]);
        if ($exist) {
             $this->update('UPDATE tbl_mehrabad_monaqese SET name=?,  due_date=?, customercod=?,trkh=? WHERE code=?',
                 [$nam, $due, $customer,$date, $cod]);
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', ' اطلاعات مناقصه با کد ('.$cod.') بروزرسانی شد.', 'tender');
            }
            $files = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_files WHERE mon_cod='$cod'");

        } else {
             $this->insert('tbl_mehrabad_monaqese', ['name', 'code',  'due_date', 'customercod','trkh'],
                 [$nam, $cod,  $due, $customer,$date]);
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', '  مناقصه ی جدیدی با کد ('.$cod.') ایجاد شد.', 'tender');
            }
        }
        $this->closeConnection();
         return $files ?? null ;
    }

    public function uploadFiles($nam, $type, $cod)
    {
        $upl = $this->insert('tbl_mehrabad_monaqese_files', ['nam', 'type', 'mon_cod'], [$nam, $type, $cod]);
        $this->closeConnection();
        return $upl;
    }
    public function editInfo($cd)
    {
        $tender = $this->selectOne("SELECT tbl_mehrabad_monaqese.*, tbl_mehrabad_motaqazian.cod+':::'+tbl_mehrabad_motaqazian.nam as nam
FROM tbl_mehrabad_monaqese LEFT JOIN tbl_mehrabad_motaqazian ON tbl_mehrabad_motaqazian.cod = tbl_mehrabad_monaqese.customercod 
WHERE tbl_mehrabad_monaqese.code=?", [$cd]);
        $this->closeConnection();
        return $tender;
    }
    public function deleteTender($tenderCod)
        {
            $this->query("delete from tbl_mehrabad_monaqese_mahsoul where mon_cod=?",[$tenderCod]);
            $this->query("delete from tbl_mehrabad_monaqese_files where mon_cod=?",[$tenderCod]);
            $this->query("delete from tbl_mehrabad_monaqese where code=?",[$tenderCod]);
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', ' مناقصه با کد ('.$tenderCod.') حذف شد.', 'tender');
            }
        }
    public function deleteOldfiles($cod)
    {
        $this->query('DELETE FROM tbl_mehrabad_monaqese_files WHERE mon_cod=?', [$cod]);
    }
}