<?php

namespace App\Models;

class Badge extends Model
{
    public function setBadge($setter, $team, $desc, $category)//team = (1,2,3)
    {
        $add = $this->insert('tbl_global_badge_info', ['from_user_id', 'to_group_id', 'descriptions', 'badge_category'],
            [$setter, $team, $desc, $category]);
        if ($add) {
            $badge = $this->selectOne("SELECT TOP 1 id FROM tbl_global_badge_info ORDER BY id DESC ");
            $users = $this->selectAll("SELECT userName FROM tbl_mehrabad_dastresi_aza WHERE team_id IN" . $team);
            $this->insert('tbl_global_badge_items', ['badge_id', 'to_user_id', 'host'], [$badge['id'], 'admin', IP]);///for admin
            foreach ($users as $user) {
                $this->insert('tbl_global_badge_items', ['badge_id', 'to_user_id', 'host'], [$badge['id'], $user['userName'], IP]);
            }
        }
        $this->closeConnection();
    }

    public function getBadges($user)
    {
        $badges = $this->selectAll("SELECT tbl_global_badge_info.*, tbl_global_badge_items.created_at as tarikh , tbl_global_badge_items.* FROM tbl_global_badge_info
JOIN tbl_global_badge_items ON tbl_global_badge_items.badge_id=tbl_global_badge_info.id WHERE to_user_id=?", [$user]);
        $this->closeConnection();
        return $badges;
    }
    public function seenBadge($id){
     $this->update("UPDATE tbl_global_badge_items SET seen_at='".georgianNow."' WHERE badge_id=? AND to_user_id=?", [$id, $_SESSION['tkeNn']]);
     $badge =  $this->selectOne("SELECT badge_category as cat FROM tbl_global_badge_info
JOIN tbl_global_badge_items ON tbl_global_badge_items.badge_id=tbl_global_badge_info.id WHERE badge_id=? AND to_user_id=?", [$id, $_SESSION['tkeNn']]);
        $this->closeConnection();
        return $badge;
    }

    public function unreadBadges($user):array
    {
        $badges = $this->selectAll("SELECT tbl_global_badge_info.*, tbl_global_badge_items.* FROM tbl_global_badge_info
JOIN tbl_global_badge_items ON tbl_global_badge_items.badge_id=tbl_global_badge_info.id WHERE to_user_id=? AND seen_at IS NULL", [$user]);
        $this->closeConnection();
        return $badges;
    }

    public function seenAllBadges():bool
    {
        $badge =$this->update("UPDATE tbl_global_badge_items SET seen_at='".georgianNow."' WHERE to_user_id=?", [$_SESSION['tkeNn']]);
        $this->closeConnection();
        return $badge;
    }
}