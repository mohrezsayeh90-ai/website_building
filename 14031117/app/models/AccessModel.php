<?php

namespace App\Models;

class AccessModel extends Model
{
    public function submitUser($user, $pass, $role)
    {
        $ins = $this->insert('tbl_mehrabad_users', ['userName', 'userPas', 'semat'], [$user, $pass, $role]);
        $this->closeConnection();
        return $ins;
    }
    public function userTeams($user, $team)
    {
        $ins = $this->insert('tbl_mehrabad_dastresi_aza', ['userName', 'team_id'], [$user, $team]);
        $this->closeConnection();
        return $ins;
    }
}