<?php

namespace App\Models;

class CustomerModel extends Model
{
        public function id()
        {
            $idd = $this->selectAll("SELECT TOP 1 cod FROM tbl_mehrabad_motaqazian ORDER BY cod DESC");
            $id=0;
            if(count($idd)>0)
            {
                $id=intval(str_replace('MOT-','',$idd[0]['cod']));
            }
            $this->closeConnection();
            return $id;
        }
        public function submitCus($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post,$ename,$cusrole,$logo,$connector)
        {
           $insert = $this->insert('tbl_mehrabad_motaqazian', ['cod', 'nam', 'shenase', 'no', 'mobile', 'phone', 'adres', 'email', 'fax',
               'post','ename','cusrole','logo','gobetween'],
            [$cod, $name, $identity, $type, $mobile, $tel, $address, $email, $fax, $post,$ename,$cusrole,$logo,$connector]);
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)', ' مشتری جدیدی با کد ('.$cod.') ایجاد شد.', 'elemental');
            }
           $this->closeConnection();
           return $insert;
        }
    public function editCus($cod, $name, $identity, $type, $mobile, $tel, $fax, $email, $address, $post,$ename,$cusrole,$logo,$connector)
    {
        if(strlen($logo)>5)
        $insert = $this->update('UPDATE tbl_mehrabad_motaqazian SET nam=?, shenase=?, no=?, mobile=?, phone=?
                                 , adres=?, email=?, fax=?, post=?, updated_at=? ,ename=?, cusrole=?,logo=?,gobetween=? WHERE cod=?',
            [$name, $identity, $type, $mobile, $tel, $address, $email, $fax, $post, georgianNow,$ename,$cusrole,$logo,$connector, $cod]);
        else
            $insert = $this->update('UPDATE tbl_mehrabad_motaqazian SET nam=?, shenase=?, no=?, mobile=?, phone=?
                                 , adres=?, email=?, fax=?, post=?, updated_at=? ,ename=?, cusrole=?,gobetween=? WHERE cod=?',
                [$name, $identity, $type, $mobile, $tel, $address, $email, $fax, $post, georgianNow,$ename,$cusrole,$connector, $cod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)', ' اطلاعات مشتری با کد ('.$cod.') بروزرسانی شد.', 'elemental');
        }
        $this->closeConnection();
        return $insert;
    }
    public function companies($nam)
    {
        $names = $this->selectAll("SELECT * FROM tbl_mehrabad_motaqazian WHERE nam LIKE N'%" . $nam . "%'");
        $this->closeConnection();
        return $names;
    }
    public function detail($cod)
    {
        $details = $this->selectOne("SELECT * FROM tbl_mehrabad_motaqazian WHERE cod=?", [$cod]);
        $this->closeConnection();
        return $details;
    }
    public function allcustomers()
    {
        $customers = $this->selectAll("SELECT * FROM tbl_mehrabad_motaqazian WHERE deleted_at is null or deleted_at='' order by id desc");
        for($i=0;$i<count($customers);$i++)
        {
            $tmp=$this->selectAll("SELECT * FROM tbl_mehrabad_monaqese where customercod=?",[$customers[$i]['cod']]);
            $customers[$i]['disabled']="";
            if(count($tmp)>0) $customers[$i]['disabled']="disabled";
            $tmp=$this->selectAll("SELECT * FROM tbl_mehrabad_projects where proj_consultant=?",[$customers[$i]['cod']]);
            if(count($tmp)>0) $customers[$i]['disabled']="disabled";
        }

        $this->closeConnection();
        return $customers;
    }
    public function delcustomer($cuscod)
    {
        $this->update ("update tbl_mehrabad_motaqazian set deleted_at=? where cod=?",[georgianNow,$cuscod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 507)', ' مشتری با کد ('.$cuscod.') حذف شد.', 'elemental');
        }
        $this->closeConnection();

    }
    public function selectcustomer($cuscod)
    {
        $customers = $this->selectOne ("select * from tbl_mehrabad_motaqazian where cod=?",[$cuscod]);
        $this->closeConnection();
        return $customers;
    }

}