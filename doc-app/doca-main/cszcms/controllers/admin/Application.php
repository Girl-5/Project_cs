<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CSZ CMS
 *
 * An open source content management system
 *
 * Copyright (c) 2016, Astian Foundation.
 *
 * Astian Develop Public License (ADPL)
 * 
 * This Source Code Form is subject to the terms of the Astian Develop Public
 * License, v. 1.0. If a copy of the APL was not distributed with this
 * file, You can obtain one at http://astian.org/about-ADPL
 * 
 * @author	CSKAZA
 * @copyright   Copyright (c) 2016, Astian Foundation.
 * @license	http://astian.org/about-ADPL	ADPL License
 * @link	https://www.cszcms.com
 * @since	Version 1.0.0
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require FCPATH.'system/libraries/PHPMailer/src/Exception.php';
require FCPATH.'system/libraries/PHPMailer/src/PHPMailer.php';
require FCPATH.'system/libraries/PHPMailer/src/SMTP.php';
class Application extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('admin', $this->Csz_admin_model->getLang());
        $this->template->set_template('admin');
        $this->_init();
    }

    public function _init() {
        $this->template->set('core_css', $this->Csz_admin_model->coreCss());
        $this->template->set('core_js', $this->Csz_admin_model->coreJs());
        $this->template->set('name', 'Backend System | ' . $this->Csz_admin_model->load_config()->site_name);
        $this->template->set('meta_tags', $this->Csz_admin_model->coreMetatags('Backend System for CSZ Content Management System'));
        $this->template->set('cur_page', $this->Csz_admin_model->getCurPages());
    }

    public function index($pagenit = 0) {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        //admin_helper::is_allowchk('admin users');
        $this->load->library('pagination');
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        $search_arr = " ";
        if($this->input->get('search')){
            $search_arr.= ' 1=1 ';
            if($this->input->get('search')){
                // $search_arr.= " AND name LIKE '%".$this->input->get('search', TRUE)."%'";
            }
        }
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->Csz_model->countData('application', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/application/';
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link);     
        ($this->uri->segment(3))? $pagination = $this->uri->segment(3) : $pagination = 0;
        //Get users from database
        
        //$this->template->setSub('application', $this->Csz_admin_model->getIndexData('application', $result_per_page, $pagination, 'grant_id', 'ASC', $search_arr));
        $this->template->setSub('application', $this->Csz_admin_model->getIndexData('application', '', '', 'grant_id', 'ASC', $search_arr)); 
        $search_arr = "active=1";
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'ASC', $search_arr);
            $grantArray = [];
            if(!empty($grant)){
                foreach($grant as $vl){
                    $grantArray[$vl['id']] = $vl['title'];
                }
            }
            // print_r($grantArray); die;
        $this->template->setSub('grant', $grantArray);
        
        $search_arr = "status=1";
            $applicant = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            $applicantArray = [];
            $applicantPhone = [];
            $applicantCountryy = [];

            if(!empty($applicant)){
                foreach($applicant as $vl){
                    $applicantArray[$vl['id']] = $vl['name'];
                     $applicantPhone[$vl['id']] = $vl['phone'];
                     $applicantCountryy[$vl['id']] = $vl['nationality'];
                }
            }
            // print_r($grantArray); die;
        $this->template->setSub('name', $applicantArray);
        $this->template->setSub('phone', $applicantPhone);
       
        $this->template->setSub('country_aplcnt', $applicantCountryy);
        $country = $this->returnCountry();
        $this->template->setSub('country', $country );
        
        
        $this->template->setSub('total_row', $total_row);       
        //Load the view
        $this->template->loadSub('admin/application/index');
    }
    

