<?php
/**
 * CSZ CMS
 *
 * An open source content management system
 *
 * Copyright (c) 2019, Chinawut Phongphasook (CSKAZA).
 *
 * Astian Develop Public License (ADPL)
 * 
 * This Source Code Form is subject to the terms of the Astian Develop Public
 * License, v. 1.0. If a copy of the APL was not distributed with this
 * file, You can obtain one at http://astian.org/about-ADPL
 * 
 * @author	CSKAZA
 * @copyright   Copyright (c) 2019, Chinawut Phongphasook (CSKAZA).
 * @license	http://astian.org/about-ADPL	ADPL License
 * @link	https://www.cszcms.com
 * @since	Version 1.0.0
 */
defined('BASEPATH') || exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//require FCPATH.'system/libraries/PHPMailer/src/Exception.php';
//require FCPATH.'system/libraries/PHPMailer/src/PHPMailer.php';
//require FCPATH.'system/libraries/PHPMailer/src/SMTP.php';
class Csz_admin_model extends CI_Model{
    
    private $cachetime = 0;

    function __construct(){
        parent::__construct();
        $this->load->model('Csz_model');
        if (CACHE_TYPE == 'file') {
            $this->load->driver('cache', array('adapter' => 'file', 'key_prefix' => EMAIL_DOMAIN . '_'));
        } else {
            $this->load->driver('cache', array('adapter' => CACHE_TYPE, 'backup' => 'file', 'key_prefix' => EMAIL_DOMAIN . '_'));
        }
        if($this->load_config()->pagecache_time == 0){
            $this->setcahetime(1);
        }else{
            $this->setcahetime($this->load_config()->pagecache_time);
        }
    }
    
    /**
     * setcahetime
     * Set the cache time (In minute)
     * @param   int $minute   the minute of cache time
     */
    private function setcahetime($minute = 0) {
        if(is_numeric($minute)) $this->cachetime = $minute;
    }

    /**
     * load_config
     *
     * Function for load settings from database
     *
     * @return	object or FALSE
     */
    public function load_config(){
        return $this->Csz_model->load_config();
    }
    
