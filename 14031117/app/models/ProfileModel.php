<?php

namespace App\Models;

class ProfileModel extends Model
{
    public function user($id)
    {
        $user = $this->selectOne("SELECT TOP 1 * FROM tbl_mehrabad_users WHERE id=? AND deleted_at IS NULL", [$id]);
        $this->closeConnection();
        return $user;
    }
    public function current_AX()
    {
        $currentAx = $this->selectOne("SELECT ax FROM tbl_mehrabad_users WHERE id=?", [$_SESSION['tkn']]);
        $this->closeConnection();
        return $currentAx;
    }
    public function current_sign()
    {
        $currentAx = $this->selectOne("SELECT signature FROM tbl_mehrabad_users WHERE id=?", [$_SESSION['tkn']]);
        $this->closeConnection();
        return $currentAx;
    }
    public function submitProfile($pro)
    {
        $this->update("UPDATE tbl_mehrabad_users SET ax=?, updated_at='".georgianNow."'
         WHERE id=?", [$pro, $_SESSION['tkn']]);
        $this->closeConnection();
    }
    public function submitSign($sgn)
    {
        $this->update("UPDATE tbl_mehrabad_users SET signature=?, updated_at='".georgianNow."'
         WHERE id=?", [$sgn, $_SESSION['tkn']]);
        $this->closeConnection();
    }
    public function submitChange($em, $ph, $ad)
    {
         $this->update("UPDATE tbl_mehrabad_users SET email=?, phone=?, address=?, updated_at='".georgianNow."'
         WHERE id=?", [$em, $ph, $ad, $_SESSION['tkn']]);
         $this->closeConnection();
    }
    public function changePassword($pas)
    {
         $this->update("UPDATE tbl_mehrabad_users SET userPas=?, updated_at='".georgianNow."'
         WHERE id=?", [$pas, $_SESSION['tkn']]);
         $this->closeConnection();
    }
}