//==============================================================================
    
    public function savereview($application_id, $for_all=""){
       
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        $post = $this->input->post();
        unset($post['submit']);
        $post['application_id'] = $application_id;
        ///============ FOR CHECKBOX VALUE IF SET/NOT SET =============
        $post['ten_ques_a'] = $post['ten_ques_a'] ? $post['ten_ques_a'] : 0  ;
        // $post['ten_ques_b'] = $post['ten_ques_b'] ? 1 : 0  ;
        // $post['ten_ques_c'] = $post['ten_ques_c'] ? 1 : 0  ;
        // $post['ten_ques_d'] = $post['ten_ques_d'] ? 1 : 0  ;
        $post['eleven_ques_a'] = $post['eleven_ques_a'] ? $post['eleven_ques_a'] : 0  ;
        // $post['eleven_ques_b'] = $post['eleven_ques_b'] ? 1 : 0  ;
        // $post['eleven_ques_c'] = $post['eleven_ques_c'] ? 1  : 0  ;
        
        $post['admin_id'] = $this->session->userdata('user_admin_id');
        //===================CHECK any similar ranking for same grant ========
        $application = $this->Csz_model->getApplicationAllData($application_id);
        $duplicate_rank = $this->Csz_admin_model->checkForDuplicateRank($post['rank'],$post['admin_id'],$application['grant_id']);

        if($duplicate_rank !== false){
//            print_r($duplicate_rank['application_id']);
//            die();
            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">There is another application with a similar rank! <a target="_blank" href="/admin/application/viewoneapplication/'.$duplicate_rank["application_id"].'">Edit Review</a></div>');
            redirect('/admin/application/viewoneapplication/'.$application_id.'/'.$for_all, 'refresh');
        }
        //===================UPDATE/ INSERT REVIEW DATA ============
        $resp = $this->Csz_admin_model->updateinsertReview($post, $application_id) ;
        if($resp){
            $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
            redirect('/admin/application/viewoneapplication/'.$application_id.'/'.$for_all, 'refresh');    
        }else{

            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">Something went wrong!</div>');
            redirect('/admin/application/viewoneapplication/'.$application_id.'/'.$for_all, 'refresh');    
        }
    }
    
    //===== VIEW ALL APPLICATION BY STATUS:  SUBMITTED, REJECTED, IN-PROGRESS AND ACCEPTED ==============
     public function viewallapplications() {
         
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        if($this->uri->segment(4) == "inprogress" || $this->uri->segment(4) == "submitted" || $this->uri->segment(4) == "rejected"){
            admin_helper::is_allowchk('admin users');
        }
       // admin_helper::is_allowchk('admin users');
        $this->load->library('pagination');
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        $search_arr = "1=1 ";
        if($this->uri->segment(4) == "submitted" ){    ///============ FOR ALL APPLICATION WITH COMPLETE = 1   SUBMITTED
            $search_arr.= ' AND application.complete= 1';
        }
        if($this->uri->segment(4) == "incomplete" ){    ///============ FOR ALL APPLICATION WITH COMPLETE = 1   SUBMITTED
            $search_arr.= ' AND application.complete= 0';
        }
        if($this->uri->segment(4) == "all" ){    ///============ FOR ALL APPLICATION WITH COMPLETE = 1   SUBMITTED
            $search_arr.= ' ';
        }
        if($this->uri->segment(4) == "inprogress" ){    ///============ FOR ALL APPLICATION WITH COMPLETE = 0   IN PROGRESSS
            $search_arr.= ' AND application.complete= 0 and application.status = 0';
        }
        if($this->uri->segment(4) == "accepted" ){    ///============ FOR ACCEPTED  STATUS = 1
            $search_arr.= ' AND application.status = 1 and application.complete= 1 ';
        }
        if($this->uri->segment(4) == "rejected" ){    ///============ FOR REJECTED STATUS = 2
            $search_arr.= ' AND application.status = 2 ';  
        }
         if($this->uri->segment(4) == "shortlisted" ){    ///============ FOR REJECTED STATUS = 2
             $search_arr.= ' AND application.status = 1 and application.complete= 1 ';
         }
         if($this->uri->segment(4) == "preselected" ){    ///============ FOR REJECTED STATUS = 2
             $search_arr.= ' AND application.status = 3 and application.complete= 1 ';
         }
         if($this->uri->segment(4) == "awarded" ){    ///============ FOR REJECTED STATUS = 2
             $search_arr.= ' AND application.status = 4 and application.complete= 1 ';
         }
        if($this->uri->segment(4) == ""){
            
            $search_arr.= ' AND application.complete= 0';
        }
        // Pages variable
        $result_per_page = 20;
//        $pe = $this->Csz_admin_model->getIndexData('application', $result_per_page, $pagination, 'id', 'ASC', $search_arr);
        $total_row = $this->Csz_model->countData('application', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/application/viewallapplications/'.$this->uri->segment(4);
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link, $uri_segmentno = 5);     
        ($this->uri->segment(5))? $pagination = $this->uri->segment(5) : $pagination = 0;
        //Get users from database
        
        //$this->template->setSub('application', $this->Csz_admin_model->getIndexData('application', $result_per_page, $pagination, 'id', 'ASC', $search_arr));
        // $this->template->setSub('application', $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'ASC', $search_arr)); 
        $q = "select application.*,applicant.name as applicant_name,applicant.nationality,g.title as grant_title from application inner join applicant on application.user_id = applicant.id inner join `grant` as g on application.grant_id = g.id where ".$search_arr;
        // print_r($q);

        // die();
        $query = $this->db->query("select application.*,applicant.name as applicant_name,applicant.nationality,g.title as grant_title from application inner join applicant on application.user_id = applicant.id inner join `grant` as g on application.grant_id = g.id where ".$search_arr);
                // $q = "select form_field.*,form_submission.form_field_value from form_field inner join form_submission on form_field.form_field_id = form_submission.form_field_id where form_submission.application_id = ".$application['id']." and form_submission.form_main_id = ".$project_details_form[0]['form_main_id'];
                
        if($query){
            $application = $query->result_array();
        }else{
            $application = [];
        }
       
        $this->template->setSub('application', $application); 
        
        $search_arr = "active=1";
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'ASC', $search_arr);
            $grantArray = [];
            if(!empty($grant)){
                foreach($grant as $vl){
                    $grantArray[$vl['id']] = $vl['title'];
                }
            }
            // print_r($grantArray); die;
        $this->template->setSub('grant', $grantArray);
        
        $this->template->setSub('grants', $grant);
        
        $search_arr = "status=1";
            $applicant = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            $applicantArray = [];
            $applicantPhone = [];
            $applicantCountryy = [];
            if(!empty($applicant)){
                foreach($applicant as $vl){
                    $applicantArray[$vl['id']] = $vl['name'];
                    $applicantPhone[$vl['id']] = $vl['phone'];
                    $applicantCountryy[$vl['id']] = $vl['nationality'];
                }
            }
            // print_r($grantArray); die;
        $this->template->setSub('name', $applicantArray);
        $this->template->setSub('phone', $applicantPhone);
       
        $this->template->setSub('country_aplcnt', $applicantCountryy);
        
        $country = $this->returnCountry();
        $this->template->setSub('country', $country ); 
        // print_r($country);
        // die();

        $this->template->setSub('whichpage',  $this->uri->segment(4));
        
        $this->template->setSub('total_row', $total_row);       
        //Load the view
        $this->template->loadSub('admin/application/viewallapplications');
    }
    

    public function sendcustomemail() {
        $to      = 'oidancun@gmail.com';
			$subject = 'DocA Production Grant File Uploads';
			$message = "Dear Applicant <br><br>Thank you for submitting your application for the DocA Production Grant.<br><br>
            We have noted with concern that some files may have not been properly uploaded viz. Script, Visual Materials, Proof of funding secured and Budget-Financial Plan. <br><br>
            We advise all applicants to re-upload these files on the <a href='https://grants.documentaryafrica.org/'>Grants Portal</a> before the call deadline on 18th September 2023.<br><br>
            All the best,<br><br>
            Outreach & Programs <br><br>
            DocA
            ";
            $query = $this->db->query("select email from applicant limit 50 offset 300");
                // $q = "select form_field.*,form_submission.form_field_value from form_field inner join form_submission on form_field.form_field_id = form_submission.form_field_id where form_submission.application_id = ".$application['id']." and form_submission.form_main_id = ".$project_details_form[0]['form_main_id'];
                
            if($query){
                $applicants = $query->result_array();
            }else{
                $applicants = [];
            }
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
               
                foreach($applicants as $address){
                    if (filter_var($address['email'], FILTER_VALIDATE_EMAIL)) {
                        $mail->addAddress($address['email'], 'Applicant');
                    }
                    
                }
                $mail->addAddress('oidancun@gmail.com', 'Applicant');

                // Email content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;
               
                $mail->send();
                print_r('Email sent successfully.');
                die();
            } catch (Exception $e) {
                print_r("Email could not be sent. Error: {$mail->ErrorInfo}");
                die();
            }
    }
    
    //===== VIEW ALL APPLICATION BY GRANT ID AND IT WILL BE ANY OF IT ACCORDING TO CLICKED STATUS: SUBMITTED, REJECTED, IN-PROGRESS AND ACCEPTED ==============
    //=====  FOR  SUBMITTED AND IN-PROGRESS :  status COLUMN IS USED OF APPLICATION TABLE
    //======== AND FOR ACCEPTED AND REJECTED :  complete COLUMN IS USED OF APPLICAITON TABLE.
     public function viewallapplicationsbygrant() {
         
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        if($this->uri->segment(4) == "inprogress" || $this->uri->segment(4) == "submitted" || $this->uri->segment(4) == "rejected"){
            admin_helper::is_allowchk('admin users');
        }
        //admin_helper::is_allowchk('admin users');
        $this->load->library('pagination');
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        $search_arr = "grant_id = ".$this->uri->segment(5);
        if($this->uri->segment(4) == "submitted" ){    ///============ FOR ALL APPLICATION WITH COMPLETE = 1   SUBMITTED
            $search_arr.= ' AND complete= 1 and status = 0';
        }
        if($this->uri->segment(4) == "inprogress" ){    ///============ FOR ALL APPLICATION WITH COMPLETE = 0   IN PROGRESSS
            $search_arr.= ' AND complete= 0 and status = 0';
        }
        if($this->uri->segment(4) == "accepted" ){    ///============ FOR ACCEPTED  STATUS = 1
            $search_arr.= ' AND status = 1 and complete= 1 ';
        }
        if($this->uri->segment(4) == "rejected" ){    ///============ FOR REJECTED STATUS = 2
            $search_arr.= ' AND status = 2 ';  
        }
        if($this->uri->segment(4) == ""){
            
            $search_arr.= ' AND complete= 0';
        }
        // Pages variable
        $result_per_page = 20;
        $pe = $this->Csz_admin_model->getIndexData('application', "", "", 'id', 'ASC', $search_arr);
        $total_row = $this->Csz_model->countData('application', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/application/viewallapplicationsbygrant/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link, $uri_segmentno = 6);     
        ($this->uri->segment(6))? $pagination = $this->uri->segment(6) : $pagination = 0;
        //Get users from database
        
        $this->template->setSub('application', $this->Csz_admin_model->getIndexData('application', "", "", 'id', 'ASC', $search_arr)); 
        $search_arr = "active=1";
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'ASC', $search_arr);
            $grantArray = [];
            if(!empty($grant)){
                foreach($grant as $vl){
                    $grantArray[$vl['id']] = $vl['title'];
                }
            }
            // print_r($grantArray); die;
        $this->template->setSub('grant', $grantArray);
        
        $this->template->setSub('grants', $grant);
        
        $search_arr = "status=1";
            $applicant = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            $applicantArray = [];
            $applicantPhone = [];
            $applicantCountryy = [];
            if(!empty($applicant)){
                foreach($applicant as $vl){
                    $applicantArray[$vl['id']] = $vl['name'];
                     $applicantPhone[$vl['id']] = $vl['phone'];
                     $applicantCountryy[$vl['id']] = $vl['nationality'];
                }
            }
            // print_r($grantArray); die;
        $this->template->setSub('name', $applicantArray);
        $this->template->setSub('phone', $applicantPhone);
       
        $this->template->setSub('country_aplcnt', $applicantCountryy);
        $country = $this->returnCountry();
        $this->template->setSub('country', $country );
        
        $this->template->setSub('whichpage',  $this->uri->segment(4));
        
        $this->template->setSub('total_row', $total_row);       
        //Load the view
        $this->template->loadSub('admin/application/viewallapplicationsbygrant');
    }
    

    public function addapplication() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        //Load the form helper
        $this->load->helper('form');
        //Load the view
        $this->template->loadSub('admin/application/add');
    }

    public function confirm() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        admin_helper::is_allowchk('save');
        //Load the form validation library
        $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        // $this->form_validation->set_rules('password', $this->lang->line('user_new_pass'), 'trim|required|min_length[4]|max_length[32]');
        // $this->form_validation->set_rules('con_password', $this->lang->line('user_new_confirm'), 'trim|required|matches[password]');
        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        // $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->addapplication();
        } else {
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->createapplication($id='');
            //Return to user list
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
                redirect($this->csz_referrer->getIndex(), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('login_incorrect').'</div>');
                $this->editUser();
            }
            redirect($this->csz_referrer->getIndex(), 'refresh');
        }
    }

    public function editapplication() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        if($this->Csz_auth_model->is_group_allowed('admin users', 'backend') === FALSE){
            redirect('/admin/application', 'refresh');
        }
        //Load the form helper
        $this->load->helper('form');
        if($this->uri->segment(4)){
            $this->db->cache_on();
            $this->db->cache_delete_all();
            //Get user details from database
            $where = 'id='.$this->uri->segment(4);
            $application = $this->Csz_model->getValue('*', 'application', $where, '', 1);
            if($application !== FALSE){
                $this->template->setSub('application', $application);
                //Load the view
                $this->template->loadSub('admin/application/edit');
            }else{
                redirect($this->csz_referrer->getIndex(), 'refresh');
            }
        }else{
            redirect($this->csz_referrer->getIndex(), 'refresh');
        }
    }

    public function edited() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('save');
        if($this->Csz_auth_model->is_group_allowed('admin users', 'backend') === FALSE){
            redirect('/admin/application', 'refresh');
        }       
        //Load the form validation library
        $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        $this->form_validation->set_message('required', $this->lang->line('required'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->editapplication();
        } else {
            //Validation passed
            //Update the user
            $rs = $this->Csz_admin_model->createapplication($this->uri->segment(4));
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
                redirect($this->csz_referrer->getIndex(), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('login_incorrect').'</div>');
                $this->editUser();
            }
            
        }
    }
    
    public function viewoneapplication() {
        
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        //if($this->Csz_auth_model->is_group_allowed('admin users', 'backend') === FALSE){
            //redirect('/admin/application', 'refresh');
       // }
        //Load the form helper
        $this->load->helper('form');
        //$whichpage = $this->uri->segment(4);
        $next_id = 0;
        $previous_id = 0;
        $for_all = 0;
        if($this->uri->segment(5)){
            $for_all = 1;
        }
        if($this->uri->segment(4)){
            $this->db->cache_on();
            $this->db->cache_delete_all();
            //Get user details from database
            $where = $this->uri->segment(4) ;
            
            $is_admin = 0;
            $is_1st_grant = 0;
            $is_editor = 0;
            // ======================GETTING THE ADMIN/EDITOR TYPE ================================
            $check_user_type = $this->Csz_auth_model->get_groups_fromuser($this->session->userdata('user_admin_id'));
            if($check_user_type){

                //======== IS LOGGED USER IS :  ADMIN
                if($check_user_type->user_groups_id == 1){
                     $is_admin  = 1;
                //========= IS LOGGED USER IS:  EDITOR
                }else if($check_user_type->user_groups_id == 2){
                     $is_editor = 1;
                }else{}
            }            
            // ====================================================================================
            
            $application = $this->Csz_model->getApplicationAllData($where);
            if($application){

                
                if($application["grant_id"] == 23 || $application['title'] == "Project Support Doc Organisations"){
                   $is_1st_grant = $application["grant_id"];
                }
                $search_arr = "active=1 AND id=".$application["grant_id"];
                $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
                // Project Details Dynamic forms things
                $project_details_form = $this->Csz_admin_model->getIndexData('form_main', '','', 'form_main_id', 'DESC', "form_main_id=".$grant[0]['project_summary_form_id']);
                // print_r($project_details_form[0]['form_main_id']);
                // die();
                // $project_details_form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', 
                //     " form_main_id = ".$project_details_form[0]['form_main_id']." and form_submission.application_id = ".$application[0]['id'], '', 'form_submission', ' form_field.form_field_id = form_submission.form_field_id ', ' inner ',' form_field.*,form_submission.form_field_value ');
                $query = $this->db->query("select form_field.*,form_submission.form_field_value from form_field inner join form_submission on form_field.form_field_id = form_submission.form_field_id where form_submission.application_id = ".$application['id']." and form_submission.form_main_id = ".$project_details_form[0]['form_main_id']);
                // $q = "select form_field.*,form_submission.form_field_value from form_field inner join form_submission on form_field.form_field_id = form_submission.form_field_id where form_submission.application_id = ".$application['id']." and form_submission.form_main_id = ".$project_details_form[0]['form_main_id'];
                
                if($query){
                    $project_details_form_fields = $query->result_array();
                }else{
                    $project_details_form_fields = [];
                }
                

                // Project Description Dynamic forms things
                $project_description_form = $this->Csz_admin_model->getIndexData('form_main', '','', 'form_main_id', 'DESC', "form_main_id=".$grant[0]['project_description_form_id']);
                // $project_description_form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', " form_field.form_main_id=".$project_description_form[0]['form_main_id']." and form_submission.application_id = ".$application[0]['id'], '', 'form_submission', 'form_field.form_field_id = form_submission.form_field_id', 'inner','form_field.*,form_submission.form_field_value');

                $query = $this->db->query("select form_field.*,form_submission.form_field_value from form_field inner join form_submission on form_field.form_field_id = form_submission.form_field_id where form_submission.application_id = ".$application['id']." and form_field.form_main_id = ".$project_description_form[0]['form_main_id']);
                if($query){
                    $project_description_form_fields = $query->result_array();
                }else{
                    $project_description_form_fields = [];
                }

                // Lets get count of all applications that are submitted
                $counter_search_arr = "1=1 ";
                $counter_search_arr.= ' AND application.complete= 1 AND application.grant_id = '.$grant[0]['id'];
                $total_applications_to_review = $this->Csz_model->countData('application', $counter_search_arr);
                // Lets get count of all applications this user has reviewed for the grant
                $reviewed_search_arr = "1=1 ";
                $reviewed_search_arr.= ' AND admin_reviews.admin_id = '. $this->session->userdata('user_admin_id') .' AND admin_reviews.application_id IN (select id from application where application.grant_id = '.$grant[0]['id'].') ';
                $total_applications_reviewed = $this->Csz_model->countData('admin_reviews', $reviewed_search_arr);
                // print_r($this->session->userdata('user_admin_id') );
                // die();

                $whereee = "application_id = ".$application["id"];
                $team_data = $this->Csz_admin_model->getIndexData('team_store', '', '', 'id', 'ASC', $whereee);
                $budget_data = $this->Csz_admin_model->getIndexData('budget', '', '', 'id', 'ASC', $whereee);
                
                $review_where = array("application_id"=>$application["id"], "admin_id"=>$this->session->userdata('user_admin_id'));
                $review_data = $this->Csz_admin_model->getIndexData('admin_reviews', '', '', 'id', 'ASC', $review_where);
                $crew_member = $this->Csz_admin_model->getIndexData('members', '', '', 'id', 'ASC', $whereee);
                
                $org_data = $this->Csz_admin_model->get_one_row_data('organization', $whereee);
                
                
                $project_link = $this->Csz_admin_model->getIndexData('project_link', '', '', 'id', 'ASC', $whereee);
                
                //============ FOR NEXT_ID AND PREVEVIOUS_ID ONLY FOR THE COMPLETE APPLICATION ====================================
                if($application["complete"] == 1){
                  $getnext = $this->Csz_admin_model->getNextPrevious($for_all, $application["id"], $application["status"] , $application["grant_id"], $application["complete"], 1 ); // FOR NEXT 
                  if($getnext){
                    $next_id = $getnext['id'];
                  }
                  $getprevious = $this->Csz_admin_model->getNextPrevious($for_all, $application["id"], $application["status"], $application["grant_id"], $application["complete"], 0 ); // FOR PREVIOUS 
                  if($getprevious){
                    $previous_id = $getprevious['id'];
                  }
                }
                // ===========FOR NEXT_ID AND PREVEVIOUS_ID END HERE ================================================
                
                //========= get contracts with respec to the application grant_id has =================
                $wh = "contract_type = ".$application["contract"];
                $contracts = $this->Csz_admin_model->getIndexData('contract', '', '', 'id','ASC', $wh);
            }
            
            if(!empty($contracts)){
                foreach($contracts as $kk =>$vl){
                    
                    $search_arr = "application_id = ".$application["id"]. " AND contract_id = ".$vl['id'];
                    $contract_save = $this->Csz_admin_model->getIndexData('contract_save', '', '','', '', $search_arr);
                    
                    if($contract_save){
                        
                        $contracts[$kk]["upload_file"] = $contract_save[0]['upload_file'];
                        if($contract_save[0]['answer']){
                            
                           $contracts[$kk]["answeris"] = "Yes"; 
                        }else{
                           $contracts[$kk]["answeris"] = "No";
                        }
                    }else{
                        $contracts[$kk]["answeris"] = "Not Given";
                        $contracts[$kk]["upload_file"] = "";
                    }
                }
            }
            
            $country = $this->returnCountry();
            if($total_applications_reviewed){
                $total_applications_reviewed +=1;
            }else{
                $total_applications_reviewed = 1;
            }
            $this->template->setSub('total_applications_to_review', $total_applications_to_review );
            $this->template->setSub('total_applications_reviewed', $total_applications_reviewed );
            $this->template->setSub('application', $application );
            
            $this->template->setSub('country', $country ); 
            $this->template->setSub('team_data', $team_data);
            $this->template->setSub('budget_data', $budget_data);
            $this->template->setSub('review_data',  $review_data);
            $this->template->setSub('crew_member',  $crew_member);
            $this->template->setSub('project_link',  $project_link);
            
            $this->template->setSub('is_admin',  $is_admin);
            $this->template->setSub('is_editor',  $is_editor);
            $this->template->setSub('is_1st_grant',  $is_1st_grant);
            
             $this->template->setSub('org_data',  $org_data);
            
             $this->template->setSub('next_id',  $next_id);
             $this->template->setSub('previous_id',  $previous_id);
           
            $this->template->setSub('contracts', $contracts);
            //Add Dynamic forms fields
            $this->template->setSub('project_details_form', $project_details_form);
            $this->template->setSub('project_details_form_fields', $project_details_form_fields);
            $this->template->setSub('project_description_form', $project_description_form);
            $this->template->setSub('project_description_form_fields', $project_description_form_fields);
            //Load the view
            $this->template->loadSub('admin/application/viewoneapplication');
        }else{
            redirect($this->csz_referrer->getIndex(), 'refresh');
        }
    }
    
    public function status(){
        
        $data = array('status' =>$this->input->get('status'));
        $get_one_row_review =  $this->Csz_admin_model->get_one_row_data("admin_reviews", array("id"=>$this->uri->segment('4'))); // GET admin_reviews table one row
        
        //$this->db->where('id',$this->uri->segment('4'));
        $this->db->where('id',$get_one_row_review['application_id']);
        if($this->db->update('application',$data)){
            $search_arr = "id=".$this->uri->segment('4');
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'ASC', $search_arr);
            
            $search_arr = "id=".$application[0]['user_id'];
            $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'ASC', $search_arr);
         
            $search_arr = "active=1 AND id=".$application[0]['grant_id'];
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'ASC', $search_arr);
            
            if($this->input->get('status') == 1){
            $to      = $data[0]['email'];
			$subject = ' DocA | Your Application has Been Shortlisted!';
			$message = 'Congratulations '.$data[0]['name']."\r\n" ;
			$message.= "<br><br>DocA - Documentary Africa is pleased to inform you that your application for ".$grant[0]['title']." has been shortlisted to proceed to the next round of reviews. <br><br>Kindly follow the link below to input the requested documents before <strong>19th June 2021, 1800h (EAT), </strong>and
update DocA on your project status if necessary. <br><br>
    
  <a href='https://grants.documentaryafrica.org/login'>
    <button>Login to your Dashboard</button>
    </a>
    
   <br><br> Regards,
<br><br>DocA Team";

			
            } else if($this->input->get('status') == 2){
            $to      = $data[0]['email'];
			$subject = 'DocA | Unsuccessful Application';
			$message = 'Hello '.$data[0]['name']."\r\n" ;
			$message.= "<br>We are sorry to inform you that your application for the DocA ".$grant[0]['title']." was unsuccessful. We appreciate you taking the time to apply for our support, and we wish you all the best in your fundraising efforts. <br><br>Regards<br><br> DocA Team";
            }

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
                $mail->addAddress($to, 'User');

                // Email content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo 'Email sent successfully.';
            } catch (Exception $e) {
                echo "Email could not be sent. Error: {$mail->ErrorInfo}";
            }
            $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
            if($this->input->get('from_view') == 1){
                //redirect('/admin/application/viewoneapplication/'.$this->uri->segment('4'), 'refresh');
                redirect('/admin/getreviewcomments/'.$this->uri->segment('4'), 'refresh');
            }else{
                redirect($this->csz_referrer->getIndex(), 'refresh');
            }
        }
    }
    
    public function viewUsers() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        if($this->uri->segment(4)){
            $this->db->cache_on();
            //Get users from database   
            $users = $this->Csz_admin_model->getUser($this->uri->segment(4), 'admin');
            if($users !== FALSE){
                $this->template->setSub('users', $users);
                //Load the view
                $this->template->loadSub('admin/users_view');
            }else{
                redirect($this->csz_referrer->getIndex(), 'refresh');
            }
        }else{
            redirect($this->csz_referrer->getIndex(), 'refresh');
        }
    }
    
    
    public function returnCountry(){
        $country = [];
        $country = array(
			            "" => "Select Country",
						"AF" => "Afghanistan",
						"AL" => "Albania",
						"DZ" => "Algeria",
						"AS" => "American Samoa",
						"AD" => "Andorra",
						"AO" => "Angola",
						"AI" => "Anguilla",
						"AQ" => "Antarctica",
						"AG" => "Antigua and Barbuda",
						"AR" => "Argentina",
						"AM" => "Armenia",
						"AW" => "Aruba",
						"AU" => "Australia",
						"AT" => "Austria",
						"AZ" => "Azerbaijan",
						"BS" => "Bahamas",
						"BH" => "Bahrain",
						"BD" => "Bangladesh",
						"BB" => "Barbados",
						"BY" => "Belarus",
						"BE" => "Belgium",
						"BZ" => "Belize",
						"BJ" => "Benin",
						"BM" => "Bermuda",
						"BT" => "Bhutan",
						"BO" => "Bolivia",
						"BA" => "Bosnia and Herzegowina",
						"BW" => "Botswana",
						"BV" => "Bouvet Island",
						"BR" => "Brazil",
						"IO" => "British Indian Ocean Territory",
						"BN" => "Brunei Darussalam",
						"BG" => "Bulgaria",
						"BF" => "Burkina Faso",
						"BI" => "Burundi",
						"KH" => "Cambodia",
						"CM" => "Cameroon",
						"CA" => "Canada",
						"CV" => "Cape Verde",
						"KY" => "Cayman Islands",
						"CF" => "Central African Republic",
						"TD" => "Chad",
						"CL" => "Chile",
						"CN" => "China",
						"CX" => "Christmas Island",
						"CC" => "Cocos (Keeling) Islands",
						"CO" => "Colombia",
						"KM" => "Comoros",
						"CG" => "Congo",
						"CK" => "Cook Islands",
						"CR" => "Costa Rica",
						"CI" => "Cote D'Ivoire",
						"HR" => "Croatia",
						"CU" => "Cuba",
						"CY" => "Cyprus",
						"CZ" => "Czech Republic",
						"DK" => "Denmark",
						"DJ" => "Djibouti",
						"DM" => "Dominica",
						"DO" => "Dominican Republic",
						"TL" => "East Timor",
						"EC" => "Ecuador",
						"EG" => "Egypt",
						"SV" => "El Salvador",
						"GQ" => "Equatorial Guinea",
						"ER" => "Eritrea",
						"EE" => "Estonia",
						"ET" => "Ethiopia",
						"FK" => "Falkland Islands (Malvinas)",
						"FO" => "Faroe Islands",
						"FJ" => "Fiji",
						"FI" => "Finland",
						"FR" => "France",
						"FX" => "France, Metropolitan",
						"GF" => "French Guiana",
						"PF" => "French Polynesia",
						"TF" => "French Southern Territories",
						"GA" => "Gabon",
						"GM" => "Gambia",
						"GE" => "Georgia",
						"DE" => "Germany",
						"GH" => "Ghana",
						"GI" => "Gibraltar",
						"GR" => "Greece",
						"GL" => "Greenland",
						"GD" => "Grenada",
						"GP" => "Guadeloupe",
						"GU" => "Guam",
						"GT" => "Guatemala",
						"GN" => "Guinea",
						"GW" => "Guinea-bissau",
						"GY" => "Guyana",
						"HT" => "Haiti",
						"HM" => "Heard and Mc Donald Islands",
						"HN" => "Honduras",
						"HK" => "Hong Kong",
						"HU" => "Hungary",
						"IS" => "Iceland",
						"IN" => "India",
						"ID" => "Indonesia",
						"IR" => "Iran (Islamic Republic of)",
						"IQ" => "Iraq",
						"IE" => "Ireland",
						"IL" => "Israel",
						"IT" => "Italy",
						"JM" => "Jamaica",
						"JP" => "Japan",
						"JO" => "Jordan",
						"KZ" => "Kazakhstan",
						"KE" => "Kenya",
						"KI" => "Kiribati",
						"KP" => "Korea, Democratic People's Republic of",
						"KR" => "Korea, Republic of",
						"KW" => "Kuwait",
						"KG" => "Kyrgyzstan",
						"LA" => "Lao People's Democratic Republic",
						"LV" => "Latvia",
						"LB" => "Lebanon",
						"LS" => "Lesotho",
						"LR" => "Liberia",
						"LY" => "Libyan Arab Jamahiriya",
						"LI" => "Liechtenstein",
						"LT" => "Lithuania",
						"LU" => "Luxembourg",
						"MO" => "Macau",
						"MK" => "Macedonia, The Former Yugoslav Republic of",
						"MG" => "Madagascar",
						"MW" => "Malawi",
						"MY" => "Malaysia",
						"MV" => "Maldives",
						"ML" => "Mali",
						"MT" => "Malta",
						"MH" => "Marshall Islands",
						"MQ" => "Martinique",
						"MR" => "Mauritania",
						"MU" => "Mauritius",
						"YT" => "Mayotte",
						"MX" => "Mexico",
						"FM" => "Micronesia, Federated States of",
						"MD" => "Moldova, Republic of",
						"MC" => "Monaco",
						"MN" => "Mongolia",
						"MS" => "Montserrat",
						"MA" => "Morocco",
						"MZ" => "Mozambique",
						"MM" => "Myanmar",
						"NA" => "Namibia",
						"NR" => "Nauru",
						"NP" => "Nepal",
						"NL" => "Netherlands",
						"AN" => "Netherlands Antilles",
						"NC" => "New Caledonia",
						"NZ" => "New Zealand",
						"NI" => "Nicaragua",
						"NE" => "Niger",
						"NG" => "Nigeria",
						"NU" => "Niue",
						"NF" => "Norfolk Island",
						"MP" => "Northern Mariana Islands",
						"NO" => "Norway",
						"OM" => "Oman",
						"PK" => "Pakistan",
						"PW" => "Palau",
						"PA" => "Panama",
						"PG" => "Papua New Guinea",
						"PY" => "Paraguay",
						"PE" => "Peru",
						"PH" => "Philippines",
						"PN" => "Pitcairn",
						"PL" => "Poland",
						"PT" => "Portugal",
						"PR" => "Puerto Rico",
						"QA" => "Qatar",
						"RE" => "Reunion",
						"RO" => "Romania",
						"RU" => "Russian Federation",
						"RW" => "Rwanda",
						"KN" => "Saint Kitts and Nevis",
						"LC" => "Saint Lucia",
						"VC" => "Saint Vincent and the Grenadines",
						"WS" => "Samoa",
						"SM" => "San Marino",
						"ST" => "Sao Tome and Principe",
						"SA" => "Saudi Arabia",
						"SN" => "Senegal",
						"SC" => "Seychelles",
						"SL" => "Sierra Leone",
						"SG" => "Singapore",
						"SK" => "Slovakia (Slovak Republic)",
						"SI" => "Slovenia",
						"SB" => "Solomon Islands",
						"SO" => "Somalia",
						"ZA" => "South Africa",
						"GS" => "South Georgia and the South Sandwich Islands",
						"ES" => "Spain",
						"LK" => "Sri Lanka",
						"SH" => "St. Helena",
						"PM" => "St. Pierre and Miquelon",
						"SD" => "Sudan",
						"SR" => "Suriname",
						"SJ" => "Svalbard and Jan Mayen Islands",
						"SZ" => "Swaziland",
						"SE" => "Sweden",
						"CH" => "Switzerland",
						"SY" => "Syrian Arab Republic",
						"TW" => "Taiwan",
						"TJ" => "Tajikistan",
						"TZ" => "Tanzania, United Republic of",
						"TH" => "Thailand",
						"TG" => "Togo",
						"TK" => "Tokelau",
						"TO" => "Tonga",
						"TT" => "Trinidad and Tobago",
						"TN" => "Tunisia",
						"TR" => "Turkey",
						"TM" => "Turkmenistan",
						"TC" => "Turks and Caicos Islands",
						"TV" => "Tuvalu",
						"UG" => "Uganda",
						"UA" => "Ukraine",
						"AE" => "United Arab Emirates",
						"GB" => "United Kingdom",
						"US" => "United States",
						"UM" => "United States Minor Outlying Islands",
						"UY" => "Uruguay",
						"UZ" => "Uzbekistan",
						"VU" => "Vanuatu",
						"VA" => "Vatican City State (Holy See)",
						"VE" => "Venezuela",
						"VN" => "Viet Nam",
						"VG" => "Virgin Islands (British)",
						"VI" => "Virgin Islands (U.S.)",
						"WF" => "Wallis and Futuna Islands",
						"EH" => "Western Sahara",
						"YE" => "Yemen",
						"RS" => "Serbia",
						"CD" => "The Democratic Republic of Congo",
						"ZM" => "Zambia",
						"ZW" => "Zimbabwe",
						"JE" => "Jersey",
						"BL" => "St. Barthelemy",
						"XU" => "St. Eustatius",
						"XC" => "Canary Islands",
						"ME" => "Montenegro"
					);
					
        return $country;
    }

    public function delete() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        admin_helper::is_allowchk('delete');
        if($this->uri->segment(4)){
                //Delete the user account
                $this->Csz_admin_model->deleteData('application',$this->uri->segment(4),'id');
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
           
        }
        //Return to user list
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }

    /*     * ************ Forgotten Password Resets ************* */


}
