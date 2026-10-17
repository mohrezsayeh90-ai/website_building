<?php

namespace App\Models;

class GroupModel extends Model
{
    public function all()
    {
        $all = $this->selectAll("SELECT * FROM tbl_mehrabad_grp_search ORDER BY id desc");
        $this->closeConnection();
        return $all;
    }
    public function submitGroup($fileds, $fValues)
    {
        $this->insert('tbl_mehrabad_grp_search', $fileds, $fValues);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'مجموعه ی جدیدی ایجاد شد.', 'elemental');
        }
        $this->closeConnection();
    }
    public function updateGroup($des, $type, $man, $id)
    {
        $this->update("UPDATE tbl_mehrabad_grp_search
                    SET description=? ,type=? ,manufacturer=?  
                    WHERE id=?", [$des, $type, $man, $id]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'مشخصات یک مجموعه بروزرسانی شد.', 'elemental');
        }
        $this->closeConnection();
    }
    public function delete($id)
    {
        $this->query("DELETE FROM tbl_mehrabad_grp_search WHERE id=?", [$id]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'یک مجموعه حذف شد.', 'elemental');
        }
        $this->closeConnection();
    }
}