     /**
     * getapplicationsreview Data
     *
     * Function for getting all the applications Reviewed by admin
     */
    public function getapplicationsreview(){

        $query = $this->db->query("select `admin_reviews`.id,`admin_reviews`.rank, `admin_reviews`.application_id,avg(`admin_reviews`.rank) as grant_rank, `grant`.title as grant_name, `application`.status, `application`.complete, `application`.grant_id,
        `applicant`.name applicant_name, `application`.name application_name FROM `admin_reviews` 
        INNER JOIN `application` ON `application`.id = `admin_reviews`.application_id LEFT JOIN `grant` ON `grant`.id = `application`.grant_id
        LEFT JOIN `applicant` ON `applicant`.id = `application`.user_id LEFT JOIN user_admin ON user_admin.user_admin_id = admin_reviews.admin_id 
        LEFT JOIN `user_to_group` ON `user_to_group`.user_admin_id = `user_admin`.user_admin_id LEFT JOIN `user_groups` 
        ON `user_groups`.`user_groups_id` = `user_to_group`.`user_groups_id` GROUP BY `admin_reviews`.application_id,`admin_reviews`.rank  ");
      
        // $query = $this->db->query("select `admin_reviews`.*, `grant`.title grant_name, `application`.status, `application`.complete, `application`.grant_id, `user_admin`.name admin_name,
        // `user_to_group`.user_groups_id is_this_admin, `user_groups`.`name` admin_group_name,
        // `applicant`.name applicant_name, `application`.name application_name FROM `admin_reviews` 
        // INNER JOIN `application` ON `application`.id = `admin_reviews`.application_id LEFT JOIN `grant` ON `grant`.id = `application`.grant_id
        // LEFT JOIN `applicant` ON `applicant`.id = `application`.user_id LEFT JOIN user_admin ON user_admin.user_admin_id = admin_reviews.admin_id 
        // LEFT JOIN `user_to_group` ON `user_to_group`.user_admin_id = `user_admin`.user_admin_id LEFT JOIN `user_groups` 
        // ON `user_groups`.`user_groups_id` = `user_to_group`.`user_groups_id` ORDER BY `admin_reviews`.id ");
        
        return $query->result_array();
    }
    
    
     /**
     * getreviewcomments Data
     *
     * Function for getting all the review of one application Reviewed by  each admin
     */
    public function getreviewcomments($application_id){
        
        if($application_id){
            
            $query = $this->db->query("select `admin_reviews`.*, `grant`.title grant_name, `application`.status, `application`.complete, `application`.grant_id, `user_admin`.name admin_name, 
            `user_to_group`.user_groups_id is_this_admin, `user_groups`.`name` admin_group_name, `applicant`.name applicant_name,
            `application`.name application_name FROM `admin_reviews` INNER JOIN `application` ON `application`.id = `admin_reviews`.application_id 
            LEFT JOIN `grant` ON `grant`.id = `application`.grant_id LEFT JOIN `applicant` ON `applicant`.id = `application`.user_id 
            LEFT JOIN user_admin ON user_admin.user_admin_id = admin_reviews.admin_id LEFT JOIN `user_to_group` ON
            `user_to_group`.user_admin_id = `user_admin`.user_admin_id LEFT JOIN `user_groups` ON  `user_groups`.`user_groups_id` = `user_to_group`.`user_groups_id` 
            WHERE `admin_reviews`.application_id = ".$application_id." ORDER BY `admin_reviews`.id ");
            return $query->result_array();
        }else{
            
            return FALSE;
        }
        
    }
    

    /**
     * getLatestVersion
     *
     * Function for get latest version from xml url
     *
     * @param	string	$xml_url    xml url file
     * @param   bool    $is_ci      CI update check
     * @return	versoin string
     */
    public function getLatestVersion($xml_url = '', $is_ci = FALSE){
        if(!$xml_url){
            $xml_url = $this->config->item('csz_chkverxmlurl_main');
        }
        $xml_url_bak = $this->config->item('csz_chkverxmlurl_backup');
        if($this->Csz_model->is_url_exist($xml_url) !== FALSE){
            $xml_file = $this->Csz_model->get_contents_url($xml_url);
            $xml = simplexml_load_string($xml_file);
            unset($xml_file, $xml_url);
        }else if($this->Csz_model->is_url_exist($xml_url) === FALSE && $this->Csz_model->is_url_exist($xml_url_bak) !== FALSE){
            $xml_file = $this->Csz_model->get_contents_url($xml_url_bak);
            $xml = simplexml_load_string($xml_file);
            unset($xml_file, $xml_url_bak);
        }else{
            $xml = FALSE;
        }
        if($is_ci === FALSE){
            if($xml !== FALSE){
                return $xml->version;
            }else{
                $xml_cur = $this->Csz_model->getVersion();
                if($xml_cur && strpos($xml_cur, 'Beta') !== false){
                    $vercur = str_replace(' Beta', '', $xml_cur);
                    $cur_xml = explode('.', $vercur);
                    $xml_version = $cur_xml[0].'.'.$cur_xml[1].'.'.($cur_xml[2] - 1);
                    unset($xml_cur, $vercur, $cur_xml);
                }else{
                    $xml_version = $xml_cur;
                    unset($xml_cur);
                }
                return $xml_version;
            }
        }else{
            if($xml !== FALSE){
                return $xml->ci_version;
            }else{
                return CI_VERSION;
            }
        }
    }
    
  
     /**
     * updateinsertReview Data
     *
     * Function for insert/update review on admin_reviews by admin
     */
     public function updateinsertReview($data,$application_id){
         
         $search_arr = array("application_id"=>$application_id , "admin_id"=>$this->session->userdata('user_admin_id'));
         $admin_reviews = $this->Csz_admin_model->getIndexData('admin_reviews', '', '', 'id', 'DESC', $search_arr);
         if(empty($admin_reviews)){

            if($this->db->insert('admin_reviews',$data)){
                 return $this->db->insert_id();
            }else{
                 return false;
            }
         }else{
             $this->db->where('application_id',$application_id);
             $this->db->where('admin_id',$this->session->userdata('user_admin_id'));
             if($this->db->update('admin_reviews',$data)){
                 return $admin_reviews[0]['id'];
             }else{
                 return false;
             } 
         }     
         
     }

     public function  checkForDuplicateRank($rank,$admin_id,$grant_id){
         $query = $this->db->query("SELECT ar.id,ar.application_id FROM admin_reviews as ar inner join application as app on ar.application_id = app.id WHERE ar.admin_id = ".$admin_id." AND ar.rank = ".$rank." AND app.grant_id = ".$grant_id);

         if (!empty($query) && $query->num_rows() > 0) {
             $row = $query->row_array();
         } else {
             $row = FALSE;
         }
         return $row;
     }
    
    
    /**
     * getApplicantlist Data
     *
     * Function for getting all the applicant list with grant name (with how many applications a applicant applied)
     */
    public function getApplicantlist($where){

        $query = $this->db->query("SELECT `applicant`.*, GROUP_CONCAT(`grant`.title) AS grant_name FROM `applicant` 
        LEFT JOIN `application` ON `application`.user_id = `applicant`.id LEFT JOIN `grant` ON `application`.grant_id = `grant`.id WHERE ".$where." 
        GROUP by applicant.id ORDER BY applicant.id desc");
        return $query->result_array();
    }
    
    /**
     * getCountFromApplicant Data
     *
     * Function for getting all the count rows for different status
     */
    public function getCountFromApplicant($year){
        $query = $this->db->query("select 
                                    sum(case when (status=1 AND complete = 1 and YEAR(addon) = ".$year.") then 1 else 0 end) as completed_profile, 
                                    sum(case when (status=1 AND complete = 0 and YEAR(addon) = ".$year.") then 1 else 0 end) as activated_profiles, 
                                    sum(case when (status=0 AND complete = 0 and YEAR(addon) = ".$year.") then 1 else 0 end) as inactive_profile, 
                                    sum(case when (gender = 1 AND complete = 1 and YEAR(addon) = ".$year.") then 1 else 0 end) as male_g, 
                                    sum(case when (gender = 2 AND complete = 1 and YEAR(addon) = ".$year.") then 1 else 0 end) as female_g, 
                                    sum(case when (gender = 3 AND complete = 1 and YEAR(addon) = ".$year.") then 1 else 0 end) as non_binary,  
                                    sum(case when (gender = 4 AND complete = 1 and YEAR(addon) = ".$year.") then 1 else 0 end) as rather_not_say, 
                                    sum(case when (YEAR(addon) = ".$year.") then 1 else 0 end) as total_applicant
                                    from applicant");
        return $query->row_array();
    }
    
    
    /**
     * getCountFromApplication Data
     *
     * Function for getting all the count rows for different status
     */
    public function getCountFromApplication($year){
        $query = $this->db->query("select 
                                   sum(case when (status=0 and YEAR(addon) = ".$year.") then 1 else 0 end) as all_applications,
                                   sum(case when (status=0 and YEAR(addon) = ".$year." and complete=0 ) then 1 else 0 end) as incomplete_applications, 
                                   sum(case when (status=0 and YEAR(addon) = ".$year." and complete=1 ) then 1 else 0 end) as submitted_applications,  
                                   sum(case when (status=2 and YEAR(addon) = ".$year.") then 1 else 0 end) as rejected_applications, 
                                   sum(case when (status=3 and YEAR(addon) = ".$year.") then 1 else 0 end) as shortlisted_applications,
                                   sum(case when (status=4 and YEAR(addon) = ".$year.") then 1 else 0 end) as preselected_applications,
                                   sum(case when (status=1 and YEAR(addon) = ".$year.") then 1 else 0 end) as accepted_applications    
                                   from application");
        return $query->row_array();
    }
    

    /**
     * getPreviousVersion
     *
     * Function for get previous version from xml url
     *
     * @param	string	$xml_url    xml url file
     * @param   bool    $is_ci      CI update check
     * @return	versoin string
     */
    public function getPreviousVersion($xml_url = '', $is_ci = FALSE){
        if(!$xml_url){
            $xml_url = $this->config->item('csz_chkverxmlurl_main');
        }
        $xml_url_bak = $this->config->item('csz_chkverxmlurl_backup');
        if($this->Csz_model->is_url_exist($xml_url) !== FALSE){
            $xml_file = $this->Csz_model->get_contents_url($xml_url);
            $xml = simplexml_load_string($xml_file);
            unset($xml_file, $xml_url);
        }else if($this->Csz_model->is_url_exist($xml_url) === FALSE && $this->Csz_model->is_url_exist($xml_url_bak) !== FALSE){
            $xml_file = $this->Csz_model->get_contents_url($xml_url_bak);
            $xml = simplexml_load_string($xml_file);
            unset($xml_file, $xml_url_bak);
        }else{
            $xml = FALSE;
        }
        if($is_ci === FALSE){
            if($xml !== FALSE){
                return $xml->previous;
            }else{
                $xml_cur = str_replace(' Beta', '', $this->Csz_model->getVersion());
                return $this->Csz_model->getNextVersion($xml_cur, -1);
            }
        }else{
            if($xml !== FALSE){
                return $xml->ci_previous;
            }else{
                return $this->Csz_model->getNextVersion(CI_VERSION, -1);
            }
        }
        
    }
    
    /**
     * chkVerUpdate
     *
     * Function for check version for update
     *
     * @param	string	$cur_ver    current version
     * @param	string	$xml_url    xml url file
     * @param   bool    $is_ci      CI update check
     * @return	true or false
     */
    public function chkVerUpdate($cur_ver, $xml_url = '', $is_ci = FALSE){
        $last_ver = $this->getLatestVersion($xml_url, $is_ci);
        if($last_ver){
            return $this->Csz_model->chkVerUpdate($cur_ver, $last_ver);
        }else{
            return FALSE;
        }
    }

    /**
     * findNextVersion
     *
     * Function for check version for update
     *
     * @param	string	$cur_txt    current version
     * @param	string	$xml_url    xml url file
     * @param   bool    $is_ci      CI update check
     * @return	string or false
     */
    public function findNextVersion($cur_txt, $xml_url = '', $is_ci = FALSE){
        $last_ver = $this->getLatestVersion($xml_url, $is_ci);
        $previous_ver = $this->getPreviousVersion($xml_url, $is_ci);
        if($last_ver){
            return $this->Csz_model->findNextVersion($cur_txt, $last_ver, $previous_ver);
        }else{
            return FALSE;
        }
    }

    /**
     * getLang
     *
     * Function for get backend language
     *
     * @return	string
     */
    public function getLang(){
        /* Get Lang for Admin */
        $row = $this->load_config();
        return $row->admin_lang;
    }

    /**
     * getCurPages
     *
     * Function for count in the tableget current for backend
     *
     * @return	string
     */
     
     
     public function saveRegister(){
         $data = array('email' =>$this->input->post('email'),'name' =>$this->input->post('name'), 'password' => md5($this->input->post('password')));
         if($this->db->insert('applicant',$data)){

			$to      = $this->input->post('email');
			$subject = 'Doca | Thank you for registering';
			$message = 'Hello '.$this->input->post('name')."\r\n" ;
			$message.="<br><br>Thank you for registering on our website Documentary Africa. Please click on the verify below to verify your email and complete your profile to be eligible for grant applications.<br><br><a href='".base_url('verify?verify='.base64_encode($this->input->post('email')))."'>Verify</a>";

             $mail = new PHPMailer(true);

             try {
                 // SMTP Configuration for Gmail
                 $mail->isSMTP();
                 $mail->Host       = 'smtp.gmail.com';
                 $mail->SMTPAuth   = true;
                 $mail->Username   = 'no-reply@documentaryafrica.org';
                 $mail->Password   = 'pgio rbxd mqzw lppu';
                 $mail->SMTPSecure = 'tls';
                 $mail->Port       = 587;

                 // Sender and recipient settings
                 $mail->setFrom('no-reply@documentaryafrica.org', 'Documentary Africa');
                 $mail->addAddress($to, $this->input->post('name'));

                 // Email content
                 $mail->isHTML(true);
                 $mail->Subject = $subject;
                 $mail->Body    = $message;

                 $mail->send();
                 echo 'Email sent successfully.';
             } catch (Exception $e) {
                 echo "Email could not be sent. Error: {$mail->ErrorInfo}";
             }
	    	
             return true;
         }else{
             return false;
         }
     }
     
     public function uploadDoc(){
         $upload_file = '';
         if(!empty($_FILES['file_upload'])){
            try{
                $paramiter = '_1';
                $photo_id = time();
                $uploaddir = 'photo/image/';
                $file_f = $_FILES['file_upload']['tmp_name'];
                $file_name = $_FILES['file_upload']['name'];
                $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
            }catch(Exception $e){
                print_r($e->getMessage());
                die();
            }
            
        }
        // print_r($upload_file);
        // die();
        return $upload_file;
     }

     public function uploadDocDynamic($file_name){
        $upload_file = '';
        if(!empty($_FILES[$file_name])){
           try{
               $paramiter = '_1';
               $photo_id = time();
               $uploaddir = 'photo/image/';
               $file_f = $_FILES[$file_name]['tmp_name'];
               $file_name = $_FILES[$file_name]['name'];
               $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
           }catch(Exception $e){
               print_r($e->getMessage());
               die();
           }
           
       }
       // print_r($upload_file);
       // die();
       return $upload_file;
    }
	
	 public function visual_upload(){
         $upload_file = '';
         if(!empty($_FILES['visual_upload'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['visual_upload']['tmp_name'];
            $file_name = $_FILES['visual_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
	
	public function artistic_upload(){
         $upload_file = '';
         if(!empty($_FILES['artistic_upload'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['artistic_upload']['tmp_name'];
            $file_name = $_FILES['artistic_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
     public function proofFile_upload(){
         $upload_file = '';
         if(!empty($_FILES['proofFile'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['proofFile']['tmp_name'];
            $file_name = $_FILES['proofFile']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
      public function disability_upload(){
         $upload_file = '';
         if(!empty($_FILES['disability_upload'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['disability_upload']['tmp_name'];
            $file_name = $_FILES['disability_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
     public function upload_budgetFile(){
         $upload_file = '';
         if(!empty($_FILES['budgetFile'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['budgetFile']['tmp_name'];
            $file_name = $_FILES['budgetFile']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
     public function upload_filmmanker(){
         $upload_file = '';
         if(!empty($_FILES['filmmanker'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['filmmanker']['tmp_name'];
            $file_name = $_FILES['filmmanker']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
     public function upload_producer(){
         $upload_file = '';
         if(!empty($_FILES['producer'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['producer']['tmp_name'];
            $file_name = $_FILES['producer']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
     
     public function upload_project_co_ordinator(){
         $upload_file = '';
         if(!empty($_FILES['project_co_ordinator'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['project_co_ordinator']['tmp_name'];
            $file_name = $_FILES['project_co_ordinator']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        return $upload_file;
     }
     
     public function updateApplicant($data){
         $this->db->where('id',$this->session->userdata('user_id'));
         if($this->db->update('applicant',$data)){
             return true;
         }else{
             return false;
         }
     }
     
     public function updateApplication($data,$id){
         
         $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$id;
         $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
         if(empty($application)){
            $data['grant_id'] = $id;
            $data['user_id'] = $this->session->userdata('user_id');
             if($this->db->insert('application',$data)){
                 return $this->db->insert_id();
             }else{
                 return false;
             }
         }else{
             $this->db->where('grant_id',$id);
             $this->db->where('user_id',$this->session->userdata('user_id'));
            if($this->db->update('application',$data)){
                 return $application[0]['id'];
             }else{
                 return false;
             } 
         }     
         
     }
     
    public function updateEditedApplication($data,$application_id){
         
         $search_arr = "id = ".$application_id;
         $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
         if(empty($application)){
            return false;
         }else{
            $this->db->where('id',$application_id);
            $this->db->where('user_id',$this->session->userdata('user_id'));
            if($this->db->update('application',$data)){
                return $application[0]['id'];
            }else{
                return false;
            } 
        }   
    }
     
     public function budgetStore($dataAdd,$id){
         $count = count($dataAdd['fundingSource']);
        //  $count = $count - 1;
        $this->db->where('application_id',$id);
        $this->db->delete('budget');
        for($i=0;$i<($count);$i++){
            // $data['grant_id'] = $id;
            $data['application_id'] = $id;
            $data['fundingSource'] = $dataAdd['fundingSource'][$i];
            $data['amount'] = $dataAdd['amount'][$i];
            $data['status'] = $dataAdd['status'][$i];
             $this->db->insert('budget',$data);
         }
        //  die;
     }
     
        public function projectStore($dataAdd,$id){
         $count = count($dataAdd['project_link']);
        //  $count = $count - 1;
        $this->db->where('application_id',$id);
        $this->db->delete('project_link');
        for($i=0;$i<($count);$i++){
            // $data['grant_id'] = $id;
            $data['application_id'] = $id;
            $data['project_link'] = $dataAdd['project_link'][$i];
            $data['project_password'] = $dataAdd['project_password'][$i];
             $this->db->insert('project_link',$data);
         }
        //  die;
     }
     
      public function memberStore($dataAdd,$id){

         $count = count($dataAdd['name']);
        //  $count = $count - 1;
        $this->db->where('application_id',$id);
        $this->db->delete('members');
        for($i=0;$i<($count);$i++){
            // $data['grant_id'] = $id;
            $data['application_id'] = $id;
            $data['user_id'] = $this->session->userdata('user_id');
            $data['name'] = $dataAdd['name'][$i];
            $data['role'] = $dataAdd['role'][$i];
             $this->db->insert('members',$data);
         }
     }
     
      public function contractStore($dataAdd,$id){
         $count = count($dataAdd['contract_id']);
        //  $count = $count - 1;
        $answer = $dataAdd['answer'];
        $this->db->where('application_id',$id);
        $this->db->delete('contract_save');
        for($i=0;$i<($count);$i++){
           
            $data['application_id'] = $id;
            $data['contract_id'] = $dataAdd['contract_id'][$i];
            $nid = $dataAdd['contract_id'][$i];
            $data['answer'] = $answer['answer'.$nid] ? 1 : 0;
            // print_r('file'.$nid); echo "<br>";
            $upload_file = '';
            if(!empty($_FILES['file'.$nid]['name'])){
                $paramiter = '_1';
                $photo_id = time();
                $uploaddir = 'photo/image/';
                $file_f = $_FILES['file'.$nid]['tmp_name'];
                $file_name = $_FILES['file'.$nid]['name'];
                $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
            }
            $data['upload_file'] = $upload_file; 
             $this->db->insert('contract_save',$data);
         }
        //  echo "<pre>";
        //  print_r($dataAdd);
        //  die;
     }
     
  
//   ---------------------------------------------------------------------  //  
    // public function contractStoreUpdateInsert($dataAdd,$id){
       
    //     $count = count($dataAdd['contract_id']);
    //     $wgre = array('application_id' => $id);
        
    //     $answer = $dataAdd['answer'];
        
    //     $count1 = $this->Csz_model->countData('contract_save', $wgre);
    //     //======== insert case
    //     if ($count1 === FALSE || $count1 < 1) {
            
    //         for($i=0;$i<($count);$i++){
           
    //             $data['application_id'] = $id;
    //             $data['contract_id'] = $dataAdd['contract_id'][$i];
    //             $nid = $dataAdd['contract_id'][$i];
    //             $data['answer'] = $answer['answer'.$nid] ? 1 : 0;
    //             if($nid == 11){
    //                 $data['answer'] =  1;
    //             }
    //             $upload_file = '';
    //             if(!empty($_FILES['file'.$nid]['name'])){
    //                 $paramiter = '_1';
    //                 $photo_id = time();
    //                 $uploaddir = 'photo/image/';
    //                 $file_f = $_FILES['file'.$nid]['tmp_name'];
    //                 $file_name = $_FILES['file'.$nid]['name'];
    //                 $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
    //             }
    //             $data['upload_file'] = $upload_file; 
    //              $this->db->insert('contract_save',$data);
    //          }
          
    //         $this->db->insert('contract_save', $data);
    //     ///=========== update case =================
    //     }else{
    //         for($i=0;$i<($count);$i++){
               
    //             $nid = $dataAdd['contract_id'][$i];
    //             $data= [];
    //             $data['answer'] = $answer['answer'.$nid] ? 1 : 0;
    //             if($nid == 11){
    //                 $data['answer'] =  1;
    //             }
    //             $upload_file = '';
    //             if(!empty($_FILES['file'.$nid]['name'])){
                    
    //                 $data['upload_file'] = "";
    //                 $paramiter = '_1';
    //                 $photo_id = time();
    //                 $uploaddir = 'photo/image/';
    //                 $file_f = $_FILES['file'.$nid]['tmp_name'];
    //                 $file_name = $_FILES['file'.$nid]['name'];
    //                 $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
                    
    //                 $data['upload_file'] = $upload_file; 
    //             }
    //             $this->db->where('application_id', $id);
    //             $this->db->where('contract_id', $dataAdd['contract_id'][$i]);
    //             $this->db->update('contract_save', $data);
                
    //             // $this->db->insert('contract_save',$data);
    //         }
    //     }
    // }
//   =--------------------------------------------------------------------  // 


    public function contractStoreUpdateInsert($contract_id, $answer11, $contractfile11, $id){
        
        $response = "";
        $wgre = array('application_id' => $id, "contract_id"=>$contract_id);
        $data['upload_file'] = $contractfile11;  //  OLD FILE IF ALREADY UPLOADED 
        if(!empty($_FILES['file11'])){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['file11']['tmp_name'];
            $file_name = $_FILES['file11']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
            $data['upload_file'] =  $upload_file;
        }
        $count1 = $this->Csz_model->countData('contract_save', $wgre);
        //======== insert case
        if ($count1 === FALSE || $count1 < 1) {
            
            $data['application_id'] = $id;
            $data['contract_id'] = $contract_id;
            $data['answer'] = $answer11;
            $response = $this->db->insert('contract_save', $data);
        ///=========== update case =================
        }else{

            $data['answer'] = $answer11;
            $this->db->where('application_id', $id);
            $this->db->where('contract_id', $contract_id);
            $response = $this->db->update('contract_save', $data);
        }
        
        return $a;
    }
 
 

      public function teamStore($id){
        $dataAdd = $this->input->post();
         $team = $dataAdd['team'];
        //  $count = $count - 1;
        $this->db->where('application_id',$id);
        $this->db->delete('team_store');
        foreach($team as $vl){
            // $data['grant_id'] = $id;
            $data['application_id'] = $id;
            $data['project_role'] = $vl;
            $data['name'] = $dataAdd['name_'.$vl];
            $data['phone'] = $dataAdd['phone_'.$vl];
            $data['email'] = $dataAdd['email_'.$vl];
            $data['country'] = $dataAdd['country_'.$vl];
            $data['project_link'] = $dataAdd['project_link_'.$vl];
            $data['project_password'] = $dataAdd['project_password_'.$vl];
            // print_r('file'.$nid); echo "<br>";
            $upload_file = '';
            if(!empty($_FILES['cv_'.$vl])){
                $paramiter = 'cv_1'.$vl;
                $photo_id = time();
                $uploaddir = 'photo/image/';
                $file_f = $_FILES['cv_'.$vl]['tmp_name'];
                $file_name = $_FILES['cv_'.$vl]['name'];
                $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
            }
            $data['cv'] = $upload_file; 

            $upload_file = '';
            if(!empty($_FILES['proof_'.$vl])){
                $paramiter = 'proof_1'.$vl;
                $photo_id = time();
                $uploaddir = 'photo/image/';
                $file_f = $_FILES['proof_'.$vl]['tmp_name'];
                $file_name = $_FILES['proof_'.$vl]['name'];
                $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
            }
            $data['proof'] = $upload_file; 


             $this->db->insert('team_store',$data);
             // print_r($data);
             // echo "<br>";
         }
         // echo "<pre>";
         // print_r($dataAdd);
         // echo "<br>";
         // print_r($team);
         // die;
     }

     
     public function loginCheck(){
         $search_arr = "status=1 AND email='".$this->input->post('email')."'";
         $data = $this->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
         if(!empty($data)){
             if($data[0]['password']==md5($this->input->post('password'))){
                 $user = array(
                     'user_id' => $data[0]['id'],
                     'email' => $data[0]['email'],
                     );
                $this->session->set_userdata($user);   
                 return array('status'=>1, 'msg'=>'Login successfully');
             }else{
                 return array('status'=>0, 'msg'=>'Password did not match');
             }
         }else{
            return array('status'=>0, 'msg'=>'Email did not match'); 
         }
     }
          public function creategrant($id){
        //  print_r($this->input->post()); die;
        // $eligibility = $this->input->post('eligibility');
        // $grant_type = $this->input->post('grant_type');
         if(empty($id)){
            //  print_r($this->input->post()); die;
             $upload_file = '';
        if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }

            // print_r($this->input->post()); die;
             $data = array('title'=>$this->input->post('title'),
             'description' => $this->input->post('description'),
             'eligibility' => $this->input->post('eligibility'),
             'grant_type' => $this->input->post('grant_type'),
			 'description_type' => $this->input->post('description_type'),
             'contract' => $this->input->post('contract'),
             'startDate' => $this->input->post('startDate'),
             'endDate' => $this->input->post('endDate'),
             'project_summary_form_id' => $this->input->post('project_summary_form'),
             'project_description_form_id' => $this->input->post('project_description_form'),
             'active' => ($this->input->post('active') ? 1 : 0),
             'image' =>$upload_file
             );
             $this->db->insert('grant',$data);
             
             return true;
         }else{
             $upload_file = '';
        if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/image/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
if($this->input->post('del_file')){
                $upload_file = '';
                @unlink('photo/image/'.$this->input->post('del_file', TRUE));
            }else{
                $upload_file = $this->input->post('image');
                if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
                    $paramiter = '_1';
                    $photo_id = time();
                    $uploaddir = 'photo/image/';
                    $file_f = $_FILES['file_upload']['tmp_name'];
                    $file_name = $_FILES['file_upload']['name'];
                    $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('image', TRUE), $uploaddir, $photo_id, $paramiter);
                }
            }
            $data = array('title'=>$this->input->post('title'),
             'description' => $this->input->post('description'),
             'eligibility' => $this->input->post('eligibility'),
             'grant_type' => $this->input->post('grant_type'),
			 'description_type' => $this->input->post('description_type'),
             'contract' => $this->input->post('contract'),
             'startDate' => $this->input->post('startDate'),
             'endDate' => $this->input->post('endDate'),
             'project_summary_form_id' => $this->input->post('project_summary_form'),
             'project_description_form_id' => $this->input->post('project_description_form'),
             'active' => ($this->input->post('active') ? 1 : 0),
             'image' =>$upload_file
             );
             $this->db->where('id',$id);
             $this->db->update('grant',$data);
             
             return true;
         }
     }
     
     public function deleteData($tbl,$id,$f){
         $this->db->where($f,$id);
         if($this->db->delete($tbl)){
            return true;
        }else{
            return false;
        }
     }
     
     
    public function getCurPages(){
        $totSegments = $this->uri->total_segments();
        if(!is_numeric($this->uri->segment($totSegments)) && $this->uri->segment($totSegments) != 'new' && $this->uri->segment($totSegments) != 'add'){
            $pageURL = $this->uri->segment($totSegments);
        }else if(is_numeric($this->uri->segment($totSegments)) || $this->uri->segment($totSegments) == 'new' || $this->uri->segment($totSegments) == 'add'){
            if($this->uri->segment($totSegments - 1) == 'edit' || $this->uri->segment($totSegments - 1) == 'view'){
                $pageURL = $this->uri->segment($totSegments - 2);
            }else{
                $pageURL = $this->uri->segment($totSegments - 1);
            }
        }
        if($pageURL == ""){
            $pageURL = "admin";
        }
        return $pageURL;
    }

    /**
     * countTable
     *
     * Function for count in the table
     *
     * @param	string	$table    DB table
     * @param	string	$search_sql    DB condition
     * @return	int
     */
    public function countTable($table, $search_sql = ''){
        //return $this->db->count_all($table);
        return $this->Csz_model->countData($table, $search_sql);
    }

    /**
     * pageSetting
     *
     * Function for pagination settings
     *
     * @param	string	$base_url    Base url for link
     * @param	string	$total_row   Total result
     * @param	string	$result_per_page    result limit per page
     * @param	string	$num_link    Number for show the page exclude ...
     * @param	string	$uri_segment    Uri secment for use pageination
     */
    public function pageSetting($base_url, $total_row, $result_per_page, $num_link, $uri_segment = ''){
        if(!$uri_segment){
            $uri_segment = 3;
        }
        $this->load->library('pagination');
        $config = array();
        $suffix_url = '';
        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_row;
        $config["per_page"] = $result_per_page;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = FALSE;
        if(count($_GET) > 0){
            $suffix_url = '?'.http_build_query($_GET, '', "&");
            $config['suffix'] = $suffix_url;
        }
        $config['first_url'] = $config['base_url'].$suffix_url;
        $config['num_links'] = $num_link;
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config["uri_segment"] = $uri_segment;
        $this->pagination->initialize($config);
        unset($config, $suffix_url);
    }

    /**
     * getIndexData
     *
     * Function for get data for index page (support pageination)
     * 
     * @param	string	$table    DB table
     * @param	string	$limit    DB limit
     * @param	string	$offset   DB offset
     * @param	string	$orderby  DB order by field. Default is 'timestamp_create'
     * @param	string	$sort     DB sort by asc or desc. Default is 'desc'
     * @param	string	$search_sql    DB where condition. NULL if not need. Example "name='Joe' AND status LIKE '%boss%' OR status1 LIKE '%active%" for string. And array('field'=>'value') for array
     * @param	string	$groupby    DB group by field. NULL if not need 
     * @param	string	$join_db   Table to join or NULL 
     * @param	string	$join_where   Join condition or NULL  
     * @param	string	$join_type   Join type ('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER') or NULL
     * @param	string	$sel_field   DB field select. Default is (*)
     * @return	array
     */
    public function getIndexData($table, $limit = 0, $offset = 0, $orderby = '', $sort = '', $search_sql = '', $groupby = '', $join_db = '', $join_where = '', $join_type = '', $sel_field = '*'){
        // Get a list of all user accounts
        $count = $this->Csz_model->countData($table, $search_sql, $groupby, $orderby, $sort, $join_db, $join_where, $join_type);
        $this->db->select($sel_field);
        if($join_db && $join_where){
            $this->db->join($join_db, $join_where, $join_type);
        }
        if($search_sql){
            if(is_array($search_sql)){
                foreach($search_sql as $key => $value){
                    $this->db->where($key, $value);
                }
            }else{
                $this->db->where($search_sql);
            }
        }
        if($orderby && $sort){           
            $this->db->order_by($orderby, $sort);
        }elseif($orderby){
            $this->db->order_by($orderby);
        }
        if($groupby)
            $this->db->group_by($groupby);
        if($limit && $limit != 0){
            if($offset > ceil((intval($count) / intval($limit))))
                $offset = ceil((intval($count) / intval($limit)));
            $start = (intval($offset) * intval($limit)) - intval($limit);
            if($start < 0)
                $start = 0;
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get($table);
        if(!empty($query)){
            if($query->num_rows() > 0){
                $row = $query->result_array();
                return $row;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
        unset($query, $row);
    }

    /**
     * getUser
     *
     * Function for get member data
     *
     * @param	string	$id    member id
     * @return	object or FALSE
     */
    public function getUser($id, $type = ''){
        // Get the user details
        $sql_where = "user_admin_id = '".$id."'";
        if($type){
            $sql_where.= " AND user_type = '".$type."'";
        }
        $rows = $this->Csz_model->getValue('*', 'user_admin', $sql_where, '', 1);
        if($rows !== FALSE){
            return $rows;
        }else{
            return FALSE;
        }
    }

    /**
     * getUserEmail
     *
     * Function for get member email
     *
     * @param	string	$id    member id
     * @return	string
     */
    public function getUserEmail($id){
        // Get the user email address
        if (!$this->cache->get('getUserEmail_'.$id)) {
            $rows = $this->Csz_model->getValue('email', 'user_admin', "user_admin_id", $id, 1);
            if($rows !== FALSE){
                $return = $rows->email;
            }else{
                $return = FALSE;
            }
            $this->cache->save('getUserEmail_'.$id, $return, ($this->cachetime * 60));
            unset($return, $rows);
        }
        return $this->cache->get('getUserEmail_'.$id);
    }

    /**
     * createUser
     *
     * @param	string	$member    member is TRUE
     * Function for create the new user
     */
    public function createUser($member = FALSE){
        // Create the user account
        if($this->input->post('active')){
            $active = $this->input->post('active', TRUE);
        }else{
            $active = 0;
        }
        if($this->input->post('pass_change') == 'yes'){
            $pass_change = 0;
        }else{
            $pass_change = 1;
        }
        if($this->input->post('year', TRUE) && $this->input->post('month', TRUE) && $this->input->post('day', TRUE)){
            $birthday = $this->input->post('year', TRUE).'-'.$this->input->post('month', TRUE).'-'.$this->input->post('day', TRUE);
        }else{
            $birthday = '';
        }
        $upload_file = '';
        if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/profile/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        $data = array(
            'name' => $this->Csz_model->cleanOSCommand($this->input->post('name', TRUE)),
            'email' => $this->input->post('email', TRUE),
            'password' => $this->Csz_model->pwdEncypt($this->input->post('password', TRUE)),
            'first_name' => $this->Csz_model->cleanOSCommand($this->input->post('first_name', TRUE)),
            'last_name' => $this->Csz_model->cleanOSCommand($this->input->post('last_name', TRUE)),
            'birthday' => $birthday,
            'gender' => $this->input->post('gender', TRUE),
            'address' => $this->Csz_model->cleanOSCommand($this->input->post('address', TRUE)),
            'phone' => $this->Csz_model->cleanOSCommand($this->input->post('phone', TRUE)),
            'picture' => $upload_file,
            'active' => $active,
            'md5_hash' => md5(time() + mt_rand(1, 99999999)),
            'pm_sendmail' => 1,
            'pass_change' => $pass_change,
        );
        if($member === FALSE){
            $this->db->set('user_type', 'admin');
        }else{
            $this->db->set('user_type', 'member');
        }
        $this->db->set('md5_lasttime', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('user_admin', $data);
        $this->db->set('user_admin_id', $this->db->insert_id());
        $this->db->set('user_groups_id', $this->input->post('group', TRUE));
        $this->db->insert('user_to_group');
    }

    /**
     * updateUser
     *
     * Function for update the user
     *
     * @param	string	$id    member id
     * @param	bool	$backend   TRUE for login on backend
     * @return	TRUE or FALSE
     */
    public function updateUser($id, $backend = TRUE){
        $query = $this->Csz_model->chkPassword($this->session->userdata('admin_email'), $this->input->post('cur_password', TRUE), $backend);
        if($query['num_rows'] > 0){
            // update the user account
            if($this->input->post('active')){
                $active = $this->input->post('active', TRUE);
            }else{
                $active = 0;
            }
            if($this->input->post('pm_sendmail')){
                $pm_sendmail = $this->input->post('pm_sendmail', TRUE);
            }else{
                $pm_sendmail = 0;
            }
            if($this->input->post('pass_change') == 'yes'){
                $pass_change = 0;
            }else{
                $pass_change = 1;
            }
            if($this->input->post('year', TRUE) && $this->input->post('month', TRUE) && $this->input->post('day', TRUE)){
                $birthday = $this->input->post('year', TRUE).'-'.$this->input->post('month', TRUE).'-'.$this->input->post('day', TRUE);
            }else{
                $birthday = '';
            }
            if($this->input->post('del_file')){
                $upload_file = '';
                @unlink('photo/profile/'.$this->input->post('del_file', TRUE));
            }else{
                $upload_file = $this->input->post('picture');
                if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
                    $paramiter = '_1';
                    $photo_id = time();
                    $uploaddir = 'photo/profile/';
                    $file_f = $_FILES['file_upload']['tmp_name'];
                    $file_name = $_FILES['file_upload']['name'];
                    $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('picture', TRUE), $uploaddir, $photo_id, $paramiter);
                }
            }
            $this->db->set('name', $this->Csz_model->cleanOSCommand($this->input->post("name", TRUE)), TRUE);
            $this->db->set('email', $this->input->post('email', TRUE), TRUE);
            if($this->input->post('password') != ''){
                $this->db->set('password', $this->Csz_model->pwdEncypt($this->input->post('password', TRUE)), TRUE);
                $this->db->set('md5_hash', md5(time() + mt_rand(1, 99999999)), TRUE);
                $this->db->set('md5_lasttime', $this->Csz_model->timeNow(), TRUE);
                $this->db->set('pass_change', 1);
            }
            if($id != 1 && $this->session->userdata('user_admin_id') != $id){
                $this->db->set('active', $active, FALSE);
                $this->db->set('user_type', $this->input->post("user_type", TRUE), TRUE);
                if($this->input->post('password') == ''){ $this->db->set('pass_change', $pass_change); }
            }
            $this->db->set('first_name', $this->Csz_model->cleanOSCommand($this->input->post("first_name", TRUE)), TRUE);
            $this->db->set('last_name', $this->Csz_model->cleanOSCommand($this->input->post("last_name", TRUE)), TRUE);
            $this->db->set('birthday', $birthday, TRUE);
            $this->db->set('gender', $this->input->post("gender", TRUE), TRUE);
            $this->db->set('address', $this->Csz_model->cleanOSCommand($this->input->post("address", TRUE), TRUE));
            $this->db->set('phone', $this->Csz_model->cleanOSCommand($this->input->post("phone", TRUE)), TRUE);
            $this->db->set('picture', $upload_file, TRUE);
            $this->db->set('pm_sendmail', $pm_sendmail, FALSE);
            $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
            $this->db->where('user_admin_id', $id);
            $this->db->update('user_admin');
            if($id != 1 && $this->session->userdata('user_admin_id') != $id){
                $user_groups_id = $this->input->post("group", TRUE);
                $data = array(
                    'user_admin_id' => $id
                );
                $count = $this->Csz_model->countData('user_to_group', $data);
                if ($count === FALSE || $count < 1) {
                    $this->db->set('user_groups_id', $user_groups_id);
                    $this->db->insert('user_to_group', $data);
                }else{
                    $this->db->set('user_groups_id', $user_groups_id);
                    $this->db->where('user_admin_id', $id);
                    $this->db->update('user_to_group');
                }
            }
            $this->Csz_model->clear_file_cache('getUserEmail*', TRUE);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * removeUser
     *
     * Function for remove the user
     *
     * @param	string	$id    member id
     */
    public function removeUser($id){
        // Delete a user account
        if($id != 1){
            $this->removeData('user_admin', array('user_admin_id' => $id));
        }
        $this->Csz_model->clear_file_cache('getUserEmail*', TRUE);
    }

    /**
     * removeData
     *
     * Function for remove the data
     *
     * @param	string	$table    DB table
     * @param	string	$id_field    DB id field
     * @param	string	$id_val    DB id value
     */
    public function removeData($table, $id_field, $id_val = ''){
        if($table && $id_field){
            if(is_array($id_field)){
                // Delete a data from table
                $this->db->delete($table, $id_field);
            }else{
                // Delete a data from table
                $this->db->delete($table, array($id_field => $id_val));
            }
        }else{
            return FALSE;
        }
    }
    
    /**
     * removeDataAndFile
     *
     * Function for remove the data and file
     *
     * @param	string	$table    DB table
     * @param	string	$id_field    DB id field
     * @param	string	$id_val    DB id value
     * @param	string	$file_path    file upload path
     * @param	string	$file_sql_field    DB field name of file
     */
    public function removeDataAndFile($table, $id_field, $id_val, $file_path, $file_sql_field){
        if($table && $id_field && $file_path && $file_sql_field){
            $file = $this->Csz_model->getValue($file_sql_field, $table, $id_field, $id_val, 1);
            if($file !== FALSE && $file->$file_sql_field){
                @unlink(FCPATH . "/photo/" . str_replace(FCPATH . "/photo/", '', rtrim($file_path, '/')) . '/' . $file->$file_sql_field);
            }
            if(is_array($id_field)){
                // Delete a data from table
                $this->db->delete($table, $id_field);
            }else{
                // Delete a data from table
                $this->db->delete($table, array($id_field => $id_val));
            }
            unset($table, $id_field, $id_val, $file_path, $file_sql_field, $file);
        }else{
            return FALSE;
        }
    }

    /**
     * dropTable
     *
     * Function for drop the DB table
     *
     * @param	string	$table_name    DB table
     */
    public function dropTable($table_name){
        $this->load->dbforge();
        if($table_name){
            $this->dbforge->drop_table($table_name, TRUE);
            unset($table_name);
        }else{
            return FALSE;
        }
    }

    /**
     * chkMd5Time
     *
     * Function for check the user md5 time for forgot the password link
     *
     * @param	string	$md5    md5 from user DB
     * @param	string	$table    DB table
     * @return	TRUE or FALSE
     */
    public function chkMd5Time($md5, $table = ''){
        if(!$table)
            $table = 'user_admin';
        $this->db->select("*");
        $this->db->where("md5_hash", $md5);
        $this->db->where("md5_lasttime < DATE_SUB('".$this->Csz_model->timeNow()."', INTERVAL 30 MINUTE)");
        $this->db->limit(1, 0);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            $this->db->set('md5_hash', md5(time() + mt_rand(1, 99999999)), TRUE);
            $this->db->set('md5_lasttime', $this->Csz_model->timeNow(), TRUE);
            $this->db->where('md5_hash', $md5);
            $this->db->update($table);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * sessionLoginChk
     *
     * Function for check the session from client browser
     *
     * @return	TRUE or FALSE
     */
    public function sessionLoginChk(){
        $numcount = 0;
        if($this->session->userdata('session_id')){
            $numcount = $this->Csz_model->countData('user_admin', "session_id = '".$this->session->userdata('session_id')."' AND email = '".$this->session->userdata('admin_email')."'");
            if($numcount !== FALSE && $numcount > 0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    /**
     * getLangISOfromName
     *
     * Function for get the language code from name
     *
     * @param	string	$lang_name    Language name
     * @return	string
     */
    public function getLangISOfromName($lang_name = 'english'){
        /* Get Language ISO from language config file (for backend system) */
        $this->config->load('language');
        $lang_config = $this->config->item('admin_language_iso');
        return $lang_config[$lang_name];
    }

    /**
     * getLangNamefromISO
     *
     * Function for get the language name from code
     *
     * @param	string	$lang_iso    Language code
     * @return	string
     */
    public function getLangNamefromISO($lang_iso){
        /* Get Language ISO from language config file (for backend system) */
        $this->config->load('language');
        $lang_config = $this->config->item('admin_language_iso');
        $key = array_search($lang_iso, $lang_config);
        if($key !== FALSE && !empty($key)){
            return $key;
        }else{
            return 'english';
        }
    }

    /**
     * cszCopyright
     *
     * Function for show website footer credit
     * Please do not remove or change this fuction
     *
     */
    public function cszCopyright(){
        /* Please do not remove or change this function */
        $csz_copyright = '<br><span class="copyright" style="display:none;">'.$this->cszCredit().'</span>';
        return $csz_copyright;
    }

    /**
     * coreCss
     *
     * Function for load core css
     *
     * @param	string	$more_css    additional css
     * @param	bool	$more_include    for include the css file or FALSE
     * @return	String
     */
    public function coreCss($more_css = '', $more_include = TRUE){
        $core_css = '<link rel="canonical" href="' . $this->Csz_model->base_link(). '/' . $this->uri->uri_string() . '" />' . "\n";
        $core_css.= '<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">';
        $core_css.= '<link rel="dns-prefetch" href="//ajax.cloudflare.com">';
        $core_css.= '<link rel="dns-prefetch" href="//maps.googleapis.com">';
        $core_css.= link_tag(base_url('', '', TRUE).'assets/css/bootstrap.min.css');
        $core_css.= link_tag(base_url('', '', TRUE).'assets/css/jquery-ui-themes-1.11.4/themes/smoothness/jquery-ui.min.css');
        $core_css.= link_tag(base_url('', '', TRUE).'assets/font-awesome/css/font-awesome.min.css');
        $core_css.= link_tag(base_url('', '', TRUE).'assets/css/flag-icon.min.css');
        $core_css.= link_tag(base_url('', '', TRUE).'assets/js/plugins/select2/select2.min.css');
        $core_css.= link_tag(base_url('', '', TRUE).'assets/js/plugins/datetimepicker/jquery.datetimepicker.min.css');
        if (!empty($more_css)) {
            if($more_include !== FALSE){
                if (is_array($more_css)) {
                    foreach ($more_css as $value) {
                        if ($value) {
                            $core_css.= link_tag($value);
                        }
                    }
                } else {
                    $core_css.= link_tag($more_css);
                }
            }else{
                $more_css = str_replace(array('<style type="text/css">',"<style type='text/css'>",'<style>','</style>'), '', $more_css);
                $core_css.= '<style type="text/css">'.$more_css.'</style>';
            }
        }
        return $core_css;
    }

    /**
     * coreJs
     *
     * Function for load core js
     *
     * @param	string	$more_js    additional js
     * @param	bool	$more_include    for include the js file or FALSE
     * @return	String
     */
    public function coreJs($more_js = '', $more_include = TRUE){
        $core_js = '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/jquery-1.12.4.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/bootstrap.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/jquery-ui.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/jquery.ui.touch-punch.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/tinymce/tinymce.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/plugins/select2/select2.full.min.js"></script>';
        $core_js.= '<script type="text/javascript" src="' . base_url('', '', TRUE) . 'assets/js/plugins/datetimepicker/jquery.datetimepicker.full.min.js"></script>';
        $core_js.= '<script type="text/javascript">$(function(){$(".select2").select2()});$(".timepicker").datetimepicker({datepicker:false,step:1,format:"H:i"});$(".datetimepicker").datetimepicker({step:1,format:"Y-m-d H:i"});</script>';
        if (!empty($more_js)) {
            if($more_include !== FALSE){
                if (is_array($more_js)) {
                    foreach ($more_js as $value) {
                        if ($value) {
                            $core_js.= '<script type="text/javascript" src="' . $value . '"></script>';
                        }
                    }
                } else {
                    $core_js.= '<script type="text/javascript" src="' . $more_js . '"></script>';
                }
            }else{
                $more_js = str_replace(array('<script type="text/javascript">',"<script type='text/javascript'>",'<script>','</script>'), '', $more_js);
                $core_js.= '<script type="text/javascript">'.str_replace('<script ', '</script><script ', $more_js).'</script>';
            }
        }
        return $core_js;
    }

    /**
     * coreMetatags
     *
     * Function for load core metatag
     *
     * @param	string	$desc_txt    page description
     * @param	string	$more_metatags    additional meta tags text
     * @return	String
     */
    public function coreMetatags($desc_txt, $more_metatags = ''){
        $config = $this->load_config();
        $meta = array(
            array('name' => 'content-language', 'content' => $this->getLangISOfromName($this->getLang()), 'type' => 'equiv'),
            array('name' => 'description', 'content' => $desc_txt),
            array('name' => 'keywords', 'content' => $config->keywords),
            array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1'),
            array('name' => 'author', 'content' => $config->site_name),
            array('name' => 'generator', 'content' => $this->cszGenerateMeta()),
            array('name' => 'X-UA-Compatible', 'content' => 'IE=edge', 'type' => 'equiv'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        $return_meta = meta($meta);
        if(!empty($more_metatags)){
            if(is_array($more_metatags)){
                foreach($more_metatags as $value){
                    if($value){
                        $return_meta.= $value;
                    }
                }
            }else{
                $return_meta.= $more_metatags;
            }
        }
        return $return_meta;
    }

    /**
     * getSocial
     *
     * Function for get the social
     *
     * @return	object or FALSE
     */
    public function getSocial(){
        return $this->Csz_model->getSocial(FALSE);
    }

    /**
     * updateSocial
     *
     * Function for update the social
     */
    public function updateSocial(){
        $this->db->select("*");
        $query = $this->db->get("footer_social");
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){
                $data = array();
                $data['social_url'] = $this->input->post($rows->social_name, TRUE);
                if(isset($_POST['checkbox'.$rows->social_name])){
                    $data['active'] = $this->input->post('checkbox'.$rows->social_name, TRUE);
                }else{
                    $data['active'] = 0;
                }
                $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                $this->db->where("social_name", $rows->social_name);
                $this->db->update('footer_social', $data);
            }
        }
        $this->Csz_model->clear_file_cache('getsocial*', TRUE);
    }

    /**
     * updateSettings
     *
     * Function for update the settings
     */
    public function updateSettings(){
        $additional_js = str_replace('<script', '</script><script', str_replace('</script>', '', $this->input->post('additional_js')));
        $data = array(
            'themes_config' => $this->input->post('siteTheme', TRUE),
            'admin_lang' => $this->input->post('siteLang', TRUE),
            'site_footer' => $this->input->post('siteFooter', TRUE),
            'default_email' => $this->input->post('siteEmail', TRUE),
            'keywords' => $this->input->post('siteKeyword', TRUE),
            'additional_js' => $additional_js,
            'additional_metatag' => $this->input->post('additional_metatag'),
            'googlecapt_active' => $this->input->post('googlecapt_active', TRUE),
            'googlecapt_sitekey' => trim($this->input->post('googlecapt_sitekey', TRUE)),
            'googlecapt_secretkey' => trim($this->input->post('googlecapt_secretkey', TRUE)),
            'pagecache_time' => $this->input->post('pagecache_time', TRUE),
            'email_protocal' => $this->input->post('email_protocal', TRUE),
            'smtp_host' => $this->input->post('smtp_host', TRUE),
            'smtp_user' => $this->input->post('smtp_user', TRUE),
            'smtp_port' => $this->input->post('smtp_port', TRUE),
            'sendmail_path' => $this->input->post('sendmail_path', TRUE),
            'member_confirm_enable' => $this->input->post('member_confirm_enable', TRUE),
            'member_close_regist' => $this->input->post('member_close_regist', TRUE),
            'gmaps_key' => trim($this->input->post('gmaps_key', TRUE)),
            'gmaps_lat' => trim($this->input->post('gmaps_lat', TRUE)),
            'gmaps_lng' => trim($this->input->post('gmaps_lng', TRUE)),
            'ga_client_id' => trim($this->input->post('ga_client_id', TRUE)),
            'ga_view_id' => trim($this->input->post('ga_view_id', TRUE)),
            'fbapp_id' => trim($this->input->post('fbapp_id', TRUE)),
            'gsearch_active' => $this->input->post('gsearch_active', TRUE),
            'gsearch_cxid' => trim($this->input->post('gsearch_cxid', TRUE)),
            'maintenance_active' => $this->input->post('maintenance_active', TRUE),
            'html_optimize_disable' => $this->input->post('html_optimize_disable', TRUE),
            'adobe_cc_apikey' => $this->input->post('adobe_cc_apikey', TRUE),
            'facebook_page_id' => $this->input->post('facebook_page_id', TRUE),
            'assets_static_active' => $this->input->post('assets_static_active', TRUE),
            'assets_static_domain' => $this->input->post('assets_static_domain', TRUE),
            'fb_messenger' => $this->input->post('fb_messenger', TRUE),
            'email_logs' => $this->input->post('email_logs', TRUE),
            'title_setting' => $this->input->post('title_setting', TRUE),
            'cookieinfo_active' => $this->input->post('cookieinfo_active', TRUE),
            'cookieinfo_bg' => $this->input->post('cookieinfo_bg', TRUE),
            'cookieinfo_fg' => $this->input->post('cookieinfo_fg', TRUE),
            'cookieinfo_link' => $this->input->post('cookieinfo_link', TRUE),
            'cookieinfo_msg' => $this->input->post('cookieinfo_msg', TRUE),
            'cookieinfo_linkmsg' => $this->input->post('cookieinfo_linkmsg', TRUE),
            'cookieinfo_moreinfo' => $this->input->post('cookieinfo_moreinfo', TRUE),
            'cookieinfo_txtalign' => $this->input->post('cookieinfo_txtalign', TRUE),
            'cookieinfo_close' => $this->input->post('cookieinfo_close', TRUE),
        );
        $photo_id = time();
        $upload_file = '';
        if($this->input->post('del_file')){
            @unlink('photo/logo/'.$this->input->post('del_file', TRUE));
        }else if(isset($_FILES['file_upload'])){
            $upload_file = $this->input->post('siteLogo');
            if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg'){
                $paramiter = '_logo';
                $uploaddir = 'photo/logo/';
                $file_f = $_FILES['file_upload']['tmp_name'];
                $file_name = $_FILES['file_upload']['name'];
                $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('siteLogo', TRUE), $uploaddir, $photo_id, $paramiter);
            }
        }
        $data['site_logo'] = $upload_file;
        $upload_file1 = '';
        if($this->input->post('del_og_image')){
            @unlink('photo/logo/'.$this->input->post('del_og_image', TRUE));
        }elseif(isset($_FILES['og_image'])){
            $upload_file1 = $this->input->post('ogImage');
            if(!empty($_FILES['og_image']) && $_FILES['og_image']['type'] == 'image/png' || $_FILES['og_image']['type'] == 'image/jpg' || $_FILES['og_image']['type'] == 'image/jpeg'){
                $paramiter = '_og';
                $uploaddir = 'photo/logo/';
                $file_f = $_FILES['og_image']['tmp_name'];
                $file_name = $_FILES['og_image']['name'];
                $upload_file1 = $this->file_upload($file_f, $file_name, $this->input->post('ogImage', TRUE), $uploaddir, $photo_id, $paramiter);
            }
        }
        $data['og_image'] = $upload_file1;
        $data['site_name'] = $this->input->post('siteTitle', TRUE);
        if($this->input->post('smtp_pass', TRUE)){
            $this->db->set('smtp_pass', trim($this->input->post('smtp_pass', TRUE)));
        }
        if($this->input->post('siteTitle', TRUE) && $this->input->post('siteFooter', TRUE)){
            $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
            $this->db->where("settings_id", 1);
            $this->db->update('settings', $data);
            return TRUE;
        }else{
            return FALSE;
        }
        unset($data,$upload_file,$upload_file1,$additional_js);
    }

    /**
     * file_upload
     *
     * Function for upload file
     *
     * @param	string	$photo    File from $_FILE['tmp_name']
     * @param	string	$photo_name1    File name from $_FILE['name']
     * @param	string	$tmp_photo    Temp file. Can null if noting
     * @param	string	$uploaddir    Path to save the file
     * @param	string	$photo_id    New file name
     * @param	string	$paramiter    Other paramiter for new file name. Can null if noting
     * @param	string	$yearR    Year for directory
     * @param	int	$maxSizeR    Max the photo size (pixel). For image file only. Default 1900px
     * @param	bool	$resize    for resize enable. Default is TRUE (enable)
     * @param	int	$limitsize    Limit file size to upload (Mega Byte). Default 100 MB
     * @return	String (New filename)
     */
    public function file_upload($photo, $photo_name1, $tmp_photo, $uploaddir, $photo_id, $paramiter, $yearR = '', $maxSizeR = 1900, $resize = TRUE, $limitsize = 100){
        if (function_exists('ini_set')) {
            @ini_set('max_execution_time', 600);
            @ini_set('memory_limit','512M');
        }
        $photo_name = $this->security->sanitize_filename($photo_name1);
        ($yearR) ? $year = $yearR . DIRECTORY_SEPARATOR : $year = date("Y") . DIRECTORY_SEPARATOR;
        if($uploaddir){
            $uploaddir = rtrim(rtrim($uploaddir, '/'), '\\') . DIRECTORY_SEPARATOR; /* remove last / and add new / */
            if(file_exists($uploaddir) === FALSE){ mkdir($uploaddir, 0777, TRUE); }
            if(file_exists($uploaddir.$year) === FALSE){
                if(mkdir($uploaddir.$year, 0777, TRUE) === FALSE){ $year = ''; }
            }
        }
        if(!$photo){
            $photo = $tmp_photo;
        } else {
            $ext = str_replace('.', '', strrchr($photo_name, "."));
            if (strtoupper($ext) == "JPG" || strtoupper($ext) == "JPEG" || strtoupper($ext) == "PNG" || strtoupper($ext) == "GIF" || strtoupper($ext) == "BMP" || strtoupper($ext) == "WEBP") {
                /*
		 * Run the file through the XSS hacking filter
		 * This helps prevent malicious code from being
		 * embedded within a file. Scripts can easily
		 * be disguised as images or other file types.
		 */
                if ($this->Csz_model->photo_xss_clean($photo) === FALSE) {
                    log_message('error', "Error: upload unable to write file (XSS Protection)");
                    $photo = "";
                }else{
                    $org_filename = $photo_id . $paramiter . "-org." . $ext;
                    $newfile = $uploaddir . $year . $org_filename;
                    if (is_uploaded_file($photo)) { // upload original image
                        if (!copy($photo, "$newfile")) {
                            log_message('error', "Error: File not uploaded or directory permission been deny: " . $newfile);
                            $photo = "";
                        }
                    }
                    if (@filesize($newfile) > (1024 * 1024 * $limitsize)) {
                        log_message('error', "Error: File size is over limit: " . $newfile);
                        $photo = "";
                        @unlink($newfile);
                    } else {
                        list($w, $h) = @getimagesize($newfile);
                        if ($resize === TRUE && ($w > $maxSizeR) || ($h > $maxSizeR) && (!strtoupper($ext) == "GIF")) {
                            $im = $this->thumbnail($org_filename, $uploaddir . $year, $maxSizeR); //resize image
                            $small_filename = $photo_id . $paramiter . "." . $ext;
                            if ($this->imageToFile($im, $uploaddir . $year . $small_filename) !== FALSE) {
                                $photo = $year . $small_filename;
                                @unlink($newfile);
                            } else {
                                $photo = $year . $org_filename;
                            }
                        } else {
                            $photo = $year . $org_filename;
                        }
                    }
                    if ($tmp_photo)
                        @unlink($uploaddir . $tmp_photo);
                }
            } else if (strtoupper($ext) == "PDF" || strtoupper($ext) == "DOC" || strtoupper($ext) == "DOCX" || strtoupper($ext) == "ODT" || strtoupper($ext) == "TXT" || strtoupper($ext) == "ODG" || strtoupper($ext) == "ODP" || strtoupper($ext) == "ODS" || strtoupper($ext) == "ZIP" || strtoupper($ext) == "RAR" || strtoupper($ext) == "PSD" || strtoupper($ext) == "CSV" || strtoupper($ext) == "XLS" || strtoupper($ext) == "XLSX" || strtoupper($ext) == "PPT" || strtoupper($ext) == "PPTX" || strtoupper($ext) == "MP3" || strtoupper($ext) == "WAV" || strtoupper($ext) == "MP4" || strtoupper($ext) == "FLV" || strtoupper($ext) == "WMA" || strtoupper($ext) == "AVI" || strtoupper($ext) == "MOV" || strtoupper($ext) == "M4V" || strtoupper($ext) == "WMV" || strtoupper($ext) == "M3U" || strtoupper($ext) == "PLS") {
                $final_filename = $photo_id . $paramiter . "." . $ext;
                $newfile = $uploaddir . $year . $final_filename;
                if (is_uploaded_file($photo)) {
                    if (!copy($photo, "$newfile")) {
                        log_message('error', "Error: File not uploaded or directory permission been deny: " . $newfile);
                        $photo = "";
                    }
                }
                $photo = $year . $final_filename;
                if (@filesize($newfile) > (1024 * 1024 * $limitsize)) {
                    log_message('error', "Error: File size is over limit: " . $newfile);
                    $photo = "";
                    @unlink($newfile);
                }
                if ($tmp_photo) {
                    @unlink($uploaddir . $tmp_photo);
                }
            } else {
                $photo = "";
            }
        }
        return str_replace('\\', '/', $photo);
    }

    /**
     * Create a thumbnail image from $inputFileName no taller or wider than
     * $maxSize. Returns the new image resource or false on error.
     * Author: mthorn.net
     */
    private function thumbnail($inputFileName, $uploaddir, $maxSize = 500){
        $info = @getimagesize($uploaddir.$inputFileName);
        $type = isset($info['type']) ? $info['type'] : $info[2];
        // Check support of file type
        if(!(imagetypes() & $type)){
            // Server does not support file type
            return false;
        }
        $width = isset($info['width']) ? $info['width'] : $info[0];
        $height = isset($info['height']) ? $info['height'] : $info[1];
        // Calculate aspect ratio
        $wRatio = $maxSize / $width;
        $hRatio = $maxSize / $height;
        // Using imagecreatefromstring will automatically detect the file type
        $sourceImage = imagecreatefromstring(file_get_contents($uploaddir.$inputFileName));
        // Calculate a proportional width and height no larger than the max size.
        if(($width <= $maxSize) && ($height <= $maxSize)){
            // Input is smaller than thumbnail, do nothing
            return $sourceImage;
        }elseif(($wRatio * $height) < $maxSize){
            // Image is horizontal
            $tHeight = ceil($wRatio * $height);
            $tWidth = $maxSize;
        }else{
            // Image is vertical
            $tWidth = ceil($hRatio * $width);
            $tHeight = $maxSize;
        }
        $thumb = imagecreatetruecolor($tWidth, $tHeight);
        if($sourceImage === false){
            // Could not load image
            return false;
        }
        // Copy resampled makes a smooth thumbnail
        imagecopyresampled($thumb, $sourceImage, 0, 0, 0, 0, $tWidth, $tHeight, $width, $height);
        imagedestroy($sourceImage);
        return $thumb;
    }

    /**
     * Save the image to a file. Type is determined from the extension.
     * $quality is only used for jpegs.
     * Author: mthorn.net
     */
    private function imageToFile($im, $fileName, $quality = 75){
        if(!$im || file_exists($fileName)){
            return false;
        }
        $ext = strtolower(substr($fileName, strrpos($fileName, '.')));
        switch($ext){
            case '.gif':
                imagegif($im, $fileName);
                break;
            case '.jpg':
            case '.jpeg':
                imagejpeg($im, $fileName, $quality);
                break;
            case '.png':
                imagepng($im, $fileName);
                break;
            case '.bmp':
                imagewbmp($im, $fileName);
                break;
            case '.webp':
                imagewebp($im, $fileName);
                break;
            default:
                return false;
        }
        return true;
    }

    /**
     * sortNav
     *
     * Function for save the navigation by sort
     */
    public function sortNav(){
        $i = 0;
        $main_arrange = 1;
        $menu_id = $this->input->post('menu_id', TRUE);
        if(!empty($menu_id)){
            while($i < count($menu_id)){
                if($menu_id[$i]){
                    $this->db->set('arrange', $main_arrange, FALSE);
                    $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                    $this->db->where("page_menu_id", $menu_id[$i]);
                    $this->db->update('page_menu');
                    $main_arrange++;
                }
                $i++;
            }
        }
        $menusub_id = $this->input->post('menusub_id', TRUE);
        if(!empty($menusub_id)){
            foreach(array_keys($menusub_id) as $key){
                $sub_arrange = 1;
                for($i = 0; $i < count($menusub_id[$key]); $i++){
                    if($menusub_id[$key][$i]){
                        $this->db->set('arrange', $sub_arrange, FALSE);
                        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                        $this->db->where("page_menu_id", $menusub_id[$key][$i]);
                        $this->db->where("drop_page_menu_id", $key);
                        $this->db->update('page_menu');
                        $sub_arrange++;
                    }
                }
            }
        }
    }

    /**
     * getPagesAll
     *
     * Function for get all pages
     *
     * @return	array
     */
    public function getPagesAll(){
        $this->db->select("*");
        $query = $this->db->get('pages');
        if(!empty($query) && $query->num_rows() > 0){
            return $query->result_array();
        }
        return array();
    }

    /**
     * getPluginAll
     *
     * Function for get all plugin
     *
     * @return	array
     */
    public function getPluginAll(){
        $this->db->select("*");
        $this->db->where("plugin_active", 1);
        $this->db->order_by("plugin_config_filename", "asc");
        $query = $this->db->get('plugin_manager');
        if(!empty($query) && $query->num_rows() > 0){
            return $query->result_array();
        }
        return array();
    }

    /**
     * getAllMenu
     *
     * Function for get all menu
     *
     * @param	int	$drop_page_menu_id    1 = drop menu, 0 = main menu
     * @param	string	$lang    language code
     * @param	int	$position    menu position  0 = Top, 1 = Bottom
     * @return	object or FALSE id not found
     */
    public function getAllMenu($drop_page_menu_id = 0, $lang = '', $position = 0){
        return $this->Csz_model->main_menu($drop_page_menu_id, $lang, $position, TRUE);
    }

    /**
     * getDropMenuAll
     *
     * Function for get all drop down menu
     *
     * @return	array
     */
    public function getDropMenuAll(){
        $this->db->select("*");
        $this->db->where('drop_menu', 1);
        $query = $this->db->get('page_menu');
        if($query->num_rows() > 0){
            return $query->result_array();
        }
        return array();
    }

    /**
     * getMenuArrange
     *
     * Function for get next number for arrange
     *
     * @param	string	$mainmenu_id    for main menu. Default is 0
     * @return	int
     */
    public function getMenuArrange($mainmenu_id = 0){
        $this->db->select("*");
        if($mainmenu_id){
            $this->db->where('drop_menu', 0);
        }
        $this->db->where('drop_page_menu_id', $mainmenu_id);
        $query = $this->db->get('page_menu');
        return ($query->num_rows()) + 1;
    }

    /**
     * insertMenu
     *
     * Function for insert new menu
     */
    public function insertMenu(){
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('dropdown')) ? $dropdown = $this->input->post('dropdown', TRUE) : $dropdown = 0;
        ($this->input->post('dropMenu')) ? $dropMenu = $this->input->post('dropMenu', TRUE) : $dropMenu = 0;
        ($this->input->post('new_windows')) ? $new_windows = $this->input->post('new_windows', TRUE) : $new_windows = 0;
        ($this->input->post('menuType')) ? $arrange = $this->getMenuArrange($this->input->post('dropMenu')) : $arrange = $this->getMenuArrange();
        $o_link_input = $this->input->post('url_link', TRUE);
        $pageUrl = $this->input->post('pageUrl', TRUE);
        $pluginmenu = $this->input->post('pluginmenu', TRUE);
        if(substr($o_link_input, 0, 1) === '#'){
            $other_link = substr($o_link_input, 1);
        }else{
            $replace_arr = array('https://', 'http://');
            $other_link = str_replace($replace_arr, '', $o_link_input);
        }
        $protocal = $this->input->post('protocal', TRUE);
        if(!$other_link){
            $protocal = '';
        }
        if(!$pageUrl && !$pluginmenu && !$o_link_input){
            $other_link = '#';
        }
        $data = array(
            'menu_name' => $this->input->post('name', TRUE),
            'lang_iso' => $this->input->post('lang_iso', TRUE),
            'pages_id' => $pageUrl,
            'other_link' => $protocal.$other_link,
            'plugin_menu' => $pluginmenu,
            'drop_menu' => $dropdown,
            'drop_page_menu_id' => $dropMenu,
            'position' => $this->input->post('position', TRUE),
            'new_windows' => $new_windows,
            'active' => $active,
            'arrange' => $arrange,
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('page_menu', $data);
    }

    /**
     * updateMenu
     *
     * Function for update the menue
     *
     * @param	string	$id    Menu id
     */
    public function updateMenu($id){
        // Update the menu
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('dropdown')) ? $dropdown = $this->input->post('dropdown', TRUE) : $dropdown = 0;
        ($this->input->post('dropMenu')) ? $dropMenu = $this->input->post('dropMenu', TRUE) : $dropMenu = 0;
        ($this->input->post('new_windows')) ? $new_windows = $this->input->post('new_windows', TRUE) : $new_windows = 0;
        $this->db->set('menu_name', $this->input->post("name", TRUE), TRUE);
        $this->db->set('lang_iso', $this->input->post("lang_iso", TRUE), TRUE);
        $o_link_input = $this->input->post('url_link', TRUE);
        $pageUrl = $this->input->post('pageUrl', TRUE);
        $pluginmenu = $this->input->post('pluginmenu', TRUE);
        if(substr($o_link_input, 0, 1) === '#'){
            $other_link = substr($o_link_input, 1);
        }else{
            $replace_arr = array('https://', 'http://');
            $other_link = str_replace($replace_arr, '', $o_link_input);
        }
        $protocal = $this->input->post('protocal', TRUE);
        if(!$other_link){
            $protocal = '';
        }
        if(!$pageUrl && !$pluginmenu && !$o_link_input){
            $other_link = '#';
        }
        $this->db->set('pages_id', $pageUrl, TRUE);
        $this->db->set('other_link', $protocal.$other_link, TRUE);
        $this->db->set('plugin_menu', $pluginmenu, TRUE);
        $this->db->set('drop_menu', $dropdown, TRUE);
        $this->db->set('drop_page_menu_id', $dropMenu, TRUE);
        $this->db->set('position', $this->input->post('position', TRUE), TRUE);
        $this->db->set('new_windows', $new_windows, TRUE);
        $this->db->set('active', $active, TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('page_menu_id', $id);
        $this->db->update('page_menu');
    }

    /**
     * findLangDataUpdate
     *
     * Function for find the lang update. When delete Lang, wiil update all page of lang to default.
     *
     * @param	string	$lang_iso    language code
     */
    public function findLangDataUpdate($lang_iso){
        $query = $this->db->get_where($table = 'pages', 'lang_iso = \''.$lang_iso.'\'');
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){
                $this->db->set('lang_iso', $this->Csz_model->getDefualtLang(), TRUE);
                $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                $this->db->where("pages_id", $rows->pages_id);
                $this->db->update('pages');
            }
        }
        $query = $this->db->get_where($table = 'page_menu', 'lang_iso = \''.$lang_iso.'\'');
        if($query->num_rows() > 0){
            foreach($query->result() as $rows){
                $this->db->set('lang_iso', $this->Csz_model->getDefualtLang(), TRUE);
                $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                $this->db->where("page_menu_id", $rows->page_menu_id);
                $this->db->update('page_menu');
            }
        }
        $this->load->dbforge();
        $this->dbforge->drop_column('general_label', 'lang_'.$lang_iso);
    }

    /**
     * insertLang
     *
     * Function for create new language
     */
    public function insertLang(){
        $arrange = $this->Csz_model->getLastID('lang_iso', 'arrange');
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $data = array(
            'lang_name' => $this->input->post('lang_name', TRUE),
            'lang_iso' => $this->input->post('lang_iso', TRUE),
            'country' => $this->input->post('country', TRUE),
            'country_iso' => $this->input->post('country_iso', TRUE),
            'active' => $active,
        );
        $this->db->set('arrange', ($arrange)+1);
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('lang_iso', $data);
        if(!$this->db->field_exists('lang_'.$this->input->post("lang_iso", TRUE), 'general_label')){
            $this->load->dbforge();
            $fields = array('lang_'.$this->input->post('lang_iso', TRUE) => array('type' => 'TEXT', 'null' => FALSE));
            $this->dbforge->add_column('general_label', $fields);
        }
    }

    /**
     * updateLang
     *
     * Function for update the language
     *
     * @param	string	$id    language id
     */
    public function updateLang($id){
        $old_lang = $this->Csz_model->getValue('lang_iso', 'lang_iso', 'lang_iso_id', $id, 1);
        $this->load->dbforge();
        if(!$this->db->field_exists('lang_'.$this->input->post("lang_iso", TRUE), 'general_label') && $old_lang->lang_iso != $this->input->post("lang_iso", TRUE)){            
            if($old_lang->lang_iso != 'en'){
                $fields = array(
                    'lang_'.$old_lang->lang_iso => array(
                        'name' => 'lang_'.$this->input->post("lang_iso", TRUE),
                        'type' => 'TEXT',
                        'null' => FALSE,
                    ),
                );
                $this->dbforge->modify_column('general_label', $fields);
            }else{
                $fields = array('lang_'.$this->input->post('lang_iso', TRUE) => array('type' => 'TEXT', 'null' => FALSE));
                $this->dbforge->add_column('general_label', $fields);
            }
        }else{
            if($old_lang->lang_iso != 'en' && $this->input->post("lang_iso", TRUE) == 'en'){
                $this->dbforge->drop_column('general_label', 'lang_' . $old_lang->lang_iso);
            }
        }
        /* Update lang in menu */
        $this->db->set('lang_iso', $this->input->post("lang_iso", TRUE), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('lang_iso', $old_lang->lang_iso);
        $this->db->update('page_menu');
        /* Update lang in page */
        $this->db->set('lang_iso', $this->input->post("lang_iso", TRUE), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('lang_iso', $old_lang->lang_iso);
        $this->db->update('pages');

        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $this->db->set('lang_name', $this->input->post("lang_name", TRUE), TRUE);
        $this->db->set('lang_iso', $this->input->post("lang_iso", TRUE), TRUE);
        $this->db->set('country', $this->input->post('country', TRUE), TRUE);
        $this->db->set('country_iso', $this->input->post('country_iso', TRUE), TRUE);
        if($id != 1){
            $this->db->set('active', $active, FALSE);
        }
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('lang_iso_id', $id);
        $this->db->update('lang_iso');
    }

    /**
     * syncLabelLang
     *
     * Function for synchronize the language with general label for frontend
     */
    public function syncLabelLang(){
        $this->load->dbforge();
        $lang = $this->Csz_model->getValueArray('lang_iso', 'lang_iso', "lang_iso != ''", '');
        $count_lang = $this->countTable('lang_iso');
        foreach($lang as $value){
            if($count_lang > 1){
                if(!$this->db->field_exists('lang_'.$value['lang_iso'], 'general_label') && $value['lang_iso']){
                    $fields = array('lang_'.$value['lang_iso'] => array('type' => 'TEXT', 'null' => FALSE));
                    $this->dbforge->add_column('general_label', $fields);
                }
            }
        }
    }

    /**
     * updateLabel
     *
     * Function for update the general label
     *
     * @param	string	$id    general label id
     */
    public function updateLabel($id){
        $lang = $this->Csz_model->getValueArray('lang_iso', 'lang_iso', "lang_iso != ''", '');
        foreach($lang as $value){
            $this->db->set('lang_'.$value['lang_iso'], $this->input->post("lang_".$value['lang_iso'], TRUE), TRUE);
        }
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('general_label_id', $id);
        $this->db->update('general_label');
    }
    
    /**
     * chkPageName
     *
     * Function for check page name
     * 
     * @return	string
     */
    public function chkPageName($page_name_input){
        if($page_name_input == 'assets' || $page_name_input == 'cszcms' ||
                $page_name_input == 'install' || $page_name_input == 'photo' ||
                $page_name_input == 'system' || $page_name_input == 'templates' || 
                $page_name_input == 'search' || $page_name_input == 'admin' || 
                $page_name_input == 'ci_session' || $page_name_input == 'member' || 
                $page_name_input == 'plugin' || $page_name_input == 'link' || $page_name_input == 'banner') {
            return 'pages_'.$page_name_input;
        } else{
            return $page_name_input;
        }
    }
    
    /**
     * insertPage
     *
     * Function for create new page
     */
    public function insertPage(){
        $page_name_input = str_replace('&amp;', '&', $this->chkPageName($this->input->post('page_name', TRUE)));
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $page_url = $this->chkPageName($this->Csz_model->rw_link($page_name_input));
        $content2 = $this->input->post('content', FALSE);
        $content1 = str_replace('&lt;', '<', $content2);
        $content = str_replace('&gt;', '>', $content1);
        $custom_css = str_replace(array('<style type="text/css">',"<style type='text/css'>",'<style>','</style>'), '', $this->input->post('custom_css', FALSE));
        $custom_js = str_replace(array('<script type="text/javascript">',"<script type='text/javascript'>",'<script>','</script>'), '', $this->input->post('custom_js', FALSE));
        $user_groups_idS = $this->input->post('user_groups_idS');
        $user_groups_id = '';
        if (isset($user_groups_idS)) {
            if (count($user_groups_idS) == 1) {
                $user_groups_id = $user_groups_idS[0];
            } else {
                $user_groups_id = implode(",", $user_groups_idS);
            }
        }
        $data = array(
            'page_name' => $page_name_input,
            'page_url' => $page_url,
            'lang_iso' => $this->input->post('lang_iso', TRUE),
            'page_title' => str_replace('&amp;', '&', $this->input->post('page_title', TRUE)),
            'page_keywords' => $this->input->post('page_keywords', TRUE),
            'page_desc' => $this->input->post('page_desc', TRUE),
            'content' => $content,
            'active' => $active,
            'user_groups_idS' => $user_groups_id,
        );
        if($this->Csz_auth_model->is_group_allowed('pages cssjs additional', 'backend') !== FALSE){
            $data['more_metatag'] = $this->input->post('more_metatag', FALSE);
            $data['custom_css'] = $custom_css;
            $data['custom_js'] = $custom_js;
        }
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('pages', $data);
    }

    /**
     * updatePage
     *
     * Function for update the page
     *
     * @param	string	$id    page id
     */
    public function updatePage($id){
        // Update the page
        $page_name_input = str_replace('&amp;', '&', $this->chkPageName($this->input->post('page_name', TRUE)));
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $page_url = $this->chkPageName($this->Csz_model->rw_link($page_name_input));
        $content2 = $this->input->post('content', FALSE);
        $content1 = str_replace('&lt;', '<', $content2);
        $content = str_replace('&gt;', '>', $content1);
        $custom_css = str_replace(array('<style type="text/css">',"<style type='text/css'>",'<style>','</style>'), '', $this->input->post('custom_css', FALSE));
        $custom_js = str_replace(array('<script type="text/javascript">',"<script type='text/javascript'>",'<script>','</script>'), '', $this->input->post('custom_js', FALSE));
        $user_groups_idS = $this->input->post('user_groups_idS');
        $user_groups_id = '';
        if (isset($user_groups_idS)) {
            if (count($user_groups_idS) == 1) {
                $user_groups_id = $user_groups_idS[0];
            } else {
                $user_groups_id = implode(",", $user_groups_idS);
            }
        }
        $this->db->set('page_name', $page_name_input, TRUE);
        $this->db->set('page_url', $page_url, TRUE);
        $this->db->set('lang_iso', $this->input->post('lang_iso', TRUE), TRUE);
        $this->db->set('page_title', str_replace('&amp;', '&', $this->input->post('page_title', TRUE)), TRUE);
        $this->db->set('page_keywords', $this->input->post('page_keywords', TRUE), TRUE);
        $this->db->set('page_desc', $this->input->post('page_desc', TRUE), TRUE);
        $this->db->set('content', $content);
        if($this->Csz_auth_model->is_group_allowed('pages cssjs additional', 'backend') !== FALSE){
            $this->db->set('more_metatag', $this->input->post('more_metatag', FALSE), TRUE);
            $this->db->set('custom_css', $custom_css, TRUE);
            $this->db->set('custom_js', $custom_js, TRUE);
        }
        if($id != 1){
            $this->db->set('active', $active, FALSE);
        }
        $this->db->set('user_groups_idS', $user_groups_id);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('pages_id', $id);
        $this->db->update('pages');
        $this->Csz_model->clear_all_cache();
    }
    
    /**
     * updatePageView
     *
     * Function for update the page from page view
     *
     * @param	string	$id    page id
     */
    public function updatePageView($id){
        $getcontent = $this->input->post('content', FALSE);
        if($id && $getcontent){
            $content1 = str_replace('&lt;', '<', $getcontent);
            $content = str_replace('&gt;', '>', $content1);
            $this->db->set('content', $this->carouselReplaceToTag($content));
            $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
            $this->db->where('pages_id', $id);
            $this->db->update('pages');
            $this->Csz_model->clear_all_cache();
        }
    }
    
    /**
     * carouselReplaceToTag
     *
     * Function for find carousel html and replace back to tag
     *
     * @param	string	$content    Original content
     * @return	string
     */
    public function carouselReplaceToTag($content) { /* Find the carousel in content */
        return preg_replace('/\<cszcarouseltag(\d)\>[\s\S\r\n]+\<\/cszcarouseltag\1\>/', '[?]{=carousel:\1}[?]', $content);
    }

    /**
     * insertFileUpload
     *
     * Function for insert the file upload into db
     *
     * @param	string	$year    year
     * @param	string	$fileupload    file name from file_upload function
     * @param	string	$remark    remark from this file
     */
    public function insertFileUpload($year, $fileupload, $remark = ''){
        $data = array(
            'year' => $year,
            'file_upload' => $fileupload,
            'remark' => $remark,
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('upload_file', $data);
    }
    
    public function insertEligibility($data){
        
        $this->db->insert('applicant_eligibility_test', $data);
    }
    
    private function cleanFormName($name){
        if($name == 'field' || $name == 'main'){
            $name = $name.time();
        }
        $str_arr = array(' ', '-');
        return $this->Csz_model->cleanEmailFormat(str_replace($str_arr, '_', strtolower($name)));
    }

    /**
     * insertForms
     *
     * Function for insert the forms
     */
    public function insertForms(){
        $this->load->dbforge();
        // Create the new forms
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('sendmail')) ? $sendmail = $this->input->post('sendmail', TRUE) : $sendmail = 0;
        ($this->input->post('captcha')) ? $captcha = $this->input->post('captcha', TRUE) : $captcha = 0;
        ($this->input->post('send_to_visitor')) ? $send_to_visitor = $this->input->post('send_to_visitor', TRUE) : $send_to_visitor = 0;
        ($this->input->post('save_to_db')) ? $save_to_db = $this->input->post('save_to_db', TRUE) : $save_to_db = 0;
        $form_name = $this->cleanFormName($this->input->post('form_name', TRUE));
        $data = array(
            'form_name' => $form_name,
            'form_enctype' => $this->input->post('form_enctype', TRUE),
            'form_method' => $this->input->post('form_method', TRUE),
            'success_txt' => $this->input->post('success_txt', TRUE),
            'captchaerror_txt' => $this->input->post('captchaerror_txt', TRUE),
            'error_txt' => $this->input->post('error_txt', TRUE),
            'sendmail' => $sendmail,
            'email' => $this->input->post('email', TRUE),
            'subject' => $this->input->post('subject', TRUE),
            'send_to_visitor' => $send_to_visitor,
            'active' => $active,
            'captcha' => $captcha,
            'save_to_db' => $save_to_db,
            'dont_repeat_field' => $this->input->post('dont_repeat_field', TRUE),
            'repeat_txt' => $this->input->post('repeat_txt', TRUE),
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('form_main', $data);
        $form_main_id = $this->db->insert_id();

        $field_name = $this->input->post('field_name', TRUE);
        $field_type = $this->input->post('field_type', TRUE);
        $field_id = $this->input->post('field_id', TRUE);
        $field_class = $this->input->post('field_class', TRUE);
        $field_placeholder = $this->input->post('field_placeholder', TRUE);
        $field_value = $this->input->post('field_value', TRUE);
        $field_label = $this->input->post('field_label', TRUE);
        $sel_option_val = $this->input->post('sel_option_val', TRUE);
        $field_required = $this->input->post('field_required', TRUE);
        $field_div_class = $this->input->post('field_div_class', TRUE);
        $max_length = $this->input->post('max_length', TRUE);
        $fields = array(
            'form_'.$form_name.'_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
        );
        $this->dbforge->add_field($fields);
        if(count($field_name) > 0){
            $arrange = 1;
            for($i = 0; $i < count($field_name); $i++){
                if($field_name[$i] && $form_main_id){
                    $data = array(
                        'form_main_id' => $form_main_id,
                        'field_type' => $field_type[$i],
                        'field_name' => $field_name[$i],
                        'field_id' => $field_id[$i],
                        'field_class' => $field_class[$i],
                        'field_placeholder' => $field_placeholder[$i],
                        'field_value' => $field_value[$i],
                        'field_label' => $field_label[$i],
                        'sel_option_val' => $sel_option_val[$i],
                        'field_required' => $field_required[$i],
                        'field_div_class' => $field_div_class[$i],
                        'arrange' => $arrange,
                        'max_length' => $max_length[$i]
                    );
                    $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
                    $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                    $this->db->insert('form_field', $data);
                    $fields = $this->preTypeFields($field_type[$i], $field_name[$i]);
                    $this->dbforge->add_field($fields);
                    $arrange++;
                }
            }
        }
        $fields = array(
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'timestamp_create' => array(
                'type' => 'datetime'
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('form_'.$form_name.'_id', TRUE);
        $attributes = array('ENGINE' => 'MyISAM', 'CHARACTER SET' => 'utf8', 'COLLATE' => 'utf8_general_ci', ' AUTO_INCREMENT' => '1');
        $this->dbforge->create_table('form_'.$form_name, TRUE, $attributes);

        return $form_main_id;
    }

    /**
     * updateForms
     *
     * Function for update the form
     *
     * @param	string	$id    form id
     * @return	bool
     */
    public function updateForms($id){
        $this->load->dbforge();
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('sendmail')) ? $sendmail = $this->input->post('sendmail', TRUE) : $sendmail = 0;
        ($this->input->post('captcha')) ? $captcha = $this->input->post('captcha', TRUE) : $captcha = 0;
        ($this->input->post('send_to_visitor')) ? $send_to_visitor = $this->input->post('send_to_visitor', TRUE) : $send_to_visitor = 0;
        ($this->input->post('save_to_db')) ? $save_to_db = $this->input->post('save_to_db', TRUE) : $save_to_db = 0;
        $form_name_old = $this->input->post('form_name_old', TRUE);
        $form_name = $this->cleanFormName($this->input->post('form_name', TRUE));
        if($form_name == $form_name_old){
            $rename_table_res = TRUE;
        }else{
            $rename_table_res = @$this->dbforge->rename_table('form_'.$form_name_old, 'form_'.$form_name);
            $fields = array(
                    'form_'.$form_name_old.'_id' => array(
                        'name' => 'form_'.$form_name.'_id',
                        'type' => 'INT',
                        'constraint' => 11,
                        'auto_increment' => TRUE
                    ),
            );
            $this->dbforge->modify_column('form_'.$form_name, $fields);
        }
        if($rename_table_res !== FALSE){
            $data = array(
                'form_name' => $form_name,
                'form_enctype' => $this->input->post('form_enctype', TRUE),
                'form_method' => $this->input->post('form_method', TRUE),
                'success_txt' => $this->input->post('success_txt', TRUE),
                'captchaerror_txt' => $this->input->post('captchaerror_txt', TRUE),
                'error_txt' => $this->input->post('error_txt', TRUE),
                'sendmail' => $sendmail,
                'email' => $this->input->post('email', TRUE),
                'subject' => $this->input->post('subject', TRUE),
                'send_to_visitor' => $send_to_visitor,
                'email_field_id' => $this->input->post('email_field_id', TRUE),
                'visitor_subject' => $this->input->post('visitor_subject', TRUE),
                'visitor_body' => $this->input->post('visitor_body', TRUE),
                'active' => $active,
                'captcha' => $captcha,
                'save_to_db' => $save_to_db,
                'dont_repeat_field' => $this->input->post('dont_repeat_field', TRUE),
                'repeat_txt' => $this->input->post('repeat_txt', TRUE),
            );
            $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
            $this->db->where('form_main_id', $id);
            $this->db->update('form_main', $data);
            /* Rename Field */
            $form_field_id = $this->input->post('form_field_id', TRUE);
            $field_name1 = $this->input->post('field_name1', TRUE);
            $field_oldname = $this->input->post('field_oldname', TRUE);
            $field_oldtype = $this->input->post('field_oldtype', TRUE);
            $field_type1 = $this->input->post('field_type1', TRUE);
            $field_id1 = $this->input->post('field_id1', TRUE);
            $field_class1 = $this->input->post('field_class1', TRUE);
            $field_placeholder1 = $this->input->post('field_placeholder1', TRUE);
            $field_value1 = $this->input->post('field_value1', TRUE);
            $field_label1 = $this->input->post('field_label1', TRUE);
            $sel_option_val1 = $this->input->post('sel_option_val1', TRUE);
            $field_required1 = $this->input->post('field_required1', TRUE);
            $field_div_class1 = $this->input->post('field_div_class1', TRUE);
            $max_length1 = $this->input->post('max_length1', TRUE);
            if(count($field_oldname) > 0){
                $arrange = 1;
                for($i = 0; $i < count($field_oldname); $i++){
                    if($field_oldname[$i] && $form_field_id[$i]){
                        $data = array(
                            'form_main_id' => $id,
                            'field_type' => $field_type1[$i],
                            'field_name' => $field_name1[$i],
                            'field_id' => $field_id1[$i],
                            'field_class' => $field_class1[$i],
                            'field_placeholder' => $field_placeholder1[$i],
                            'field_value' => $field_value1[$i],
                            'field_label' => $field_label1[$i],
                            'sel_option_val' => $sel_option_val1[$i],
                            'field_required' => $field_required1[$i],
                            'field_div_class' => $field_div_class1[$i],
                            'max_length' => $max_length1[$i],
                            'arrange' => $arrange,
                        );
                        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                        $this->db->where('form_field_id', $form_field_id[$i]);
                        $this->db->update('form_field', $data);
                        $arrange++;
                        if($field_oldname[$i] != $field_name1[$i]){
                            if($field_oldtype[$i] != 'button' && $field_oldtype[$i] != 'reset' && $field_oldtype[$i] != 'submit' && $field_oldtype[$i] != 'label' && $field_oldtype[$i] != 'file'){
                                if($field_type1[$i] == 'button' || $field_type1[$i] == 'reset' || $field_type1[$i] == 'submit' || $field_type1[$i] == 'label'){
                                    $this->dbforge->drop_column('form_'.$form_name, $field_oldname[$i]);
                                }else{
                                    $fields = $this->renameFields($field_type1[$i], $field_oldname[$i], $field_name1[$i]);
                                    $this->dbforge->modify_column('form_'.$form_name, $fields);
                                }
                            }else if($field_oldtype[$i] == 'file'){
                                delete_files(FCPATH . "/photo/forms/".$this->Csz_model->cleanEmailFormat($form_name).'/'.$this->Csz_model->cleanEmailFormat($field_oldname[$i]), TRUE);
                                delete_files(FCPATH . "/photo/forms/".$this->Csz_model->cleanEmailFormat($form_name).'/'.$this->Csz_model->cleanEmailFormat($field_oldname[$i]));
                                rmdir(FCPATH . "/photo/forms/".$this->Csz_model->cleanEmailFormat($form_name).'/'.$this->Csz_model->cleanEmailFormat($field_oldname[$i]));
                                $fields = $this->preTypeFields($field_type1[$i], $field_name1[$i]);
                                $this->dbforge->drop_column('form_'.$form_name, $field_oldname[$i]);                           
                                $this->dbforge->add_column('form_'.$form_name, $fields);
                            }else{
                                if($field_type1[$i] != 'button' && $field_type1[$i] != 'reset' && $field_type1[$i] != 'submit' && $field_type1[$i] != 'label'){
                                    $fields = $this->preTypeFields($field_type1[$i], $field_name1[$i]);
                                    $this->dbforge->add_column('form_'.$form_name, $fields);
                                }
                            }
                        }
                    }
                }
            }

            /* Add New Field */
            $field_name = $this->input->post('field_name', TRUE);
            $field_type = $this->input->post('field_type', TRUE);
            $field_id = $this->input->post('field_id', TRUE);
            $field_class = $this->input->post('field_class', TRUE);
            $field_placeholder = $this->input->post('field_placeholder', TRUE);
            $field_value = $this->input->post('field_value', TRUE);
            $field_label = $this->input->post('field_label', TRUE);
            $sel_option_val = $this->input->post('sel_option_val', TRUE);
            $field_required = $this->input->post('field_required', TRUE);
            $field_div_class = $this->input->post('field_div_class', TRUE);
            $max_length = $this->input->post('max_length', TRUE);
            if(count($field_name) > 0){
                $last_arrange = $this->Csz_model->getLastID('form_field', 'arrange', "form_main_id = '".$id."'");
                for($i = 0; $i < count($field_name); $i++){
                    if($field_name[$i]){
                        $last_arrange++;
                        $data = array(
                            'form_main_id' => $id,
                            'field_type' => $field_type[$i],
                            'field_name' => $field_name[$i],
                            'field_id' => $field_id[$i],
                            'field_class' => $field_class[$i],
                            'field_placeholder' => $field_placeholder[$i],
                            'field_value' => $field_value[$i],
                            'field_label' => $field_label[$i],
                            'sel_option_val' => $sel_option_val[$i],
                            'field_required' => $field_required[$i],
                            'field_div_class' => $field_div_class[$i],
                            'max_length' => $max_length[$i],
                            'arrange' => $last_arrange,
                        );
                        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
                        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                        $this->db->insert('form_field', $data);
                        $fields = $this->preTypeFields($field_type[$i], $field_name[$i]);
                        $this->dbforge->add_column('form_'.$form_name, $fields);
                    }
                }
            }
            $this->Csz_model->clear_all_cache();
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * preTypeFields
     *
     * Function for prepare the field type
     *
     * @param	string	$type    field type
     * @param	string	$name    field name
     * @return  array
     */
    public function preTypeFields($type, $name){
        $fields = array();
        switch($type){
            case 'checkbox':
                $fields = array(
                    $name => array(
                        'type' => 'VARCHAR',
                        'null' => TRUE,
                        'constraint' => '255'
                    ),
                );
                break;
            case 'datepicker':
                $fields = array(
                    $name => array(
                        'type' => 'DATE',
                        'null' => TRUE,
                    ),
                );
                break;
            case 'number':
            case 'email':
            case 'file':
            case 'password':
            case 'selectbox':
            case 'text':
            case 'timepicker':
                $fields = array(
                    $name => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE,
                    ),
                );
                break;
            case 'textarea':
                $fields = array(
                    $name => array(
                        'type' => 'TEXT',
                        'null' => TRUE,
                    ),
                );
                break;
            default:
                break;
        }
        return $fields;
    }

    /**
     * renameFields
     *
     * Function for rename the field
     *
     * @param	string	$type    field type
     * @param	string	$oldname   old field name
     * @param	string	$newname   new field name
     * @return  array
     */
    public function renameFields($type, $oldname, $newname){
        $fields = array();
        switch($type){
            case 'checkbox':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'VARCHAR',
                        'null' => TRUE,
                        'constraint' => '255'
                    ),
                );
                break;
            case 'datepicker':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'DATE',
                        'null' => TRUE,
                    ),
                );
                break;
            case 'number':
            case 'email':
            case 'file':
            case 'password':
            case 'selectbox':
            case 'text':
            case 'timepicker':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE,
                    ),
                );
                break;
            case 'textarea':
                $fields = array(
                    $oldname => array(
                        'name' => $newname,
                        'type' => 'TEXT',
                        'null' => TRUE,
                    ),
                );
                break;
            default:
                break;
        }
        return $fields;
    }

    /**
     * execSqlFile
     *
     * Function for import the sql file into db
     *
     * @param	string	$sql_file    sql file path
     * @return  FALSE if sql file not found
     */
    public function execSqlFile($sql_file){
        if(file_exists($sql_file)){
            $db_debug = $this->db->db_debug;
            $this->db->db_debug = false;
            $this->load->helper('file');
            $backup = read_file($sql_file);
            $sql1 = preg_replace('#/\*.*?\*/#s', '', $backup);
            $sql2 = preg_replace('/^-- .*[\r\n]*/m', '', $sql1);
            $sqls = explode(';', $sql2);
            array_pop($sqls);
            $i = 0;
            foreach($sqls as $statement){
                if(trim($statement) != null){
                    $sql = trim($statement).";";
                    $this->db->query(trim($sql));
                    if($i >= 5000){ /* When 5000 query. Is sleep 5 sec. */
                        sleep(5);
                        $i = 0;
                    }
                    $i++;
                }
            }
            $this->db->db_debug = $db_debug;
        }else{
            return FALSE;
        }
    }

    /**
     * chkPluginActive
     *
     * Function for check the plugin is active
     *
     * @param	string	$plugin_config_filename    plugin config filename
     * @return  TRUE or FALSE
     */
    public function chkPluginActive($plugin_config_filename){
        if($plugin_config_filename){
            $status = $this->Csz_model->getValue('plugin_active', 'plugin_manager', "plugin_config_filename", $plugin_config_filename, 1);
            if($status->plugin_active){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }

    /**
     * insertWidget
     *
     * Function for insert the new widget
     */
    public function insertWidget(){
        // Create the new lang
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $data = array(
            'widget_name' => $this->input->post('widget_name', TRUE),
            'xml_url' => preg_replace('/\s+/', '', $this->input->post('xml_url', TRUE)),
            'limit_view' => $this->input->post('limit_view', TRUE),
            'active' => $active,
            'widget_open' => $this->input->post('widget_open', TRUE),
            'widget_content' => $this->input->post('widget_content', TRUE),
            'widget_seemore' => $this->input->post('widget_seemore', TRUE),
            'widget_close' => $this->input->post('widget_close', TRUE),
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('widget_xml', $data);
    }

    /**
     * updateWidget
     *
     * Function for update the widget
     *
     * @param	string	$id    widget id
     */
    public function updateWidget($id){
        // Update the lang
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $this->db->set('widget_name', $this->input->post("widget_name", TRUE));
        $this->db->set('xml_url', $this->input->post("xml_url", TRUE));
        $this->db->set('limit_view', $this->input->post('limit_view', TRUE));
        $this->db->set('active', $active);
        $this->db->set('widget_open', $this->input->post('widget_open', TRUE));
        $this->db->set('widget_content', $this->input->post('widget_content', TRUE));
        $this->db->set('widget_seemore', $this->input->post('widget_seemore', TRUE));
        $this->db->set('widget_close', $this->input->post('widget_close', TRUE));
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('widget_xml_id', $id);
        $this->db->update('widget_xml');
        $this->Csz_model->clear_file_cache('widget_'.$this->Csz_model->encodeURL($this->input->post("widget_name", TRUE)));
    }

    /**
     * insertLinks
     *
     * Function for insert the new widget
     */
    public function insertLinks(){
        // Create the new links
        $this->db->set('url', $this->input->post('url', TRUE));
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('link_stat_mgt');
    }

    /**
     * updateBFSettings
     *
     * Function for update the Brute Force Protection settings
     */
    public function updateBFSettings(){
        $this->db->set('bf_protect_period', $this->input->post("bf_protect_period", TRUE));
        $this->db->set('max_failure', $this->input->post("max_failure", TRUE));
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where("login_security_config_id", 1);
        $this->db->update('login_security_config');
        $this->Csz_model->clear_file_cache('loadBFconfig');
    }

    /**
     * saveWhiteIP
     *
     * Function for insert the new whitelist IP Address
     */
    public function saveWhiteIP(){
        $ip_address = $this->input->post('ip_address', TRUE);
        if($this->Csz_model->chkBFwhitelistIP($ip_address) === FALSE && !empty($ip_address)){
            $data = array(
                'ip_address' => $ip_address,
                'note' => $this->input->post('note', TRUE),
            );
            $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
            $this->db->insert('whitelist_ip', $data);
            $this->removeData('blacklist_ip', 'ip_address', $ip_address);
            $this->db->cache_delete_all();
        }
    }

    /**
     * saveBlackIP
     *
     * Function for insert the new blacklist IP Address
     */
    public function saveBlackIP(){
        $ip_address = $this->input->post('ip_address', TRUE);
        if($this->Csz_model->chkBFblacklistIP($ip_address) === FALSE && !empty($ip_address)){
            $data = array(
                'ip_address' => $ip_address,
                'note' => $this->input->post('note', TRUE),
            );
            $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
            $this->db->insert('blacklist_ip', $data);
            $this->removeData('whitelist_ip', 'ip_address', $ip_address);
            $this->db->cache_delete_all();
        }
    }
    
    /**
     * insertBanner
     *
     * Function for insert the new banner
     */
    public function insertBanner(){
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('nofollow')) ? $nofollow = $this->input->post('nofollow', TRUE) : $nofollow = 0;
        $upload_file = '';
        if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
            $paramiter = '_1';
            $photo_id = time();
            $uploaddir = 'photo/banner/';
            $file_f = $_FILES['file_upload']['tmp_name'];
            $file_name = $_FILES['file_upload']['name'];
            $upload_file = $this->file_upload($file_f, $file_name, '', $uploaddir, $photo_id, $paramiter);
        }
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'img_path' => $upload_file,
            'width' => $this->input->post('width', TRUE),
            'height' => $this->input->post('height', TRUE),
            'link' => $this->input->post('link', TRUE),
            'start_date' => $this->input->post('start_date', TRUE),
            'end_date' => $this->input->post('end_date', TRUE),
            'nofollow' => $nofollow,
            'active' => $active,
            'note' => $this->input->post('note', TRUE),
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('banner_mgt', $data);
    }

    /**
     * updateBanner
     *
     * Function for update the banner
     *
     * @param	string	$id    banner id
     */
    public function updateBanner($id){
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('nofollow')) ? $nofollow = $this->input->post('nofollow', TRUE) : $nofollow = 0;
        if($this->input->post('del_file')){
            $upload_file = '';
            @unlink('photo/banner/'.$this->input->post('del_file', TRUE));
        }else{
            $upload_file = $this->input->post('picture');
            if(!empty($_FILES['file_upload']) && $_FILES['file_upload']['type'] == 'image/png' || $_FILES['file_upload']['type'] == 'image/jpg' || $_FILES['file_upload']['type'] == 'image/jpeg' || $_FILES['file_upload']['type'] == 'image/gif'){
                $paramiter = '_1';
                $photo_id = time();
                $uploaddir = 'photo/banner/';
                $file_f = $_FILES['file_upload']['tmp_name'];
                $file_name = $_FILES['file_upload']['name'];
                $upload_file = $this->file_upload($file_f, $file_name, $this->input->post('picture', TRUE), $uploaddir, $photo_id, $paramiter);
            }
        }
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'img_path' => $upload_file,
            'width' => $this->input->post('width', TRUE),
            'height' => $this->input->post('height', TRUE),
            'link' => $this->input->post('link', TRUE),
            'start_date' => $this->input->post('start_date', TRUE),
            'end_date' => $this->input->post('end_date', TRUE),
            'nofollow' => $nofollow,
            'active' => $active,
            'note' => $this->input->post('note', TRUE),
        );
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('banner_mgt_id', $id);
        $this->db->update('banner_mgt', $data);
    }
    
    /**
     * saveActionsLogs
     *
     * Function for save the login log into database
     *
     * @param	string	$url    current url
     * @param	string	$actions    actions text
     * @param	string	$note    note text
     */
    public function saveActionsLogs($url, $actions, $note = '') {
        $data = array(
            'email_login' => $this->session->userdata('admin_email'),
            'note' => $note,
            'url' => $url,
            'actions' => $actions,
        );
        $this->db->set('user_agent', $this->input->user_agent(), TRUE);
        $this->db->set('ip_address', $this->input->ip_address(), TRUE);
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('actions_logs', $data);
        unset($data);
    }
    
    /**
     * setMaintenance
     *
     * Function for set the maintenance mode on frontend
     *
     */
    public function setMaintenance() {
        $data = array('maintenance_active' => 1);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where("settings_id", 1);
        $this->db->update('settings', $data);
        $this->db->cache_delete_all();
        $this->Csz_model->clear_file_cache('config');
        $this->Csz_model->clear_file_cache('topmenu_*', TRUE);
    }
    
    /**
     * unsetMaintenance
     *
     * Function for unset the maintenance mode on frontend
     *
     */
    public function unsetMaintenance() {
        $data = array('maintenance_active' => 0);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where("settings_id", 1);
        $this->db->update('settings', $data);
        $this->db->cache_delete_all();
        $this->Csz_model->clear_file_cache('config');
        $this->Csz_model->clear_file_cache('topmenu_*', TRUE);
    }
    
    /**
     * getFormDraft
     *
     * Function for get data from form draft
     * 
     * @return	Object or FALSE
     */
    public function getFormDraft() {
        $this->db->select("*");
        $this->db->where("form_url", current_url());
        $this->db->where('user_admin_id', $this->session->userdata('user_admin_id'));
        $this->db->limit(1);
        $query = $this->db->get('save_formdraft');
        if(!empty($query) && $query->num_rows() > 0){
            $data = $query->first_row();
            return json_decode(base64_decode($data->submit_array), TRUE);
            
        }else{
            return FALSE;
        }
    }
    
    
    public function get_one_row_data($table, $where){

        return $this->db->where($where)->get($table)->row_array();
    }
    
    
    
    /**
     * getNextPrevious_for_reviews
     *
     * Function for get data for next and previous button on the view one admin_reviews data
     * 
     * @return  ROW ARRAY
     */
    public function getNextPrevious_for_reviews($idd, $for_min_max){
      
        if($for_min_max){
          $query = $this->db->query("SELECT * FROM admin_reviews where id = (select min(id) from admin_reviews where( id >'".$idd."' ))");
        }else{
          $query = $this->db->query("SELECT * FROM admin_reviews where id = (select max(id) from admin_reviews where( id <'".$idd."' ))"); 
        }
        return $query->row_array();
    }
    
    
    
    /**
     * getNextPrevious
     *
     * Function for get data for next and previous button on the view one application data
     * 
     * @return  ROW ARRAY
     */
    public function getNextPrevious($for_all, $applicaiton_id, $status, $grant_id, $complete, $for_min_max){
        if($for_min_max){
            
            if($for_all){
                $query = $this->db->query("SELECT * FROM application where id = (select min(id) from application where( id >'".$applicaiton_id."' AND status = '".$status."' AND complete = '".$complete."'))");
            }else{
               $query = $this->db->query("SELECT * FROM application where id = (select min(id) from application where( id >'".$applicaiton_id."' AND grant_id = '".$grant_id."'  AND status = '".$status."' AND complete = '".$complete."'))"); 
            }
        }else{
            if($for_all){
                $query = $this->db->query("SELECT * FROM application where id = (select max(id) from application where( id <'".$applicaiton_id."' AND status = '".$status."' AND complete = '".$complete."'))"); 
            }else{
               $query = $this->db->query("SELECT * FROM application where id = (select max(id) from application where( id <'".$applicaiton_id."' AND grant_id = '".$grant_id."' AND status = '".$status."' AND complete = '".$complete."'))");  
            }
        }
       //$query = $this->db->query("SELECT * FROM application where id = (select min(id) from application where( id $operatorr '".$applicaiton_id."' AND status = '".$status."'))");
       return $query->row_array();
    }
   
    /**
     * getFormDraft
     *
     * Function for get data from form draft
     * 
     * @return	Object or FALSE
     */
    public function getDraftArray($array_key) {
        $data = $this->getFormDraft();
        if($data !== FALSE && is_array($data) && isset($data[$array_key])){
            return $data[$array_key];
        }else{
            return '';
        }
    }
    
    /**
     * getSaveDraftJS
     *
     * Function for get data from form draft
     * 
     * @return	String
     */
    public function getSaveDraftJS() {
        $more_js = '
        $(document).ready(function () {
            $("#save_draft").click(function () {
                tinyMCE.triggerSave(); /* save TinyMCE instances before serialize */
                var fields = $("form").serialize();
                var urlpost = "'.$this->Csz_model->base_link().'/admin/admin/saveDraft'.'";
                $.ajax({
                    url: urlpost,
                    type: "POST",
                    data: fields,
                    success: function (a) {
                        if(a == "SUCCESS"){
                            $("#save_draft_res").html("'.$this->lang->line('success_message_alert').'");
                        }else{
                            $("#save_draft_res").html("");
                        }
                    }
                });
                return false;
            });
        });';
        return $more_js;
    }
    
    /**
     * makePrivateKey
     *
     * Function for make private key from db
     * 
     */
    public function makePrivateKey() {
        $row = $this->load_config();
        $user = $this->getUser(1);
        $gmdate = gmdate("YmdHis", time());
        $private_key = sha1($row->default_email . '|' . $this->Csz_model->base_link() . '|' . $user->password . '|cszcms|' . $gmdate);
        $this->db->set('bf_private_key', $private_key);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where("login_security_config_id", 1);
        $this->db->update('login_security_config');
        $this->Csz_model->clear_file_cache('loadBFconfig');
    }
    
    /**
     * getPrivateKey
     *
     * Function for get private key from db
     * 
     * @return	String
     */
    public function getPrivateKey() {
        $this->db->select('bf_private_key');
        $this->db->where("login_security_config_id", '1');
        $this->db->limit(1, 0);
        $query = $this->db->get("login_security_config");
        if(!empty($query) && $query->num_rows() > 0){
            $private_key = $query->row()->bf_private_key;
            if(!empty($private_key) && $private_key != NULL){
                return $private_key;
            }else{
                return '-';
            }
        }else{
            return '-';
        }
    }
    
    /**
     * getIndexDataFromObj
     *
     * Function for get data for index page from object data (support pageination)
     *
     * @param	object	$data    Object data from xml
     * @param	int	$limit    limit [show limit]
     * @param	int	$page   page index
     * @return	object or FALSE
     */
    public function getIndexDataFromObj($data, $limit = 0, $offset = 1){
        if($data && is_object($data) && $data !== FALSE){
            if($limit && $limit != 0){
                $data_r = (array)$data->plugin;
                $count = count($data_r);
                if($offset > ceil((intval($count) / intval($limit)))) $offset = ceil((intval($count) / intval($limit)));
                $start = (intval($offset) * intval($limit)) - intval($limit);
                if($start < 0) $start = 0;
                $outArray = array_slice($data_r, $start, ($start+($limit)));
                unset($limit,$offset,$data_r,$data,$start,$count);
                return (object)$outArray;
            }else{
                unset($limit,$offset);
                return $data->plugin;
            }
        }else{
            return FALSE;
        }
    }
    
    /**
     * getPluginXML
     *
     * Function for get latest version from xml url
     *
     * @param	string	$xml_url    xml url file
     * @param	string	$key_search    key search from xml
     * @param	string	$search    search from xml
     * @return	object or FALSE
     */
    public function getPluginXML($xml_url = '', $key_search = '', $search = ''){       
        if(!$xml_url) $xml_url = $this->config->item('csz_pluginxmlurl_main');
        if (!$this->cache->get('plugin_list_xml' . md5($xml_url))) {
            $xml_url_bak = $this->config->item('csz_pluginxmlurl_backup');
            if($this->Csz_model->is_url_exist($xml_url) !== FALSE){
                $return = $this->Csz_model->get_contents_url($xml_url);
            }else if($this->Csz_model->is_url_exist($xml_url) === FALSE && $this->Csz_model->is_url_exist($xml_url_bak) !== FALSE){
                $return = $this->Csz_model->get_contents_url($xml_url_bak);
            }else{
                $return = FALSE;
            }
            if($return !== FALSE){
                $this->cache->save('plugin_list_xml' . md5($xml_url), $return, ($this->cachetime * 60));
            }
            unset($xml_url_bak,$return);
        }
        if($this->cache->get('plugin_list_xml' . md5($xml_url)) !== FALSE && $key_search && $search){
            $xml = simplexml_load_string($this->cache->get('plugin_list_xml' . md5($xml_url)));
            $plugin = $xml->xpath("//cszcms/plugin/" . $key_search . "[.='$search']/parent::*");
            if (count($plugin) > 0) { // if found
                unset($key_search, $search, $xml);
                return (object) array('plugin' => json_decode(str_replace('"comment":[{},{},{}],', '', json_encode($plugin))));
            } else {
                unset($key_search, $search, $xml);
                return FALSE;
            }
        }else if($this->cache->get('plugin_list_xml' . md5($xml_url)) !== FALSE && (!$key_search || !$search)){
            $plugin_list = simplexml_load_string($this->cache->get('plugin_list_xml' . md5($xml_url)));
            return (object) json_decode(str_replace('"comment":[{},{},{}],', '', json_encode($plugin_list)));
        }else{
            return FALSE;
        }
    }
    
    /**
     * getLatestVerArray
     *
     * Function for get latest version from xml url
     *
     * @return	array
     */
    private function setLatestVer(){
        if (!$this->cache->get('plugin_list_version')) {
            $plugin_list = $this->getPluginXML();
            if ($plugin_list !== FALSE) {
                $ver_arr = array();
                foreach ($plugin_list->plugin as $xml) {
                    if($xml->filename && $xml->version) $ver_arr[strval($xml->filename)] = strval($xml->version);
                }
            }else{
                $ver_arr = FALSE;
            }
            $this->cache->save('plugin_list_version', $ver_arr, ($this->cachetime * 60));
            unset($plugin_list, $ver_arr);
        }
        return $this->cache->get('plugin_list_version');
    }
    
    /**
     * pluginLatestVer
     *
     * Function for get latest version from xml url
     *
     * @param	string	$plugin_config_filename    for plugin config filename
     * @return	String or FALSE
     */
    public function pluginLatestVer($plugin_config_filename){
        $ver_arr = $this->setLatestVer();
        if($ver_arr !== FALSE && is_array($ver_arr) && !empty($ver_arr)){
            return $ver_arr[$plugin_config_filename]; 
        }else{
            return FALSE;
        }
    }
    
    /**
     * chkPluginInst
     *
     * Function for get latest version from xml url
     *
     * @param	string	$plugin_config_filename    for plugin config filename
     * @return	TRUE or FALSE
     */
    public function chkPluginInst($plugin_config_filename){
        $count = $this->Csz_model->countData('plugin_manager', "plugin_config_filename = '".$plugin_config_filename."'");        
        if($count != 0){
            unset($plugin_config_filename, $count);
            return TRUE;
        }else{
            unset($plugin_config_filename, $count);
            return FALSE;
        }
    }
    
    /**
     * chkPluginUpdate
     *
     * Function for check version for plugin update
     *
     * @param	string	$cur_ver    current version
     * @param	string	$last_ver    latest version
     * @return	true or false
     */
    public function chkPluginUpdate($cur_ver, $last_ver){
        return $this->Csz_model->chkVerUpdate($cur_ver, $last_ver);
    }
    
    /**
     * pluginNextVer
     *
     * Function for check next version for plugin update
     *
     * @param	string	$cur_txt    current version
     * @param	string	$last_ver    latest version
     * @param   string  $previous_ver   previous version
     * @return	string or false
     */
    public function pluginNextVer($cur_txt, $last_ver, $previous_ver = ''){
        return $this->Csz_model->findNextVersion($cur_txt, $last_ver, $previous_ver);
    }
    
    private function cszCredit(){
        /* Please do not remove or change this function */
        return $this->config->item('cszcms_credit').' Version '.$this->Csz_model->getVersion();
    }
    
    public function cszGenerateMeta(){
        /* Please do not remove or change this function */
        return 'CSZ CMS | Version '.$this->Csz_model->getVersion();
    }
    
    /**
     * Export the database to csv
     *
     * @param   srting $filename  Filename
     * @param   srting $table  Database Table to export
     * @param   array $field_sel  Database field to select to export
     * @param   srting $where  Where condition
     * @param   string	$orderby   Order by field or NULL 
     * @param   string	$sort   asc or desc or NULL
     * @param	string	$groupby   Group by field or NULL 
     * @return  string  File download
     */
    public function exportCSV($filename, $table, $field_sel = "", $where = "", $orderby = "", $sort = "ASC", $groupby = '') {
        if (function_exists('ini_set')) {
            @ini_set('max_execution_time', 600);
            @ini_set('memory_limit','512M');
        }
        if(!$field_sel) $field_sel = "*";
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        if(is_string($field_sel)){
            $field_sel = array($field_sel);
        }
        $this->db->select($field_sel);
        if ($where) {
            if (is_array($where)) {
                /* $search = array('field'=>'value') */
                foreach ($where as $key => $value) {
                    $this->db->where($key, $value);
                }
            } else {
                /* $search = "name='Joe' AND status LIKE '%boss%' OR status1 LIKE '%active%'") */
                $this->db->where($where);
            }
        }
        if ($groupby){
            $this->db->group_by($groupby);
        }
        if(is_array($orderby)){
            foreach ($orderby as $value) {
                $this->db->order_by($value, $sort);
            }
        }else{
            if ($orderby && $sort) {
                $this->db->order_by($orderby, $sort);
            }elseif($orderby){
                $this->db->order_by($orderby);
            }
        }
        $result = $this->db->get($table);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        $filename1 = str_replace('.csv', '', $filename);
        $csv_filename = EMAIL_DOMAIN . '_csv_'.$filename1.'_'.date('Ymd').'.csv';
        write_file(FCPATH.$csv_filename, $data);
        unset($table, $field_sel, $where, $orderby, $sort, $groupby, $delimiter, $newline, $result, $data, $filename, $filename1);
        force_download($csv_filename, NULL);
    }
    
    /**
     * Find the primary key from db table
     *
     * @param srting $table  Database Table
     * @return string|array
     */
    public function findPrimaryKey($table) {
        if (!$this->cache->get('findPrimaryKey_'.$table)) {
            $field_data = $this->db->field_data($table);
            $return_arr = array();
            foreach ($field_data as $field) {
                if($field->primary_key) {
                    $return_arr[] = $field->name;
                }
            }
            unset($field_data, $field);
            if(count($return_arr) == 1){ /* have only one primary key return string */
                $return = $return_arr[0];
            }else{ /* have many primary key return array */
                $return = $return_arr;
            }
            $this->cache->save('findPrimaryKey_'.$table, $return, ($this->cachetime * 60));
            unset($return, $return_arr);
        }
        return $this->cache->get('findPrimaryKey_'.$table);
    }
    
    /**
     * pluginUninstall
     *
     * Function for clean uninstall the plugin from the CMS
     *
     * @param	string	$plugin_config_filename    for plugin config filename
     * @return	TRUE or FALSE
     */
    public function pluginUninstall($plugin_config_filename){
        $plugin_file_path = $this->Csz_model->getPluginConfig($plugin_config_filename, 'plugin_file_path');
        $plugin_db_table = $this->Csz_model->getPluginConfig($plugin_config_filename, 'plugin_db_table');
        if($plugin_file_path !== FALSE && is_array($plugin_file_path) && $plugin_config_filename != 'article' && $plugin_config_filename != 'gallery'){
            foreach ($plugin_file_path as $value) {
                if($value && is_file($value) && is_writable($value)){
                    @unlink($value);
                }else if($value && is_dir($value)) {
                    $this->Csz_model->rmdir_recursive($value);
                }
            }
            if($plugin_db_table !== FALSE && is_array($plugin_db_table)){
                $this->load->dbforge();
                foreach ($plugin_db_table as $value) {
                    if($value) {
                        $this->dbforge->drop_table($value, TRUE);
                    }
                }
            }
            $this->removeData('general_label', "name LIKE '".$plugin_config_filename."%'");
            $this->removeData('user_perms', "name LIKE '".$plugin_config_filename."%'");
            $this->removeData('user_perms', "name LIKE '".$this->Csz_model->getPluginConfig($plugin_config_filename, 'plugin_name')."%'");
            $this->removeData('plugin_manager', 'plugin_config_filename', $plugin_config_filename);
            unset($plugin_config_filename,$plugin_file_path,$plugin_db_table,$value);
            return TRUE;
        }else{
            unset($plugin_config_filename,$plugin_file_path,$plugin_db_table);
            return FALSE;
        }
    }

    private function getNiceFileSize($bytes) {
        $unit = array('B', 'K', 'M', 'G', 'T', 'P');
        if ($bytes == 0){ return '0 ' . $unit[0]; }
        return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . (isset($unit[$i]) ? $unit[$i] : 'B');
    }
    
    public function getServerIp() {
        if (!$this->cache->get('SERVER_ADDR')) {
            $this->cache->save('SERVER_ADDR', @getenv('SERVER_ADDR'), ($this->cachetime * 60));
        }
        return $this->cache->get('SERVER_ADDR');
    }

    /**
     * Returns information about the operating system PHP is running on
     * @param string $mode [optional] <p>
     * <i>mode</i> is a single character that defines what
     * information is returned:
     * 'a': This is the default. Contains all modes in
     * the sequence "s n r v m".
     * @return string the description, as a string.
     */
    public function getSoftwareInfo($mode = 'a') {
        if (!$this->cache->get('php_uname_'.$mode)) {
            $this->cache->save('php_uname_'.$mode, @php_uname($mode), ($this->cachetime * 60));
        }
        return $this->cache->get('php_uname_'.$mode);
    }

    /**
    * Get the directory size
    * @param directory $directory
    * @return integer
    */
   public function dirSize($directory) {
        if (!$this->cache->get('chkDirSize_' . md5($directory))) {
            $size = 0;
            foreach (scandir($directory) as $file) {
                if ($file != "." and $file != "..") {
                    $path = $directory . "/" . $file;
                    if (is_file($path)) {
                        $size += filesize($path);
                    } else {
                        if (is_dir($path)) $size += $this->dirSize($path);
                    }
                }
            }
            $this->cache->save('chkDirSize_' . md5($directory), $size, ($this->cachetime * 60));
            unset($file, $path, $size);
        }
        return $this->cache->get('chkDirSize_' . md5($directory));
   } 

    public function usageSpace() {
        if (!$this->cache->get('usageSpace')) {
            $this->cache->save('usageSpace', $this->getNiceFileSize(@$this->dirSize(FCPATH)), ($this->cachetime * 60));
        }
        return $this->cache->get('usageSpace');
    }

    public function memUsage() {
        $memuse = @memory_get_usage(TRUE);
        if($memuse){
            return $this->getNiceFileSize($memuse);
        }else{
            return "-";
        }
    }
    
    public function getMemLimit() {
        if (!$this->cache->get('memory_limit')) {
            if (!ini_get('memory_limit')) {
                $return = "-";
            } else {
                $return = @ini_get('memory_limit');
            }
            $this->cache->save('memory_limit', $return, ($this->cachetime * 60));
        }
        return $this->cache->get('memory_limit');
    }

    public function getDisabledFunctions() {
        if (!$this->cache->get('disable_functions')) {
            if (!ini_get('disable_functions')) {
                $return = "-";
            } else {
                $return = @ini_get('disable_functions');
            }
            $this->cache->save('disable_functions', $return, ($this->cachetime * 60));
        }
        return $this->cache->get('disable_functions');
    }

    /**
     * insertCarousel
     *
     * Function for insert the new carousel
     */
    public function insertCarousel(){
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;       
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'active' => $active,
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('carousel_widget', $data);
    }

    /**
     * updateCarousel
     *
     * Function for update the carousel
     *
     * @param	string	$id    banner id
     */
    public function updateCarousel($id){
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        ($this->input->post('custom_temp_active')) ? $custom_temp_active = $this->input->post('custom_temp_active', TRUE) : $custom_temp_active = 0;
        $data = array(
            'name' => $this->input->post('name', TRUE),            
            'active' => $active,
            'custom_temp_active' => $custom_temp_active,
            'custom_template' => $this->input->post('custom_template', FALSE),
        );
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('carousel_widget_id', $id);
        $this->db->update('carousel_widget', $data);
    }
    
    /**
     * insertCarouselUpload
     *
     * Function for upload the carousel photo
     *
     * @param	string	$carousel_widget_id    carousel widget id
     * @param	string	$carousel_type    carousel type into database
     * @param	string	$fileupload    file upload path into database
     * @param	string	$youtube_url    youtube url into database
     * @param	string	$photo_url    photo url into database
     */
    public function insertCarouselUpload($carousel_widget_id, $carousel_type, $fileupload = '', $youtube_url = '', $photo_url = '') {
        $img_rs = $this->Csz_model->getValue('arrange', 'carousel_picture', "carousel_widget_id", $carousel_widget_id, 1, 'arrange', 'desc');
        if(!empty($img_rs)){
            $arrange = $img_rs->arrange;
        }else{
            $arrange = 0;
        }
        $data = array(
            'carousel_widget_id' => $carousel_widget_id,
            'arrange' => ($arrange)+1,
        );
        if($fileupload){ $this->db->set('file_upload', $fileupload, TRUE); }
        $this->db->set('carousel_type', $carousel_type, TRUE);
        if($youtube_url){ $this->db->set('youtube_url', $youtube_url, TRUE); }
        if($photo_url){ $this->db->set('photo_url', $photo_url, TRUE); }
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('carousel_picture', $data);
    }
    
    /**
     * getAllPluginWidget
     *
     * Function for insert the new carousel
     * 
     * @return	array
     */
    public function getAllPluginWidget(){
        $return = array();
        $all_plugin = $this->Csz_model->getValueArray('*', 'plugin_manager', 'plugin_active', '1');
        if($all_plugin !== FALSE){
            foreach ($all_plugin as $value) {
                $plugin_widget_viewtable = $this->Csz_model->getPluginConfig($value['plugin_config_filename'], 'plugin_widget_viewtable');
                if($plugin_widget_viewtable && $plugin_widget_viewtable !== FALSE){
                    $return[] = $value['plugin_config_filename'];
                }
            }
        }
        return $return;
    }
    
    /**
     * insertPWidget
     *
     * Function for insert the new plugin widget
     */
    public function insertPWidget(){
        // Create the new lang
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'plugin_filename' => $this->input->post('plugin_filename', TRUE),
            'sort_by' => $this->input->post('sort_by', TRUE),
            'order_by' => $this->input->post('order_by', TRUE),
            'active' => $active,
            'data_limit' => $this->input->post('data_limit', TRUE),
            'view_id' => str_replace('.', '', $this->input->post('view_id', TRUE)),
            'template_code' => $this->input->post('template_code', FALSE),
            'lang_iso' => $this->input->post('lang_iso', TRUE),
        );
        $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->insert('plugin_widget', $data);
    }

    /**
     * updatePWidget
     *
     * Function for update the plugin widget
     *
     * @param	string	$id    widget id
     */
    public function updatePWidget($id){
        // Update the lang
        ($this->input->post('active')) ? $active = $this->input->post('active', TRUE) : $active = 0;
        $data = array(
            'name' => $this->input->post('name', TRUE),
            'plugin_filename' => $this->input->post('plugin_filename', TRUE),
            'sort_by' => $this->input->post('sort_by', TRUE),
            'order_by' => $this->input->post('order_by', TRUE),
            'active' => $active,
            'data_limit' => $this->input->post('data_limit', TRUE),
            'view_id' => str_replace('.', '', $this->input->post('view_id', TRUE)),
            'template_code' => $this->input->post('template_code', FALSE),
            'lang_iso' => $this->input->post('lang_iso', TRUE),
        );
        $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
        $this->db->where('plugin_widget_id', $id);
        $this->db->update('plugin_widget', $data);
        $this->Csz_model->clear_file_cache('pwidget_' . md5($id));
    }
    
    /**
     * jsredirect
     *
     * Function for redirect with javascript
     *
     * @param	string	$uri    URL
     * @param	int	$delay    delay before redirect
     */
    public function jsredirect($uri, $delay = 100){
        redirect($uri, 'auto', NULL, TRUE, $delay);
    }
    
    /**
     * insertDataForm
     *
     * Function for insert new submit data form on backend
     *
     * @param	int	$form_id    form id
     */
    public function insertDataForm($form_id) {
        $return = TRUE;
        $frm_rs = $this->Csz_model->getValue('*', 'form_main', 'form_main_id', $form_id, 1);
        if ($frm_rs !== FALSE && $frm_rs->active) {
            $field_rs = $this->Csz_model->getValue('*', 'form_field', 'form_main_id', $form_id, '', array('arrange', 'form_field_id'), 'ASC');
            $data = array();
            $ext_accept = array();
            $file_sql = '';
            $field_filename = '';
            foreach ($field_rs as $f_val) {
                if ($f_val->field_required && !$this->input->post_get($f_val->field_name, TRUE) && $f_val->field_type != 'button' && $f_val->field_type != 'reset' && $f_val->field_type != 'submit' && $f_val->field_type != 'label' && $f_val->field_type != 'file') {
                    $return = FALSE;
                    break;
                }
                if ($f_val->field_type != 'button' && $f_val->field_type != 'reset' && $f_val->field_type != 'submit' && $f_val->field_type != 'label' && $f_val->field_type != 'file') {
                    if ($f_val->field_type == 'email') {
                        $data[$f_val->field_name] = $this->Csz_model->cleanEmailFormat($this->input->post_get($f_val->field_name, TRUE));
                    } else if ($f_val->field_type == 'textarea') {
                        $data[$f_val->field_name] = $this->Csz_model->cleanOSCommand(strip_tags($this->input->post_get($f_val->field_name, TRUE)));
                    } else {
                        $data[$f_val->field_name] = $this->input->post_get($f_val->field_name, TRUE);
                    }
                    if ($f_val->sel_option_val) {
                        $opt_arr = explode(",", str_replace(' ', '', $f_val->sel_option_val));
                        foreach ($opt_arr as $opt) {
                            list($maxlengthnum, $minlengthnum) = explode("=>", $opt);
                            if (is_numeric($maxlengthnum) && $maxlengthnum > 0) {
                                $data[$f_val->field_name] = substr($data[$f_val->field_name], 0, $maxlengthnum);
                                break;
                            }
                        }
                    }
                } else if ($frm_rs->form_method == 'post' && $f_val->field_type == 'file') {
                    if ($f_val->field_required && !isset($_FILES[$f_val->field_name]) && (!$_FILES[$f_val->field_name]['tmp_name'] || !$_FILES[$f_val->field_name]['name'])) {
                        $return = FALSE;
                        break;
                    }
                    if (isset($_FILES[$f_val->field_name]) && $_FILES[$f_val->field_name]['tmp_name'] && $_FILES[$f_val->field_name]['name']) {
                        $ext = str_replace('.', '', strrchr($_FILES[$f_val->field_name]['name'], "."));
                        $file_name = (Date("dmy_His") . '.' . $ext);
                        if ($f_val->sel_option_val != NULL && $f_val->sel_option_val) {
                            $sel_opt = trim(str_replace('.', '', strtoupper($f_val->sel_option_val)));
                            $ext_accept = explode(',', str_replace(' ', '', $sel_opt));
                            if (is_array($ext_accept) && !empty($ext_accept) && !in_array(strtoupper($ext), $ext_accept)) {
                                $return = FALSE;
                                break;
                            }
                            unset($ext, $ext_accept, $sel_opt);
                        }
                        $path = FCPATH . "/photo/forms/" . $this->Csz_model->cleanEmailFormat($frm_rs->form_name) . "/" . $this->Csz_model->cleanEmailFormat($f_val->field_name) . "/";
                        $paramiter = '_1';
                        $file_id = time() . "_" . rand(1111, 9999);
                        $file_f = $_FILES[$f_val->field_name]['tmp_name'];
                        $file_sql = $this->Csz_admin_model->file_upload($file_f, $file_name, '', $path, $file_id, $paramiter);
                        $data[$f_val->field_name] = $file_sql;
                        $field_filename = $f_val->field_name;
                    }
                }
            }
            if ($frm_rs->dont_repeat_field && $this->Csz_admin_model->countTable('form_' . $frm_rs->form_name, $frm_rs->dont_repeat_field . " = '" . $data[$frm_rs->dont_repeat_field] . "'") > 0) {
                $return = FALSE;
                if($field_filename){
                    @unlink(FCPATH . "/photo/" . str_replace(FCPATH . "/photo/", '', rtrim('forms/'.$this->Csz_model->cleanEmailFormat($frm_rs->form_name).'/'.$this->Csz_model->cleanEmailFormat($field_filename), '/')) . '/' . $data[$field_filename]);
                }
                unset($data);
            }
            if ($return !== FALSE) {
                $this->db->set('ip_address', $this->input->ip_address(), TRUE);
                $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
                $this->db->insert('form_' . $frm_rs->form_name, $data);
            }
        } else {
            $return = FALSE;
        }
        return $return;
    }

    /**
     * updateDataForm
     *
     * Function for update submit data form on backend
     *
     * @param	int	$form_id    form id
     * @param	int	$data_id    submit data form id
     */
    public function updateDataForm($form_id, $data_id) {
        $return = TRUE;
        $frm_rs = $this->Csz_model->getValue('*', 'form_main', 'form_main_id', $form_id, 1);
        if ($frm_rs !== FALSE && $frm_rs->active) {
            $field_rs = $this->Csz_model->getValue('*', 'form_field', 'form_main_id', $form_id, '', array('arrange', 'form_field_id'), 'ASC');
            $data = array();
            $ext_accept = array();
            $file_sql = '';
            $field_filename = '';
            foreach ($field_rs as $f_val) {
                if ($f_val->field_required && !$this->input->post_get($f_val->field_name, TRUE) && $f_val->field_type != 'button' && $f_val->field_type != 'reset' && $f_val->field_type != 'submit' && $f_val->field_type != 'label' && $f_val->field_type != 'file') {
                    $return = FALSE;
                    break;
                }
                if ($f_val->field_type != 'button' && $f_val->field_type != 'reset' && $f_val->field_type != 'submit' && $f_val->field_type != 'label' && $f_val->field_type != 'file') {
                    if ($f_val->field_type == 'email') {
                        $data[$f_val->field_name] = $this->Csz_model->cleanEmailFormat($this->input->post_get($f_val->field_name, TRUE));
                    } else if ($f_val->field_type == 'textarea') {
                        $data[$f_val->field_name] = $this->Csz_model->cleanOSCommand(strip_tags($this->input->post_get($f_val->field_name, TRUE)));
                    } else {
                        $data[$f_val->field_name] = $this->input->post_get($f_val->field_name, TRUE);
                    }
                    if ($f_val->sel_option_val) {
                        $opt_arr = explode(",", str_replace(' ', '', $f_val->sel_option_val));
                        foreach ($opt_arr as $opt) {
                            list($maxlengthnum, $minlengthnum) = explode("=>", $opt);
                            if (is_numeric($maxlengthnum) && $maxlengthnum > 0) {
                                $data[$f_val->field_name] = substr($data[$f_val->field_name], 0, $maxlengthnum);
                                break;
                            }
                        }
                    }
                } else if ($frm_rs->form_method == 'post' && $f_val->field_type == 'file') {
                    if (isset($_FILES[$f_val->field_name]) && $_FILES[$f_val->field_name]['tmp_name'] && $_FILES[$f_val->field_name]['name']) {
                        $ext = str_replace('.', '', strrchr($_FILES[$f_val->field_name]['name'], "."));
                        $file_name = (Date("dmy_His") . '.' . $ext);
                        if ($f_val->sel_option_val != NULL && $f_val->sel_option_val) {
                            $sel_opt = trim(str_replace('.', '', strtoupper($f_val->sel_option_val)));
                            $ext_accept = explode(',', str_replace(' ', '', $sel_opt));
                            if (is_array($ext_accept) && !empty($ext_accept) && !in_array(strtoupper($ext), $ext_accept)) {
                                $return = FALSE;
                                break;
                            }
                            unset($ext, $ext_accept, $sel_opt);
                        }
                        $path = FCPATH . "/photo/forms/" . $this->Csz_model->cleanEmailFormat($frm_rs->form_name) . "/" . $this->Csz_model->cleanEmailFormat($f_val->field_name) . "/";
                        $paramiter = '_1';
                        $file_id = time() . "_" . rand(1111, 9999);
                        $file_f = $_FILES[$f_val->field_name]['tmp_name'];
                        $file_sql = $this->Csz_admin_model->file_upload($file_f, $file_name, '', $path, $file_id, $paramiter);
                        $data[$f_val->field_name] = $file_sql;
                        $field_filename = $f_val->field_name;
                    }
                    $delfile = $this->input->post($f_val->field_name.'_delfile', TRUE);
                    if($delfile && (!$frm_rs->dont_repeat_field || $this->Csz_admin_model->countTable('form_' . $frm_rs->form_name, $frm_rs->dont_repeat_field . " = '" . $data[$frm_rs->dont_repeat_field] . "' AND ".$frm_rs->dont_repeat_field . " != '".$this->input->post($frm_rs->dont_repeat_field.'_old', TRUE)."'") == 0)){
                        @unlink($delfile);
                        $data[$f_val->field_name] = '';
                        $field_filename = '';
                    }
                }
            }
            if ($frm_rs->dont_repeat_field && $this->Csz_admin_model->countTable('form_' . $frm_rs->form_name, $frm_rs->dont_repeat_field . " = '" . $data[$frm_rs->dont_repeat_field] . "' AND ".$frm_rs->dont_repeat_field . " != '".$this->input->post($frm_rs->dont_repeat_field.'_old', TRUE)."'") > 0) {
                $return = FALSE;
                if($field_filename){
                    @unlink(FCPATH . "/photo/" . str_replace(FCPATH . "/photo/", '', rtrim('forms/'.$this->Csz_model->cleanEmailFormat($frm_rs->form_name).'/'.$this->Csz_model->cleanEmailFormat($field_filename), '/')) . '/' . $data[$field_filename]);
                }
                unset($data);
            }
            if ($return !== FALSE) {
                $this->db->where('form_' . $frm_rs->form_name . '_id', $data_id);
                $this->db->update('form_' . $frm_rs->form_name, $data);
            }
        }else{
            $return = FALSE;
        }
        return $return;
    }
}
