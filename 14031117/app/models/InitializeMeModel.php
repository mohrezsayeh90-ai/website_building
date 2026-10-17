<?php

namespace App\Models;

class InitializeMeModel extends Model
{
    public function startInitialize()
    {
        //,'tbl_mehrabad_search'
        $tableNames=['tbl_mehrabad_joziat_mahsoul','tbl_mehrabad_mahsoul',
            'tbl_mehrabad_mahsoul_files','tbl_mehrabad_monaqese','tbl_mehrabad_monaqese_eas','tbl_mehrabad_monaqese_epl',
            'tbl_mehrabad_monaqese_files','tbl_mehrabad_monaqese_mahsoul','tbl_mehrabad_monaqese_proposal',
            'tbl_mehrabad_projects','tbl_mehrabad_projects_additioanl_info','tbl_mehrabad_projects_attachments',
            'tbl_mehrabad_projects_bpm_log','tbl_mehrabad_projects_buy_req_docs','tbl_mehrabad_projects_buy_req_sign',
            'tbl_mehrabad_projects_demands','tbl_mehrabad_projects_dpl','tbl_mehrabad_projects_drafts',
            'tbl_mehrabad_projects_epl','tbl_mehrabad_projects_financial_documents','tbl_mehrabad_projects_financial_info',
            'tbl_mehrabad_projects_financial_items','tbl_mehrabad_projects_risk','tbl_mehrabad_projects_technical_info',
            'tbl_mehrabad_projects_technical_items','tbl_mehrabad_technical_documents'];
        $bpmTables=['tbl_mehrabad_projects_bmp_privileges','tbl_mehrabad_projects_bpm_info',
            'tbl_mehrabad_projects_bpm_mainform_version'];
        for($i=0;$i<count($tableNames);$i++)$this->query("delete from " .$tableNames[$i]);
        for($i=0;$i<count($bpmTables);$i++)$this->query("delete from " .$bpmTables[$i] . " where proj_code<>'template'");
    }
}