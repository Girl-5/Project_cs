<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CSZ CMS
 *
 * An open source content management system
 *
 * Copyright (c) 2016 - 2017, Astian Foundation.
 *
 * Astian Develop Public License (ADPL)
 * 
 * This Source Code Form is subject to the terms of the Astian Develop Public
 * License, v. 1.0. If a copy of the APL was not distributed with this
 * file, You can obtain one at http://astian.org/about-ADPL
 * 
 * @author	CSKAZA
 * @copyright   Copyright (c) 2016 - 2017, Astian Foundation.
 * @license	http://astian.org/about-ADPL	ADPL License
 * @link	https://www.cszcms.com
 * @since	Version 1.0.0
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require FCPATH.'system/libraries/PHPMailer/src/Exception.php';
require FCPATH.'system/libraries/PHPMailer/src/PHPMailer.php';
require FCPATH.'system/libraries/PHPMailer/src/SMTP.php';
class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     * $this->template->set_template('template_name'); to use another one, 
     * before $this->template->load('index_page', array('view' => 'data'));
     * ---
     * OR
     * $this->template->load('index_page', array('view' => 'data'), 'template_name'); If template file name is 'main'
     */
    var $page_rs;
    var $page_url;
    
    function __construct() {
        parent::__construct();
        $this->CI = & get_instance();
        $this->load->database();
        $row = $this->Csz_model->load_config();
        if ($row->themes_config) {
            $this->template->set_template($row->themes_config);
        }
        if(!$this->session->userdata('fronlang_iso')){ 
            $this->Csz_model->setSiteLang();
        }
        if($this->Csz_model->chkLangAlive($this->session->userdata('fronlang_iso')) == 0){ 
            $this->session->unset_userdata('fronlang_iso');
            $this->Csz_model->setSiteLang(); 
        }
        $this->_init();
    }

    public function _init() {
        $row = $this->Csz_model->load_config();
        $pageURL = $this->Csz_model->getCurPages();
        if(strpos($pageURL, 'plugin') !== FALSE){
            redirect($this->Csz_model->base_link().'/'.$pageURL);
        }
        $this->page_url = $pageURL;
        $this->page_rs = $this->Csz_model->load_page($pageURL);
        $page_rs = $this->page_rs;
        $this->template->set('additional_js', $row->additional_js);
        $this->template->set('additional_metatag', $row->additional_metatag);
        if ($row->maintenance_active) {
            $this->template->set('core_css', $this->Csz_model->coreCss());
            $this->template->set('core_js', $this->Csz_model->coreJs());
            $title = $this->Csz_model->pagesTitle($this->Csz_model->getLabelLang('site_maintenance_title'));
            $this->template->set('title', $title);
            $this->template->set('meta_tags', $this->Csz_model->coreMetatags($this->Csz_model->getLabelLang('site_maintenance_subtitle'), $row->keywords, $title));
            $this->template->set('cur_page', $pageURL);  
        } else {
            if ($page_rs !== FALSE) {
                Member_helper::is_allow_groups($page_rs->user_groups_idS);
                $this->template->set('core_css', $this->Csz_model->coreCss($page_rs->custom_css, FALSE));
                $this->template->set('core_js', $this->Csz_model->coreJs($page_rs->custom_js, FALSE));
                $title = $this->Csz_model->pagesTitle($page_rs->page_title);
                $this->template->set('title', $title);
                $this->template->set('meta_tags', $this->Csz_model->coreMetatags($page_rs->page_desc, $page_rs->page_keywords, $title, '', $page_rs->more_metatag));
                $this->template->set('cur_page', $page_rs->page_url);
            } else {
                $this->template->set('core_css', $this->Csz_model->coreCss());
                $this->template->set('core_js', $this->Csz_model->coreJs());
                $title = $this->Csz_model->pagesTitle($this->Csz_model->getLabelLang('site_error_404_title'));
                $this->template->set('title', $title);
                $this->template->set('meta_tags', $this->Csz_model->coreMetatags($this->Csz_model->getLabelLang('site_error_404_title'),$row->keywords,$title));           
                $this->template->set('cur_page', $pageURL);     
            }
        }
    }

    public function index() {
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $search_arr = "active=1";
            $result['grant'] = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $this->templateFront('home',$result);
//            echo "Am home";

        }
    }
    
    public function register(){
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $this->templateFront('register',$result); 
        }
    }
    
    public function eligibility_test(){
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
           $this->templateFront('eligibility_test',$result); 
        }
    }
    
    public function login(){
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
           $this->templateFront('login',$result); 
        }
    }
    
    public function forgetPassword(){
        if(!empty($this->session->userdata('user_id'))){
            redirect(base_url());
        } 
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
           $this->templateFront('forgetPassword',$result); 
        }
    }

    public function help(){

        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $result = [];
            $this->templateFront('help',$result);
        }
    }
    
    public function resetPassword(){
          $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        
        $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->forgetPassword();
        } else {
            //Validation passed
            
            $search_arr = "status=1 AND email='".$this->input->post('email')."'";
             $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            //Return to user list
            if(!empty($data)){
                $password = mt_rand();
                $data = array('password' =>md5($password));
                $this->db->where('email',$this->input->post('email'));
                $this->db->update('applicant',$data);
                //Return to user list
//                	$to      = $this->input->post('email');
        			$subject = 'Doca | Password Reset';
        			$message = "Hello \r\n" ;
        			$message.="<br>Your updated password is ".$password;
//        	    	 $config = Array(
//            'protocol' => 'smtp',
//            'smtp_host' => 'ssl://documentaryafrica.org',
//            'smtp_port' => 465,
//            'smtp_timeout' => '60',
//            'smtp_user' => 'no-reply@documentaryafrica.org',
//            'smtp_pass' => 'AAdmin@987',
//            'mailtype'  => 'html',
//            'charset'   => 'utf-8'
//        );
//            $this->load->library('email');
//            $this->email->initialize($config);
//             $this->email->set_newline("\r\n");
//             $this->email->set_crlf("\r\n");
//             $this->email->from('no-reply@documentaryafrica.org'); // change it to yours
//             $this->email->to($to); // change it to yours
//             $this->email->subject($subject);
//             $this->email->message($message);
//             try{
//                 $this->email->send(FALSE);
//             }catch (Exception $e){
//                 print_r($e->getMessage());
//                 die();
//             }

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
                    $mail->addAddress($this->input->post('email'), 'User');

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $message;

                    $mail->send();
                    echo 'Email sent successfully.';
                } catch (Exception $e) {
                    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
                }
                
                
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Please check your email for updated password.</div>');
                redirect('forgetPassword', 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" style="background: red;" role="alert">Email not found</div>');
                $this->forgetPassword();
            }
            // redirect('login', 'refresh');
        }
    }
    
    public function loginCheck(){
        $this->load->library('form_validation');
       
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->loginCheck($id='');
            //Return to user list
            if($rs['status'] !== 0){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span> You have successfully logged in to your Account.</div>');
                $search_arr = "status=1 AND complete=1 And id=".$this->session->userdata('user_id');
                $applicant = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
                // echo "<pre>";
                // print_r($application); die;
                if(empty($applicant)){
                    $this->session->set_flashdata('error_message','<div style="background-color:red;" class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Please complete your profile</div>');
                    redirect('profile', 'refresh');
                }else{
                    redirect(base_url('dashboard'), 'refresh');
                }

            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$rs["msg"].'</div>');
                $this->login();
            }
            // redirect('login', 'refresh');
         
    }
    
    public function contact_information(){
      if(empty($this->session->userdata('user_id'))){
            redirect(base_url());
        } 
        $this->load->helper('form');
         $result = [];
         $search_arr = "status=1 AND id=".$this->session->userdata('user_id');
         $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
         $result['user'] = $data[0];
         $this->templateFront('contact_information',$result); 
    }
    
        public function saveContact(){
         $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('name', 'Applicant Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Applicant Phone', 'trim|required|numeric');
        $this->form_validation->set_rules('whatsapp_number', 'Applicant whatsapp Number', 'trim|numeric');
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        // $this->form_validation->set_rules('password', $this->lang->line('user_new_pass'), 'trim|required|min_length[4]|max_length[32]');
        if(!empty($this->input->post('password'))){
            $this->form_validation->set_rules('password', $this->lang->line('user_new_pass'), 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('con_password', $this->lang->line('user_new_confirm'), 'trim|matches[password]');
        }
        $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->contact_information();
        } else {
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $data = [];
            if($this->input->post('password')){
                $data['password'] = md5($this->input->post('password'));
            }
            $data['name'] = $this->input->post('name');
            $data['phone'] = $this->input->post('phone');
            $data['complete'] = 1;
            $data['whatsapp_number'] = $this->input->post('whatsapp_number');
            $rs =$this->Csz_admin_model->updateApplicant($data);
            //Return to user list
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Profile completed successfully</div>');
                redirect('dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->contact_information();
            }
            // redirect('login', 'refresh');
        }
    }
   
    public function profile(){
      if(empty($this->session->userdata('user_id'))){
            redirect(base_url());
        } 
        $this->load->helper('form');
         $result = [];
         $search_arr = "status=1 AND id=".$this->session->userdata('user_id');
         $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
         $result['user'] = $data[0];
         $this->templateFront('profile',$result); 
    }
    
        public function saveProfile(){
         $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('name', 'Applicant Name', 'trim|required');
        $this->form_validation->set_rules('birthCalendar', 'Applicant Birthday', 'trim|required');
        $this->form_validation->set_rules('country_of_birth', 'Applicant country_of_birth', 'trim|required');
        $this->form_validation->set_rules('nationality', 'Applicant nationality', 'trim|required');
        $this->form_validation->set_rules('po_box', 'Applicant po_box', 'trim|required');
        $this->form_validation->set_rules('city', 'Applicant city', 'trim|required');
        $this->form_validation->set_rules('country', 'Applicant country', 'trim|required');
       
        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        // $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->profile();
        } else {
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $data = [];
            $upload = $this->input->post('uploadId');
            if(!empty($_FILES['file_upload']['name'])){
                $upload = $this->Csz_admin_model->uploadDoc();
            } 
            
            $disability_upload = $this->input->post('disability_data');
            if(!empty($_FILES['disability_upload']['name'])){
                $disability_upload = $this->Csz_admin_model->disability_upload();
            } 
            
            // print_r($upload);
            // die;
            $data['uploadId'] = $upload;
            $data['disability_upload'] = $disability_upload;
            $data['name'] = $this->input->post('name');
            $data['gender'] = $this->input->post('gender');
            $data['disability'] = $this->input->post('disability');
            $data['dob'] = $this->input->post('birthCalendar');
            $data['country_of_birth'] = $this->input->post('country_of_birth');
            $data['nationality'] = $this->input->post('nationality');
            $data['po_box'] = $this->input->post('po_box');
            $data['city'] = $this->input->post('city');
            $data['country'] = $this->input->post('country');
            // print_r($data); die;
            $rs =$this->Csz_admin_model->updateApplicant($data);
            //Return to user list
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Profile successfully saved</div>');
                redirect('profile_info', 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->profile();
            }
            // redirect('login', 'refresh');
        }
    } 
    
    
    public function profile_info(){
      if(empty($this->session->userdata('user_id'))){
            redirect(base_url());
        } 
        $this->load->helper('form');
         $result = [];
         $search_arr = "status=1 AND id=".$this->session->userdata('user_id');
         $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
         $result['user'] = $data[0];
         $this->templateFront('profile_info',$result); 
    }
    
	    public function userView(){
			if(empty($this->session->userdata('admin_email'))){
				redirect(base_url());
			}
			$this->load->helper('form');
			$search_arr = "status=1 AND id=".$this->uri->segment(2);
         $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
         $result['user'] = $data[0];
         $this->templateFront('userView',$result); 
		}	
	
	public function viewApplication(){
        if(empty($this->session->userdata('admin_email'))){
            redirect(base_url());
        }
         $this->load->helper('form');
        $search_arr = "id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            
            $search_arr = "application_id=".$application[0]['id'];
            $budget = $this->Csz_admin_model->getIndexData('budget', '', '', 'id', 'DESC', $search_arr);
            $result['budget'] = $budget;
            
            $search_arr = "active=1 AND id=".$application[0]['grant_id'];
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            
            $search_arr = "contract_type=".$grant[0]['contract'];
            $contract = $this->Csz_admin_model->getIndexData('contract', '', '', 'id', 'ASC', $search_arr);
            $result['contract'] = $contract;
            
            
            $search_arr = "id=".$application[0]['user_id'];
            $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            $result['user'] = $data[0];
            
            $search_arr = "application_id=".$application[0]['id'];
            $contract_save = $this->Csz_admin_model->getIndexData('contract_save', '', '', 'id', 'ASC', $search_arr);
            $contractArry = [];
            if(!empty($contract_save)){
                foreach($contract_save as $vl){
                   $contractArry[$vl['contract_id']] = $vl['answer'];
                }
            }
            
            $result['contract_save'] = $contractArry;
            // print_r($contract_save); die;
            $search_arr = "application_id=".$application[0]['id'];
            $members = $this->Csz_admin_model->getIndexData('members', '', '', 'id', 'DESC', $search_arr);
            $result['members'] = $members;
            
			 $search_arr = "application_id=".$application[0]['id'];
            $team_store = $this->Csz_admin_model->getIndexData('team_store', '', '', 'id', 'DESC', $search_arr);
            if (!empty($team_store)) {
                foreach ($team_store as $key => $value) {
                    $result[$value['project_role']] = $value;
                }
            }
            $result['team_store'] = $team_store;
		
            $this->templateFront('applicationView',$result); 
    }
    
     public function saveProfile_info(){
         $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('occupation', 'Applicant occupation', 'trim|required');
        $this->form_validation->set_rules('office_number', 'Applicant office number', 'trim|numeric');
        //$this->form_validation->set_rules('office_email', 'Applicant office email', 'trim|required');
        //$this->form_validation->set_rules('website', 'Applicant nationality', 'trim|required');
       
        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        // $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->profile_info();
        } else { 
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $data = [];
            $upload = $this->input->post('uploadCv');
            // print_r($upload);
            // echo "<br>";
            if(!empty($_FILES['file_upload']['name'])){
                $upload = $this->Csz_admin_model->uploadDoc();
            }  
            // print_r($upload);
            // die;
            $data['uploadCv'] = $upload;
            $data['organisation'] = $this->input->post('organisation');
            $data['occupation'] = $this->input->post('occupation');
            $data['office_number'] = $this->input->post('office_number');
            $data['office_email'] = $this->input->post('office_email');
            $data['website'] = $this->input->post('website');
            $data['work_link'] = $this->input->post('work_link');
            $data['password_link'] = $this->input->post('password_link');
            // $data['country'] = $this->input->post('country');
            // print_r($data); die;
            $rs =$this->Csz_admin_model->updateApplicant($data);
            //Return to user list
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Professional information successfully saved</div>');
                redirect('contact_information', 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->profile_info();
            }
            // redirect('login', 'refresh');
        }
    } 
    
    
    public function logout(){
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url());
        }
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
    
    public function saveRegister(){
         $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('email', 'Applicant Email', 'required|is_unique[applicant.email]');
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        // $this->form_validation->set_rules('password', $this->lang->line('user_new_pass'), 'trim|required|min_length[4]|max_length[32]');
        // $this->form_validation->set_rules('con_password', $this->lang->line('user_new_confirm'), 'trim|required|matches[password]');
        $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        // $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->register();
        } else {
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->saveRegister($id='');
            //Return to user list
            if($rs !== false){
                
                //============= NOW INSERT THE ELIGIBILITY TEST DATA =============
                $get_userd = $this->Csz_admin_model->get_one_row_data("applicant", array("email"=>$this->input->post('email')));
                if($get_userd){
                    
                    $insert_eligibility_data = array("applicant_id"=>$get_userd['id'],
                                                     "first_ques"=>1,
                                                     "second_ques"=>1,
                                                     "third_ques"=>1,
                                                     "fourth_ques"=>1,
                                                     "fifth_ques"=>1,
                                                     "sixth_ques"=>1,
                                                     "seventh_ques"=>1,
                                                     "eighth_ques"=>1,
                                                     "nine_ques_a"=>1,
                                                     "nine_ques_b"=>1,
                                                     "nine_ques_c"=>1,
                                                     "nine_ques_d"=>1,
                                                     "nine_ques_e"=>1,
                                                     "nine_ques_f"=>1,
                                                     "nine_ques_g"=>1
                                                    );
                    $this->Csz_admin_model->insertEligibility($insert_eligibility_data);
                }
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Account created successfully. Please check your email to verify your account and complete profile. </div>');
                redirect('login', 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->register();
            }
            redirect('login', 'refresh');
        }
    }
    

   public function details(){
       $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $search_arr = "active=1 and id=".$this->uri->segment(2);
            $result['grant'] = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $this->templateFront('details',$result);
        }
   } 

    public function verify(){
        $email = base64_decode($this->input->get('verify'));
        $search_arr = "status=0 and email='".$email."'";
        $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
        if(!empty($data)){
            $array = array('status' => 1);
            $this->db->where('email',$email);
            if($this->db->update('applicant',$array)){
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Email verified successfully. You can now login to your Account. </div>');
                redirect('login', 'refresh');
            }
        }else{
            redirect(base_url());
        }
    }
    
    public function error_404() {
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            set_status_header(404);
            $html= '<center>
                        <h1 style="font-size:120px;color:red;">404</h1>
                        <h2>' . $this->Csz_model->getLabelLang('site_error_404_title') . '</h2><br>
                        <p>' . $this->Csz_model->getLabelLang('site_error_404_text') . '</p><br>
                        <a class="btn btn-primary btn-lg" href="' . base_url() . '" role="button">' . $this->Csz_model->getLabelLang('btn_back') . ' &raquo;</a>
                    </center><script>setTimeout(function(){window.location.href="' . base_url() . '";},15000);</script>';
            $this->template->setSub('content', $html);
            //Load the view
            $this->template->loadFrontViews('static/error404');
            if ($config->pagecache_time != 0) {
                $this->db->cache_on();
                $this->output->cache($config->pagecache_time);
            }
        }
    }
    
    public function setLang() {
        $this->Csz_model->setSiteLang($this->uri->segment(2));
        redirect(base_url(), 'refresh');
    }

    public function getCoreCSS(){
        if (function_exists('session_cache_limiter')) {
            @session_cache_limiter(''); // add this line to the beginning of your php script to disable the cache limiter function:
        }
        $expires = 60 * 60 * 24 * 30; // Cache lifetime 30 days
        $file = FCPATH.'assets/css/bootstrap.min.css';
        $cssFiles = array(
            $file,
            FCPATH.'assets/css/flag-icon.min.css',
            FCPATH.'assets/css/full-slider.css',
        );
        $etag = @md5_file($file); // Generate Etag
        $fileModified = @filemtime($file);
        /*
          Set 304 Not Modified if old visitor
         */
        if (isset($_SERVER['SERVER_PROTOCOL']) && isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && isset($_SERVER['HTTP_IF_NONE_MATCH']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $fileModified && trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
            echo $this->Csz_model->setJSCSScache($cssFiles, 'corecss', 'css', $expires);
        } else {
            $this->Csz_model->setJSCSSheader($fileModified, $expires, $etag, 'text/css');
            echo $this->Csz_model->setJSCSScache($cssFiles, 'corecss', 'css', $expires);
        }
        $this->output->cache(43200);
        exit(0);
    }
    
    public function getCoreJS(){
        if (function_exists('session_cache_limiter')) {
            @session_cache_limiter(''); // add this line to the beginning of your php script to disable the cache limiter function:
        }
        $expires = 60 * 60 * 24 * 30; // Cache lifetime 30 days
        $file = FCPATH.'assets/js/bootstrap.min.js';
        $jsFiles = array(
            FCPATH.'assets/js/jquery-1.12.4.min.js',
            $file,
            FCPATH.'assets/js/jquery-ui.min.js',
            FCPATH.'assets/js/ui-loader.min.js',
            FCPATH.'assets/js/scripts.min.js',
        );
        $etag = @md5_file($file); // Generate Etag
        $fileModified = @filemtime($file);
        /*
          Set 304 Not Modified if old visitor
         */
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && isset($_SERVER['HTTP_IF_NONE_MATCH']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $fileModified && trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
            echo $this->Csz_model->setJSCSScache($jsFiles, 'corejs', 'js', $expires);
        } else {
            $this->Csz_model->setJSCSSheader($fileModified, $expires, $etag, 'text/javascript');
            echo $this->Csz_model->setJSCSScache($jsFiles, 'corejs', 'js', $expires);
        }
        $this->output->cache(43200);
        exit(0);
    }

}