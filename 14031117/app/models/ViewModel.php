<?php

namespace App\Models;

class ViewModel extends Model
{
        public function getAll()
        {
            $pro = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul");
            $mon = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese");
            $join = $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_mahsoul");
            $this->closeConnection();
            return [$mon, $pro, $join];
        }
    public function details($id)
    {
        $det = $this->selectAll("SELECT * FROM tbl_mehrabad_joziat_mahsoul WHERE mahsoul_cod='$id'");
        $file =  $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod='$id'");
        $this->closeConnection();
        return [$det, $file];
    }
    public function documents($id)
    {
        $files =  $this->selectAll("SELECT * FROM tbl_mehrabad_monaqese_files WHERE mon_cod='$id'");
        $this->closeConnection();
        return $files;
    }
    public function existFiles($cod)
    {
        $files = $this->selectAll("SELECT * FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod='$cod'");
        $this->query('DELETE FROM tbl_mehrabad_mahsoul_files WHERE mahsoul_cod=?', [$cod]);
        $this->closeConnection();
        return $files;
    }
    public function uploadFile($file, $cod)
    {
        $this->insert('tbl_mehrabad_mahsoul_files', ['mahsoul_cod', 'nam', 'type'], [$cod, $file[0], $file[1]]);
        $this->closeConnection();
    }
    public function assignTender($ten, $pro)
    {
        $exist = $this->selectOne("SELECT id FROM tbl_mehrabad_monaqese_mahsoul WHERE mon_cod=? AND mah_cod=?", [$ten, $pro]);
        if($exist){
            $this->closeConnection();
            return false;
        }else {
            $insert = $this->insert('tbl_mehrabad_monaqese_mahsoul', ['mon_cod', 'mah_cod', 'tarikh'], [$ten, $pro, persianNow]);
            $this->closeConnection();
            return $insert;
        }
    }
}