<?php

namespace App\Models;

class ListModel extends Model
{
    public function all()
    {
        $all = $this->selectAll("SELECT tbl_mehrabad_monaqese.*,tbl_mehrabad_motaqazian.nam FROM tbl_mehrabad_monaqese left join tbl_mehrabad_motaqazian 
                                on tbl_mehrabad_motaqazian.cod=tbl_mehrabad_monaqese.customercod order by tbl_mehrabad_monaqese.id desc");
        $this->closeConnection();
        return $all;
    }

    public function products()
    {
        $pro = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul");
        $this->closeConnection();
        return $pro;
    }

    public function tenderView($id)
    {
        $tender = $this->selectAll("SELECT tbl_mehrabad_monaqese.*, v_mehrabad_monaqese_mahsoul.*
FROM tbl_mehrabad_monaqese LEFT JOIN v_mehrabad_monaqese_mahsoul ON v_mehrabad_monaqese_mahsoul.mon_id = tbl_mehrabad_monaqese.id 
WHERE tbl_mehrabad_monaqese.id=?", [$id]);
        $this->closeConnection();
        return $tender;
    }

    public function details($id)
    {
        $det = $this->selectAll("SELECT * FROM tbl_mehrabad_joziat_mahsoul WHERE mahsoul_cod='$id'");
        $file = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod='$id'");
        $this->closeConnection();
        return [$det, $file];
    }

    public function documents($id)
    {
        $files = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_files WHERE mon_cod='$id'");
        $this->closeConnection();
        return $files;
    }

    public function assign($ten, $pro, $num)
    {
        $exist = $this->selectOne("SELECT id FROM tbl_mehrabad_monaqese_mahsoul WHERE mon_cod=? AND mah_cod=?", [$ten, $pro]);
        if ($exist) {
            $this->closeConnection();
            return false;
        } else {
            $insert = $this->insert('tbl_mehrabad_monaqese_mahsoul'
                , ['mon_cod', 'mah_cod', 'tarikh', 'tedad'], [$ten, $pro, persianNow, $num]);
            if ($insert) {
                if ($_SESSION['tkeNn']) {
                    $bdg = new Badge();
                    $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'محصول با کد (' . $pro . ') به مناقصه با کد (' . $ten . ') اضافه شد.', 'tender');
                }
                $id = $this->selectOne("SELECT TOP 1 tbl_mehrabad_monaqese_mahsoul.id, mon_cod, mah_cod, tedad , name FROM
                                                                                  tbl_mehrabad_monaqese_mahsoul left join
                               tbl_mehrabad_mahsoul on mah_cod=code ORDER BY tbl_mehrabad_monaqese_mahsoul.id DESC");
                return $id;
            }
            return $insert;
        }
    }

    public function delete($id)
    {
        $moncod = $this->selectOne("select mon_id, mon_cod, mah_cod from v_mehrabad_monaqese_mahsoul where row_id=?", [$id]);
        $del = $this->query("DELETE FROM tbl_mehrabad_monaqese_mahsoul WHERE id=?", [$id]);
        if ($del) {
            if ($_SESSION['tkeNn']) {
                $bdg = new Badge();
                $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'محصول با کد (' . $moncod['mah_cod'] . ') از مناقصه با کد (' . $moncod['mon_cod'] . ') حذف شد.', 'tender');
            }
        }
        $this->closeConnection();
        $tender = $this->selectAll("SELECT tbl_mehrabad_monaqese.*, v_mehrabad_monaqese_mahsoul.*
FROM tbl_mehrabad_monaqese LEFT JOIN v_mehrabad_monaqese_mahsoul ON v_mehrabad_monaqese_mahsoul.mon_id = tbl_mehrabad_monaqese.id 
WHERE tbl_mehrabad_monaqese.id=?", [$moncod['mon_id']]);
        return $tender;
    }

    public function currentPic($id)
    {
        $currentAx = $this->selectOne("SELECT ax FROM tbl_mehrabad_monaqese WHERE code=?", [$id]);
        $this->closeConnection();
        return $currentAx;
    }

    public function uploadAx($ax, $id)
    {
        $upload = $this->update("UPDATE tbl_mehrabad_monaqese SET ax=?, updated_at=? WHERE code=?", [$ax, georgianNow, $id]);
        $this->closeConnection();

        return $upload;
    }

    public function gettenderFiles($tendercode)
    {
        $files = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_files WHERE mon_cod='$tendercode'");
        $this->closeConnection();
        return $files;
    }

    public function gostp2($tendercod)
    {
        $this->query("delete from tbl_mehrabad_monaqese_epl where mon_cod=?", [$tendercod]);
        $mahsoul = $this->selectAll("select mah_cod from tbl_mehrabad_monaqese_mahsoul where mon_cod=? order by id", [$tendercod]);
        for ($i = 0; $i < count($mahsoul); $i++) {
            $mahjoz = $this->selectAll("select description from tbl_mehrabad_joziat_mahsoul where mahsoul_cod=? order by id", [$mahsoul[$i]['mah_cod']]);
            for ($j = 0; $j < count($mahjoz); $j++) {
                $this->insert('tbl_mehrabad_monaqese_epl', ['mon_cod', 'mah_cod', 'equip'], [$tendercod, $mahsoul[$i]['mah_cod'], $mahjoz[$j]['description']]);
            }
        }
        $this->query("update tbl_mehrabad_monaqese set status=2 where code=?", [$tendercod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)', 'مناقصه با کد (' . $tendercod . ') برای مرحله ی EPL و EAS آماده شد.', 'tender');
        }
        $this->closeConnection();
    }

    public function win($tendercod)
    {
        $this->update("UPDATE tbl_mehrabad_monaqese SET status=100,dateofresult=?,
                                 completiondate=? WHERE code=?", [persianNow, persianNow, $tendercod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)',  'مناقصه با کد (' . $tendercod . ') برنده شد.', 'tender');
        }
        $this->closeConnection();
    }

    public function lose($tendercod)
    {
        $this->update("UPDATE tbl_mehrabad_monaqese SET status=101,dateofresult=?,
                                 completiondate=? WHERE code=?", [persianNow, persianNow, $tendercod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)',  'مناقصه با کد (' . $tendercod . ') با شکست مواجه شد.', 'tender');
        }
        $this->closeConnection();
    }

    public function filter($st, $ed, $type): array
    {
        $filter = [];
        if ($type === '1' && $st != '' && $ed != '') {
            $filter = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese WHERE trkh BETWEEN ? AND ? ORDER BY id DESC ", [$st, $ed]);
        } elseif ($type === '2' && $st != '' && $ed != '') {
            $filter = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese WHERE LEFT(completiondate, 10) BETWEEN ? AND ? ORDER BY id DESC ", [$st, $ed]);
        }


        $this->closeConnection();
        return $filter;
    }
}