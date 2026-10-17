<?php

namespace App\Models;

class ProductModel extends Model
{
    public function id()
    {
        $id = $this->selectAll("SELECT TOP 1 code FROM tbl_mehrabad_mahsoul ORDER BY code DESC");
        $this->closeConnection();
        if (count($id) > 0)
            return intval(str_replace('PRO-', '', $id[0]['code']));
        else return 0;
    }

    public function getAll()
    {
        $all = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul");
        $this->closeConnection();
        return $all;
    }

    public function getAllequip()
    {
        $allequip = $this->selectAll("SELECT description FROM tbl_mehrabad_search group by description");
        $this->closeConnection();
        return $allequip;
    }

    public function getFiles($cod)
    {
        $all = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod='$cod'");
        $this->closeConnection();
        return $all;
    }

    public function proName($nam)
    {
        $id = $this->selectOne('SELECT TOP 1 id FROM tbl_mehrabad_mahsoul ORDER BY id DESC');
        $idCode = $id ? $id['id'] + 1 : 1;
        $pro = $this->insert('tbl_mehrabad_mahsoul', ['name', 'code'], [$nam, 'PRO' . date('dm') . $idCode]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'محصول جدیدی با کد ('.'PRO' . date('dm') . $idCode.') ایجاد شد.', 'elemental');
        }
        if ($pro == 1) {
            $select = $this->selectOne('SELECT TOP 1 id, code FROM tbl_mehrabad_mahsoul ORDER BY id DESC');
            $this->closeConnection();
            return $select;
        }

    }

    public function submitProduct($nam, $cod, $logo, $eq, $provolt, $proamp, $promodel, $protype)
    {
        $exist = $this->selectOne("SELECT id FROM tbl_mehrabad_mahsoul WHERE code=?", [$cod]);
        if ($exist) {
            if (strlen($logo) < 10) {
                $this->update('UPDATE tbl_mehrabad_mahsoul 
            SET name=? ,voltage=?,crnt=?,type1=?,type2=? 
            WHERE code=?', [$nam, $provolt, $proamp, $promodel, $protype, $cod]);
            } else {
                $this->update('UPDATE tbl_mehrabad_mahsoul
                SET name=?,logo=? ,voltage=?,crnt=?,type1=?,type2=? 
                WHERE code=?', [$nam, $logo, $provolt, $proamp, $promodel, $protype, $cod]);
            }
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'اطلاعات محصول با کد ('.$cod.') بروزرسانی شد.', 'elemental');
            }
//            $files = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod='$cod'");
//            $this->query('DELETE FROM tbl_mehrabad_monaqese_files WHERE mahsoul_cod=?', [$cod]);
        } else {
            $this->insert('tbl_mehrabad_mahsoul', ['name', 'code', 'logo', 'voltage', 'crnt', 'type1', 'type2'],
                [$nam, $cod, $logo, $provolt, $proamp, $promodel, $protype]);
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'محصول جدیدی با کد ('. $cod.') ایجاد شد.', 'elemental');
            }
        }
        $this->query('DELETE FROM tbl_mehrabad_joziat_mahsoul WHERE mahsoul_cod=?', [$cod]);
        $tmp = explode('_;;;_', $eq);
        foreach ($tmp as $tp) {
            if (strlen($tp) >= 1) $this->insert('tbl_mehrabad_joziat_mahsoul', ['mahsoul_cod', 'description'], [$cod, $tp]);
        }
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'جزئیات محصول با کد ('.$cod.') ایجاد شد.', 'elemental');
        }
        $this->closeConnection();
        return $files ?? null;
    }

    public function uploadFiles($nam, $type, $cod)
    {
        $upl = $this->insert('tbl_mehrabad_mahsoul_files', ['nam', 'type', 'mahsoul_cod'], [$nam, $type, $cod]);
        $upl = $this->query('update tbl_mehrabad_mahsoul set logo=? where code=?', [$nam, $cod]);
        $this->closeConnection();
        return $upl;
    }

    public function uploadFile($file, $cod)
    {
        $this->insert('tbl_mehrabad_mahsoul_files', ['mahsoul_cod', 'nam', 'type'], [$cod, $file[0], $file[1]]);
        $this->closeConnection();
    }

    public function editName($nam, $cod)
    {
        $this->update("UPDATE tbl_mehrabad_mahsoul SET name=? WHERE code=?", [$nam, $cod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'نام محصول با کد ('.$cod.') بروزرسانی شد.', 'elemental');
        }

    }

    public function proNames($nam)
    {
        $names = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul WHERE name LIKE N'%" . $nam . "%'");
        $this->closeConnection();
        return $names;
    }

    public function getDetails($cod)
    {
        $details = $this->selectAll("SELECT * FROM tbl_mehrabad_joziat_mahsoul WHERE mahsoul_cod=?", [$cod]);
        $this->closeConnection();
        return $details;
    }

    public function searchDetails($det)
    {
        $details = $this->selectAll("SELECT * FROM tbl_mehrabad_search WHERE description LIKE N'%" . $det . "%'");
        $this->closeConnection();
        return $details;
    }

    public function searchTypes($type)
    {
        $types = $this->selectAll("SELECT type FROM tbl_mehrabad_search WHERE type LIKE N'%" . $type . "%'");
        $this->closeConnection();
        return $types;
    }

    public function searchProducers($nam)
    {
        $names = $this->selectAll("SELECT manufacturer FROM tbl_mehrabad_search WHERE manufacturer LIKE N'%" . $nam . "%'");
        $this->closeConnection();
        return $names;
    }

    public function addDetails($code, $des, $type, $comp)
    {
        $this->insert('tbl_mehrabad_joziat_mahsoul', ['mahsoul_cod', 'description', 'type', 'manufacturer'], [$code, $des, $type, $comp]);
    }

    public function editDetails($code, $des, $type, $comp, $id)
    {
        $this->update(' UPDATE tbl_mehrabad_joziat_mahsoul SET mahsoul_cod=?, description=?, type=?, manufacturer=?, updated_at=?
                                    WHERE id=?', [$code, $des, $type, $comp, georgianNow, $id]);
    }

    public function existFiles($cod)
    {
        $files = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod='$cod'");
        $this->query('DELETE FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod=?', [$cod]);
        $this->closeConnection();
        return $files;
    }

    public function allproducts()
    {
        $products = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul order by id desc");
        for ($i = 0; $i < count($products); $i++) {
            $tmp = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_epl where mah_cod=?", [$products[$i]['code']]);
            $products[$i]['disabled'] = "";
            if (count($tmp) > 0) $products[$i]['disabled'] = "disabled";
        }
        $this->closeConnection();
        return $products;
    }

    public function delproduct($prdcod)
    {
        $q1 = $this->query("delete from tbl_mehrabad_mahsoul where code=?", [$prdcod]);
        $q2 = $this->query("delete from tbl_mehrabad_joziat_mahsoul where mahsoul_cod=?", [$prdcod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', ' محصول با کد ('.$prdcod.') حذف شد.', 'elemental');
        }
        $this->closeConnection();

    }

    public function selectproduct($prdcod)
    {
        $product = $this->selectOne("select * from tbl_mehrabad_mahsoul where code=?", [$prdcod]);
        $productdet = $this->selectAll("select * from tbl_mehrabad_joziat_mahsoul where mahsoul_cod=?", [$prdcod]);
        $this->closeConnection();
        return [$product, $productdet];
    }

    public function duplicate(?string $prdCod, $code)
    {
        $tmp001 = $this->selectOne("select * from tbl_mehrabad_mahsoul where code=?", [$prdCod]);
        $this->insert('tbl_mehrabad_mahsoul', ['name', 'code', 'logo', 'voltage', 'crnt', 'type1', 'type2'],
            [$tmp001['name'], $code, $tmp001['logo'], $tmp001['voltage'], $tmp001['crnt'], $tmp001['type1'], $tmp001['type2']]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', ' محصول جدیدی با کد ('.$prdCod.') ایجاد شد.', 'elemental');
        }
        $productdet = $this->selectAll("select * from tbl_mehrabad_joziat_mahsoul where mahsoul_cod=?", [$prdCod]);
        for ($i = 0; $i < count($productdet); $i++) {
            $this->insert('tbl_mehrabad_joziat_mahsoul', ['mahsoul_cod', 'description', 'type', 'manufacturer'], [$code, $productdet[$i]['description'],
                $productdet[$i]['type'], $productdet[$i]['manufacturer']]);
        }
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'جزئیات محصول با کد ('.$prdCod.') ایجاد شد.', 'elemental');
        }
    }
}