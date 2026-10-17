<?php

namespace App\Models;

class ProjectModel extends Model
{
    public function id()
    {
        $id = $this->selectOne("SELECT TOP 1 proj_code FROM tbl_mehrabad_projects ORDER BY id DESC");

        $idd = $id ? (int)str_replace('P', '', $id['proj_code']) : 0;
        $this->closeConnection();
        return $idd;
    }
    public function getAllCustomer()
    {
        $customers=$this->selectAll("select * from tbl_mehrabad_motaqazian where deleted_at is null or deleted_at='' order by nam");
        return $customers;
    }

    public function insertProj($data)
    {
        $data[]=IP;
        $this->query("delete from tbl_mehrabad_projects_bmp_privileges where proj_code=?",[$data[7]]);
        $this->query("delete from tbl_mehrabad_projects_bpm_mainform_version where proj_code=?",[$data[7]]);
        $this->query("delete from tbl_mehrabad_projects_bpm_info where proj_code=?",[$data[7]]);
        $this->query("insert into tbl_mehrabad_projects_bpm_info(proj_code,process_step_id,process_step_description,next_step_id,labels,process_type,owners) 
                            select N'{$data[7]}',process_step_id,process_step_description,next_step_id,labels,process_type,owners from tbl_mehrabad_projects_bpm_info 
                             where proj_code=N'template' order by id");
        $this->query("insert into tbl_mehrabad_projects_bpm_mainform_version(proj_code,proj_main_forms,main_form_process_step_id,proj_main_forms_version,proj_main_forms_last_accepted_date) 
                            select N'{$data[7]}' ,proj_main_forms,main_form_process_step_id,proj_main_forms_version,proj_main_forms_last_accepted_date from tbl_mehrabad_projects_bpm_mainform_version
                              where proj_code=N'template' order by id");
        $this->query("insert into tbl_mehrabad_projects_bmp_privileges(proj_code,process_step_id,team_or_person,process_privileges,
                                                 technical_info_allowed,financial_info_allowed) 
                            select N'{$data[7]}' ,process_step_id,team_or_person,process_privileges,
                                                 technical_info_allowed,financial_info_allowed from tbl_mehrabad_projects_bmp_privileges
                              where proj_code=N'template' order by id");
        $insert =$this->insert('tbl_mehrabad_projects', ['proj_customer', 'proj_consultant', 'proj_name', 'proj_include_training',
            'proj_include_installation_supervision', 'proj_include_installation', 'proj_include_transport'
            , 'proj_code', 'proj_manager', 'proj_manager_email', 'proj_start_date', 'proj_delivery_place',
            'proj_duration', 'project_warranty_duration','proj_executer','proj_contact_no','proj_late_payment_penalty','host'], $data);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)',  'پروژه ی جدیدی با کد (' . $data[7] . ') ایجاد شد.', 'project');
        }
        $this->closeConnection();
      return $insert;

    }
    public function updateProj($data)
    {
        $data[]=$data[7];
          $this->query(" update tbl_mehrabad_projects set proj_customer=?, proj_consultant=?, proj_name=?, proj_include_training=?,
            proj_include_installation_supervision=?, proj_include_installation=?, proj_include_transport=?
            , proj_code=?, proj_manager=?, proj_manager_email=?, proj_start_date=?, proj_delivery_place=?,
            proj_duration=?, project_warranty_duration=?,proj_executer=?,proj_contact_no=?,proj_late_payment_penalty=? where proj_code=?",$data);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)',  'اطلاعات پروژه با کد (' . $data . ') بروزرسانی شد.', 'project');
        }
        $this->closeConnection();
    }
    public function allProj()
    {
    return $this->selectAll("select * from tbl_mehrabad_projects where proj_status<=2 and (deleted_at is null or deleted_at='') order by proj_start_date desc");
    }
    public function delaProj($projCod){
         $this->query('update tbl_mehrabad_projects set deleted_at=? where proj_code=?',
             [tr_num(jdate('Y/m/d H:i:s')),$projCod]);
        if ($_SESSION['tkeNn']) {
            $bdg = new Badge();
            $bdg->setBadge($_SESSION['tkeNn'], '(500, 501, 507)',  'پروژه با کد (' . $projCod . ') حذف شد.', 'project');
        }
        $this->closeConnection();
    }
    public function getaProjData($projCod)
    {
        return $this->selectAll("select * from tbl_mehrabad_projects where proj_code=?",[$projCod]);
    }
}