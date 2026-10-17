<?php

namespace App\Models;

class SupplierModel extends Model
{
    public function id()
    {
        $idd = $this->selectAll("SELECT TOP 1 cod FROM tbl_mehrabad_taminKonandegan ORDER BY cod DESC");
        $id=0;
        if(count($idd)>0)
        {
            $id=intval(str_replace('SUP-','',$idd[0]['cod']));
        }
        $this->closeConnection();
        return $id;
    }
    public function submitSup($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post,$eName,$logo,$accountno,$score)
    {
        $insert = $this->insert('tbl_mehrabad_taminKonandegan', ['cod', 'nam', 'shenase', 'no', 'mobile', 'phone', 'adres', 'email', 'fax',
            'post','eName', 'logo','accountno','score'],
            [$cod, $name, $identity, $type, $mobile, $tel, $address, $email, $fax, $post, $eName, $logo,$accountno,$score]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)', ' تأمین کننده ی جدیدی با کد ('.$cod.') ایجاد شد.', 'elemental');
        }
        $this->closeConnection();
        return $insert;
    }
    public function editSup($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post,$eName,$logo,$accountno,$score)
    {
        if(strlen($logo)>5)
        $insert = $this->update('UPDATE tbl_mehrabad_taminKonandegan SET nam=?, shenase=?, no=?, mobile=?, phone=?
                                 , adres=?, email=?, fax=?, post=?, updated_at=? , eName=?, logo=?,accountno=?,score=? WHERE cod=?',
            [$name, $identity, $type, $mobile, $tel, $address, $email, $fax, $post, georgianNow, $eName, $logo,$accountno,$score, $cod]);
        else
            $insert = $this->update('UPDATE tbl_mehrabad_taminKonandegan SET nam=?, shenase=?, no=?, mobile=?, phone=?
                                 , adres=?, email=?, fax=?, post=?, updated_at=? , eName=?,accountno=?,score=? WHERE cod=?',
                [$name, $identity, $type, $mobile, $tel, $address, $email, $fax, $post, georgianNow, $eName,$accountno,$score,  $cod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)', ' اطلاعات تأمین کننده با کد ('.$cod.') بروزرسانی شد.', 'elemental');
        }
        $this->closeConnection();
        return $insert;
    }
    public function companies($nam)
    {
        $names = $this->selectAll("SELECT * FROM tbl_mehrabad_taminKonandegan WHERE nam LIKE N'%" . $nam . "%'");
        $this->closeConnection();
        return $names;
    }
    public function detail($cod)
    {
        $details = $this->selectOne("SELECT * FROM tbl_mehrabad_taminKonandegan WHERE cod=?", [$cod]);
        $this->closeConnection();
        return $details;
    }
    public function allSupplier()
    {
        $Suppliers = $this->selectAll("SELECT * FROM tbl_mehrabad_taminKonandegan WHERE deleted_at is null or deleted_at='' order by id desc");
        $this->closeConnection();
        return $Suppliers;
    }
    public function delSupplier($supCod)
    {
        $this->update ("update tbl_mehrabad_taminKonandegan set deleted_at=? where cod=?",[georgianNow,$supCod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)', '  تأمین کننده با کد ('.$supCod.') حذف شد.', 'elemental');
        }
        $this->closeConnection();

    }
    public function selectSupplier($supCod)
    {
        $Suppliers = $this->selectOne ("select * from tbl_mehrabad_taminKonandegan where cod=?",[$supCod]);
        $this->closeConnection();
        return $Suppliers;
    }
}