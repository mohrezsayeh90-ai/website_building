<?php

namespace App\Models;

use Exception;

class loginModel extends Model
{
  public function deleteSession($tke): void
  {
      $del = $this->query('DELETE FROM tbl_mehrabad_user_token WHERE user_id=?', [$tke]);
      $this->closeConnection();
  }
    public function selectUser($name)
    {
        $user = $this->selectAll("SELECT tbl_mehrabad_users.userName, tbl_mehrabad_users.userPas, tbl_mehrabad_users.id, ax, tbl_mehrabad_dastresi_aza.team_id as team
FROM tbl_mehrabad_users LEFT JOIN tbl_mehrabad_dastresi_aza ON tbl_mehrabad_dastresi_aza.userName = tbl_mehrabad_users.userName WHERE tbl_mehrabad_users.userName=?",
            [$name]);
        $this->closeConnection();
        try {
            return $user[0]??'';
        }
        catch (Exception $e){

        }


    }
    public function existLogin($id)
    {
        $exist= $this->selectOne("SELECT id, IP, expireDate FROM tbl_mehrabad_user_token WHERE user_id=?", [$id]);
        $this->closeConnection();
        return $exist;
    }
    public function login($id, $tke, $date, $expire)
    {
        $insert= $this->insert('tbl_mehrabad_user_token', ['user_id', 'token', 'setDate', 'expireDate', 'IP'],
            [$id, $tke, $date, $expire, IP]);
        $this->closeConnection();
        return $insert;
    }
    public function updateTkn($tke)
    {
        $upd = $this->update("UPDATE tbl_mehrabad_user_token SET setDate=?, expireDate=?, updated_at=?, IP=? WHERE user_id =?",
            [strtotime(georgianNow), strtotime("+30 minutes", strtotime(georgianNow)), georgianNow, IP, $tke]);
        $this->closeConnection();
        return $upd;
    }
}