<?php

namespace App\Models;
use App\Models\Badge;

class ElementModel extends Model
{
    public function all()
    {
        $all = $this->selectAll("SELECT * FROM tbl_mehrabad_search ORDER BY id desc");
        $this->closeConnection();
        return $all;
    }
    public function submitElement($fileds, $fValues)
    {
        $this->insert('tbl_mehrabad_search', $fileds, $fValues);
        $bdg =new Badge();
        if($_SESSION['tkeNn'])$bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'قطعه ی جدیدی ایجاد شد.', 'elemental');
        $this->closeConnection();
    }
    public function updateElement($des, $type, $man, $id)
    {
        $this->update("UPDATE tbl_mehrabad_search
                    SET description=? ,type=? ,manufacturer=?  
                    WHERE id=?", [$des, $type, $man, $id]);
        $bdg =new Badge();
        if($_SESSION['tkeNn'])$bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'مشخصات یک قطعه بروزرسانی شد.', 'elemental');
        $this->closeConnection();
    }
    public function delete($id)
    {
        $this->query("DELETE FROM tbl_mehrabad_search WHERE id=?", [$id]);
        $bdg =new Badge();
        if($_SESSION['tkeNn'])$bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'یک قطعه حذف شد.', 'elemental');
        $this->closeConnection();
    }

}