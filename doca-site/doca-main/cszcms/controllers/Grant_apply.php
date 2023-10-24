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

require FCPATH.'system/libraries/PHPMailer/src/PHPMailer.php';
require FCPATH.'system/libraries/PHPMailer/src/SMTP.php';
class Grant_apply extends CI_Controller {

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
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form'); 
            $result = [];
            
            $search_arr = "status=1 AND complete=1 And id=".$this->session->userdata('user_id');
            $applicant = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            // echo "<pre>";
            // print_r($application); die;
            if(empty($applicant)){
               $this->session->set_flashdata('error_message','<div style="background-color:red;" class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Please complete your profile</div>');
                redirect('dashboard', 'refresh'); 
            }
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $form = $this->Csz_admin_model->getIndexData('form_main', '','', 'form_main_id', 'DESC', "form_main_id=".$grant[0]['project_summary_form_id']);
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            if(empty($application)){
                $data['grant_id'] = $grant[0]['id'];
                $data['user_id'] = $this->session->userdata('user_id');
                if($this->db->insert('application',$data)){
                    $application_id = $this->db->insert_id();
                }
                $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
                $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
                //Populate form submissions
                $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_main_id=".$form[0]['form_main_id']);
                foreach ($form_fields as $form_field){
                    $form_data['form_main_id'] = $form[0]['form_main_id'];
                    $form_data['form_field_id'] = $form_field['form_field_id'];
                    $form_data['form_field_name'] = $form_field['field_name'];
                    $form_data['application_id'] = $application_id;
                    $this->db->insert('form_submission',$form_data);
                }
                $result['application'] = $application[0];
            }
            // print_r($result); die;
            if($application[0]['complete'] ==1 && $application[0]['endDate'] > date('Y-m-d')){
                 $this->session->set_flashdata('error_message','<div style="background-color:red;" class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>You have already applied for this Grant. Click Here to apply for another grant.</div>');
                redirect('dashboard', 'refresh'); 
                
            }


//            getIndexData($table, $limit = 0, $offset = 0, $orderby = '', $sort = '', $search_sql = '', $groupby = '', $join_db = '', $join_where = '', $join_type = '', $sel_field = '*')
            $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_field.form_main_id=".$form[0]['form_main_id']." and form_submission.application_id = ".$application[0]['id'], '', 'form_submission', 'form_field.form_field_id = form_submission.form_field_id', 'inner','form_field.*,form_submission.form_field_value');

            $result['grant'] = $grant;
            $result['form_fields'] = $form_fields;
            $result['form'] = $form[0];
//            print_r($form);
//            die;
            $this->templateFront('project_details_new',$result);
        }
    }

    public function view(){
        
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            // $this->load->helper('form');
            $result = [];

            // echo "<pre>";
            // print_r($application); die;
            
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            $this->templateFront('details',$result);
        }
    }
   
    
        public function saveProject(){
//         $this->load->library('form_validation');
            //Validation passed
            $data = [];

            $grant_id = $this->uri->segment(2);
            $form_main_id = $this->uri->segment(3);
            $application_id = $this->uri->segment(4);
            $form = $this->Csz_admin_model->getIndexData('form_main', '','', 'form_main_id', 'DESC', "form_main_id=".$form_main_id);
            $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_main_id=".$form[0]['form_main_id']);
//            $rs = false;
            foreach ($form_fields as $form_field){
                if($form_field['field_type'] == 'file'){
                    if(!empty($_FILES[$form_field['field_name']]['name'])){
                        $upload = $this->Csz_admin_model->uploadDocDynamic($form_field['field_name']);
                        $form_data['form_field_value'] = $upload;
                        $this->db->where('application_id',$application_id);
                        $this->db->where('form_main_id',$form_main_id);
                        $this->db->where('form_field_id', $form_field['form_field_id']);
                    }
                }else{
                    $form_data['form_field_value'] = $this->input->post($form_field['field_name']);
                    $this->db->where('application_id',$application_id);
                    $this->db->where('form_main_id',$form_main_id);
                    $this->db->where('form_field_id', $form_field['form_field_id']);
                }
                $rs = $this->db->update('form_submission',$form_data);

                // Update application title
                if($form_field['field_name'] == 'title'){
                    $title_field['name'] = $this->input->post($form_field['field_name']);
                    $this->db->where('id', $application_id);
                    $rs2 = $this->db->update('application', $title_field);
                }
                
            }




            //Return to user list
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Project details Successfully saved </div>');
                redirect('project_director/'.$this->uri->segment(2), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
//                $this->index();
            }
            // redirect('login', 'refresh');

    } 
        public function saveProjectBackup(){
         $this->load->library('form_validation');
        //Set validation rules
		$this->form_validation->set_rules('project_timeline', 'Project timeline', 'trim|numeric');
        //$this->form_validation->set_rules('name', 'Project Name', 'trim|required');
        $this->form_validation->set_rules('p_date', 'Estimated Length', 'trim|numeric');
        // $this->form_validation->set_rules('description', 'Project description', 'trim|required');
        $this->form_validation->set_message('required', $this->lang->line('required'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->index();
        } else {
            //Validation passed
            $data = [];
			if(!empty($this->input->post('project_category'))){
			$data['project_category'] = $this->input->post('project_category');
            $data['project_brief'] = $this->input->post('project_brief');
            $data['project_timeline'] = $this->input->post('project_timeline');
			}
            if(empty($this->input->post('project_brief'))){
			$data['name'] = $this->input->post('name');
            $data['p_date'] = $this->input->post('p_date');
            // $data['description'] = $this->input->post('description');
            $data['e_length'] = $this->input->post('e_length');
			}
            $rs =$this->Csz_admin_model->updateApplication($data,$this->uri->segment(2));
            //Return to user list
            if($rs !== false){
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Project details Successfully saved </div>');
                redirect('project_director/'.$this->uri->segment(2), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->index();
            }
            // redirect('login', 'refresh');
        }
    }

    
        public function project_director() {
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            // print_r($result); die;
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            
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
            
            $search_arr = "application_id=".$application[0]['id'];
            $organization = $this->Csz_admin_model->getIndexData('organization', '', '', 'id', 'DESC', $search_arr);
            $result['organization_detail'] = $organization[0];
            $this->templateFront('director',$result);
        }
    }
   
    
        public function save_project_director(){
         $this->load->library('form_validation');
        //Set validation rules
        // $this->form_validation->set_rules('project_role', 'Project Role', 'trim|required');
        $this->form_validation->set_rules('organization_number', 'organization numberh', 'trim|numeric');
        $this->form_validation->set_rules('organization_code', 'POSTAL', 'trim|numeric');
        
        $this->form_validation->set_message('required', $this->lang->line('required'));
// echo "<pre>";
// print_r($this->input->post());
// die;
        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->project_director();
        } else {
            //Validation passed
            $data = [];
            
            if(!empty('organization_name')){
                $data['project_co'] = ($this->input->post('project_co')) ? 1 :0;
            }
            $data['project_role'] = $this->input->post('project_role');
            // print_r($data); die;
            $rs =$this->Csz_admin_model->updateApplication($data,$this->uri->segment(2));
            //Return to user list
            if($rs !== false){
                $this->Csz_admin_model->teamStore($rs);
                
                if(!empty('organization_name')){
                  $extra = [];
                  $this->db->where('application_id',$rs);
                  $this->db->delete('organization');
                  $extra['application_id'] = $rs;
                  $extra['organization_name'] = $this->input->post('organization_name');
                  $extra['organization_date'] = $this->input->post('organization_date');
                  $extra['organization_registration'] = $this->input->post('organization_registration');
                  $extra['organization_pays'] = $this->input->post('organization_pays');
                  $extra['organization_region'] = $this->input->post('organization_region');
                  $extra['organization_address'] = $this->input->post('organization_address');
                  $extra['organization_code'] = $this->input->post('organization_code');
                  $extra['organization_city'] = $this->input->post('organization_city');
                  $extra['organization_number'] = $this->input->post('organization_number');
                  $extra['organization_email'] = $this->input->post('organization_email');
                  $extra['organization_web'] = $this->input->post('organization_web');
//                    print_r($extra); die;
                  $this->db->insert('organization',$extra);
                }
                
                $extra = [];
                $extra['name'] = $this->input->post('memberName');
                $extra['role'] = $this->input->post('memberRole');
//                print_r(empty($this->input->post('memberName'))); die;
                if(!empty($this->input->post('memberName')) && !empty($this->input->post('memberRole'))){
                    $this->Csz_admin_model->memberStore($extra,$rs);
                }

                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Project role Successfully saved</div>');
                redirect('project_description/'.$this->uri->segment(2), 'refresh');
            }else{
//                die;
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->project_director();
            }
            // redirect('login', 'refresh');
        }
    } 
    
    
    public function project_description() {
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            // print_r($result); die;
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant[0];
            
            $search_arr = "application_id=".$application[0]['id'];
            $project = $this->Csz_admin_model->getIndexData('project_link', '', '', 'id', 'DESC', $search_arr);
            $result['project'] = $project;

//            My form stuff
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $form = $this->Csz_admin_model->getIndexData('form_main', '','', 'form_main_id', 'DESC', "form_main_id=".$grant[0]['project_description_form_id']);

            $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_field.form_main_id=".$form[0]['form_main_id']." and form_submission.application_id = ".$application[0]['id'], '', 'form_submission', 'form_field.form_field_id = form_submission.form_field_id', 'inner','form_field.*,form_submission.form_field_value');
            if(empty($form_fields)){
                $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_main_id=".$form[0]['form_main_id']);
                foreach ($form_fields as $form_field){
                    $form_data['form_main_id'] = $form[0]['form_main_id'];
                    $form_data['form_field_id'] = $form_field['form_field_id'];
                    $form_data['form_field_name'] = $form_field['field_name'];
                    $form_data['application_id'] = $application[0]['id'];
                    $this->db->insert('form_submission',$form_data);
                }
            }
            $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_field.form_main_id=".$form[0]['form_main_id']." and form_submission.application_id = ".$application[0]['id'], '', 'form_submission', 'form_field.form_field_id = form_submission.form_field_id', 'inner','form_field.*,form_submission.form_field_value');

            $result['form_fields'] = $form_fields;
            $result['form'] = $form[0];
            
            
            $this->templateFront('project_description_new',$result);
        }
    }
   
    
    public function save_project_description(){

            //Validation passed
            $data = [];
            $upload = $this->input->post('uploadId');
            if(!empty($_FILES['file_upload']['name'])){
                $upload = $this->Csz_admin_model->uploadDoc();
            }
            $grant_id = $this->uri->segment(2);
            $form_main_id = $this->uri->segment(3);
            $application_id = $this->uri->segment(4);
            $form = $this->Csz_admin_model->getIndexData('form_main', '','', 'form_main_id', 'DESC', "form_main_id=".$form_main_id);
            $form_fields = $this->Csz_admin_model->getIndexData('form_field', '','', 'form_field_id', 'ASC', "form_main_id=".$form[0]['form_main_id']);
                $rs = false;
            foreach ($form_fields as $form_field){
                if($form_field['field_type'] == 'file'){
                    // print_r("File uploading");
                    // die();
                    if(!empty($_FILES[$form_field['field_name']]['name'])){
                        
                        $upload = $this->Csz_admin_model->uploadDocDynamic($form_field['field_name']);
                        $form_data['form_field_value'] = $upload;
                        $this->db->where('application_id',$application_id);
                        $this->db->where('form_main_id',$form_main_id);
                        $this->db->where('form_field_id', $form_field['form_field_id']);
                        $rs = $this->db->update('form_submission',$form_data);
                       
                    }
                }else{
                    $form_data['form_field_value'] = $this->input->post($form_field['field_name']);
                    $this->db->where('application_id',$application_id);
                    $this->db->where('form_main_id',$form_main_id);
                    $this->db->where('form_field_id', $form_field['form_field_id']);
                    $rs = $this->db->update('form_submission',$form_data);
                }

            }

            //Return to user list
            if($rs !== false){

                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Project description Successfully saved</div>');
                redirect('project_budget/'.$this->uri->segment(2), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->project_description();
            }
            // redirect('login', 'refresh');

    } 
    public function save_project_description_backup(){
         $this->load->library('form_validation');
        //Set validation rules
         $this->form_validation->set_rules('project_timeline', 'Project timeline', 'trim|numeric');
        // $this->form_validation->set_rules('logline', 'Project Logline', 'trim|required');
        // $this->form_validation->set_rules('story_structure', 'Project Background and story structure', 'trim|required');
        // $this->form_validation->set_rules('characters_description', 'Project Characters Description', 'trim|required');
        // $this->form_validation->set_rules('artistic_approach', 'Project Artistic Approach', 'trim|required');
        // $this->form_validation->set_rules('letter_of_motivation', 'Project Letter Of Motivation', 'trim|required');
        // $this->form_validation->set_rules('representation', 'producer note', 'trim|required');

        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        // $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->project_description();
        } else {
            //Validation passed
            $data = [];
            $upload = $this->input->post('uploadId');
            if(!empty($_FILES['file_upload']['name'])){
                $upload = $this->Csz_admin_model->uploadDoc();
            }

            // $visual_upload = '';
            $visual_upload = $this->input->post('visual_upload_data');
            if(!empty($_FILES['visual_upload']['name'])){
                $visual_upload = $this->Csz_admin_model->visual_upload();
            }

            $artistic_upload = $this->input->post('artistic_upload_data');
            if(!empty($_FILES['artistic_upload']['name'])){
                $artistic_upload = $this->Csz_admin_model->artistic_upload();
            }

			if(!empty($this->input->post('logline'))){
            	$data['representation_upload'] = $upload;
            	$data['visual_upload'] = $visual_upload;
            	$data['artistic_upload'] = $artistic_upload;
            	$data['logline'] = $this->input->post('logline');
            	$data['synopsis'] = $this->input->post('synopsis');
            	$data['story_structure'] = $this->input->post('story_structure');
            	$data['characters_description'] = $this->input->post('characters_description');
            	$data['artistic_approach'] = $this->input->post('artistic_approach');
            	$data['letter_of_motivation'] = $this->input->post('letter_of_motivation');
            	$data['representation'] = $this->input->post('representation');
			}
            if(!empty($this->input->post('briefly_explain'))){
            	$data['briefly_explain'] = $this->input->post('briefly_explain');
            	$data['project_describe'] = $this->input->post('project_describe');
            	$data['organisation'] = $this->input->post('organisation');
            	$data['socio_economic'] = $this->input->post('socio_economic');
            	//$data['video_link'] = $this->input->post('video_link');
            	$data['explain_organisation'] = $this->input->post('explain_organisation');
            	$data['description_link'] = $this->input->post('description_link');
            	$data['description_password'] = $this->input->post('description_password');
			}
            // print_r($data); die;
            $rs =$this->Csz_admin_model->updateApplication($data,$this->uri->segment(2));
            //Return to user list
            if($rs !== false){

                $extra = [];
                $extra['project_link'] = $this->input->post('project_link');
                $extra['project_password'] = $this->input->post('project_password');
                if(!empty($this->input->post('project_link')) && !empty($this->input->post('project_password'))){
                    $this->Csz_admin_model->projectStore($extra,$rs);
                }

                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Project description Successfully saved</div>');
                redirect('project_budget/'.$this->uri->segment(2), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->project_description();
            }
            // redirect('login', 'refresh');
        }
    }


        public function organisation() {
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            // print_r($result); die;
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            
            $search_arr = "application_id=".$application[0]['id'];
            $project = $this->Csz_admin_model->getIndexData('project_link', '', '', 'id', 'DESC', $search_arr);
            $result['project'] = $project;
            
            
            
            $this->templateFront('organisation',$result);
        }
    }
   
    
    public function save_organisation(){
         $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('project_category', 'Project category', 'trim|required');
        $this->form_validation->set_rules('project_brief', 'Project brief', 'trim|required');
        $this->form_validation->set_rules('project_timeline', 'Project timeline', 'trim|required|numeric');
        // $this->form_validation->set_rules('artistic_approach', 'Project Artistic Approach', 'trim|required|numeric');
        // $this->form_validation->set_rules('letter_of_motivation', 'Project Letter Of Motivation', 'trim|required');
        // $this->form_validation->set_rules('representation', 'Project Visual Representation', 'trim|required');
       
        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        // $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->organisation();
        } else {
            //Validation passed
            $data = [];
            $upload = $this->input->post('uploadId');
            if(!empty($_FILES['file_upload']['name'])){
                $upload = $this->Csz_admin_model->uploadDoc();
            }  
            $data['proposal_upload'] = $upload; 
            $data['project_category'] = $this->input->post('project_category');
            $data['project_brief'] = $this->input->post('project_brief');
            $data['project_timeline'] = $this->input->post('project_timeline');
            $data['briefly_explain'] = $this->input->post('briefly_explain');
            $data['project_describe'] = $this->input->post('project_describe');
            $data['organisation'] = $this->input->post('organisation');
            $data['socio_economic'] = $this->input->post('socio_economic');
            $data['video_link'] = $this->input->post('video_link');
            $data['explain_organisation'] = $this->input->post('explain_organisation');
            $rs =$this->Csz_admin_model->updateApplication($data,$this->uri->segment(2));
            //Return to user list
            if($rs !== false){
                
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Project description Successfully saved</div>');
                redirect('project_contract/'.$this->uri->segment(2), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->organisation();
            }
            // redirect('login', 'refresh');
        }
    } 
    

    public function project_budget() {
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            // print_r($result); die;
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            
            $search_arr = "application_id=".$application[0]['id'];
            $budget = $this->Csz_admin_model->getIndexData('budget', '', '', 'id', 'DESC', $search_arr);
            $result['budget'] = $budget;
            
            $this->templateFront('project_budget',$result);
        }
    }
   
    
    public function save_project_budget(){
         $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('projectBudget', 'Project Budget', 'trim|required|numeric');
        // $this->form_validation->set_rules('financialPlan', 'Project financial Plan', 'trim|required');
        // $this->form_validation->set_rules('ackStatement', 'Project acknowledgement statements', 'trim|required');
        // $this->form_validation->set_rules('submittedBy', 'Project SubmittedBy', 'trim|required');
        // $this->form_validation->set_rules('letter_of_motivation', 'Project Letter Of Motivation', 'trim|required');
        // $this->form_validation->set_rules('representation', 'Project Visual Representation', 'trim|required');
       
        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->project_budget();
        } else {
            //Validation passed
            $data = [];
            $budgetFile = $this->input->post('budgetFile_data');
            if(!empty($_FILES['budgetFile']['name'])){
                $budgetFile = $this->Csz_admin_model->upload_budgetFile();
            } 
            
            // $contractProof = $this->input->post('contractProof_data');
            // if(!empty($_FILES['contractProof']['name'])){
            //     $contractProof = $this->Csz_admin_model->upload_contractProof();
            // } 
            
            // $data['contractProof'] = $contractProof;
            $data['budgetFile'] = $budgetFile;
            $data['projectBudget'] = $this->input->post('projectBudget');
            // $data['financialPlan'] = $this->input->post('financialPlan');
            // $data['ackStatement'] = $this->input->post('ackStatement');
            $data['BudgetDeficit'] = $this->input->post('BudgetDeficit');
            $data['letter_of_motivation'] = $this->input->post('letter_of_motivation');
            $data['representation'] = $this->input->post('representation');
            $data['project_link'] = $this->input->post('project_link');
            $data['project_password'] = $this->input->post('project_password');
            
            $data['totalSecured'] = $this->input->post('totalSecured');
            $data['totalApplied'] = $this->input->post('totalApplied');
            $data['totalPening'] = $this->input->post('totalPening');
            
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->updateApplication($data,$this->uri->segment(2));
            //Return to user list
            if($rs !== false){

                
                $extra = [];
                $extra['fundingSource'] = $this->input->post('fundingSource');
                $extra['status'] = $this->input->post('status');
                $extra['amount'] = $this->input->post('amount');
                $this->Csz_admin_model->budgetStore($extra,$rs);
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Budget successfully saved</div>');
                redirect('project_contract/'.$this->uri->segment(2), 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->project_budget();
            }
            // redirect('login', 'refresh');
        }
    } 
    
    
    // =============== EDIT ACCEPTED APPLICATION ===========================================================
     public function edit_accepted_application() {
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            // print_r($result); die;
            $search_arr = "active=1 AND id=".$application[0]['grant_id'];
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            
            $search_arr = "application_id=".$application[0]['id'];
            $budget = $this->Csz_admin_model->getIndexData('budget', '', '', 'id', 'DESC', $search_arr);
            $result['budget'] = $budget;
            
            $project = $this->Csz_admin_model->getIndexData('project_link', '', '', 'id', 'DESC', $search_arr);
            $result['project'] = $project;
            
            $contract_t = $grant[0]['contract'];
            if($grant[0]['description_type'] == 4){
                $contract_t = 4;
            }
            
            $contract_save = $this->Csz_admin_model->getIndexData('contract_save', '', '', 'id', 'ASC', $search_arr);
            $result['contract_save'] = $contract_save;
        
            $search_arr = "contract_type=".$contract_t;
            $contract = $this->Csz_admin_model->getIndexData('contract', '', '', 'id', 'ASC', $search_arr);
            $result['contract'] = $contract;
            
            // echo "<pre>";print_r($contract);die;
            $this->templateFront('editaccepted_application_new',$result);
        }
    }
    
    
    public function save_edited_application(){
            
        $application_id = $this->uri->segment(2);
        // echo "<pre>";
        // print_r($this->input->post());
        // echo "<pre>";
        // print_r($_FILES);die;
        //Validation passed
        $data = [];
        // ============ BUDGET FILE UPLOAD SECTION ====================
        $budgetFile = $this->input->post('budgetFile_data');
        if(!empty($_FILES['budgetFile']['name'])){
            $budgetFile = $this->Csz_admin_model->upload_budgetFile();
        } 

        //==============APPLICATION DATA TO UPLOAD ========================
        $proofFile_upload = $this->input->post('proofFile_data');
        if(!empty($_FILES['proofFile']['name'])){
            $proofFile_upload = $this->Csz_admin_model->proofFile_upload();
        }

        $data['budgetFile'] = $budgetFile;
        
        $data['letter_of_motivation'] = $this->input->post('letter_of_motivation');
        $data['representation'] = $this->input->post('representation');
        $data['rel_status_update'] = $this->input->post('rel_status_update');

    	$data['proofFile'] = $proofFile_upload; 

        // ===========CONTRACT FILE UPLOAD ==================
        $contractfile11 = $this->input->post('contractfile11') ? $this->input->post('contractfile11') : "";
      
        if(!empty($_FILES['file11']['name'])){
        
            $contract_id = $this->input->post('contract_id');
            $contractidd = $contract_id[0];
            $answer11 = $this->input->post("answer11");
            $c = $this->Csz_admin_model->contractStoreUpdateInsert($contractidd, $answer11, $contractfile11, $application_id);
        } 
        //$c =  $this->Csz_admin_model->contractStoreUpdateInsert($extra,$application_id);    //  update insert case of contract
     
        $rs = $this->Csz_admin_model->updateEditedApplication($data,$application_id);
        //Return to dashboard
        if($rs !== false){
            //Return to dashboard
            $this->db->cache_delete_all();
            $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span>Application updated successfully!</div>');
            redirect('dashboard', 'refresh');
        }else{
            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
             redirect('dashboard', 'refresh');
        }

    } 
    
    
    
    // ====================END HERE ACCEPTED APPLICATION CODE ================================================


  public function project_contract() {
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
        }
        $config = $this->Csz_model->load_config();
        if($config->maintenance_active){
            $this->template->loadFrontViews('static/maintenance');
        }else{
            $this->load->helper('form');
            $result = [];
            $search_arr = "user_id=".$this->session->userdata('user_id')." AND grant_id=".$this->uri->segment(2);
            $application = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $result['application'] = $application[0];
            // print_r($result); die;
            $search_arr = "active=1 AND id=".$this->uri->segment(2);
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $result['grant'] = $grant;
            
            $contract_t = $grant[0]['contract'];
            if($grant[0]['description_type'] == 4){
                $contract_t = 4;
            }
            $search_arr = "contract_type=".$contract_t;
            $contract = $this->Csz_admin_model->getIndexData('contract', '', '', 'id', 'ASC', $search_arr);
            $result['contract'] = $contract;
            
            
            $search_arr = "id=".$this->session->userdata('user_id');
            $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
            $result['user'] = $data[0];
            
            // $search_arr = "application_id=".$application[0]['id'];
            // $contract_save = $this->Csz_admin_model->getIndexData('contract_save', '', '', 'id', 'ASC', $search_arr);
            // $result['contract_save'] = $contract_save;
            
            $this->templateFront('contract',$result);
        }
    }
   
    
    public function save_project_contract(){
         $this->load->library('form_validation');
        //Set validation rules
        
        // $this->form_validation->set_rules('ackStatement', 'Project acknowledgement statements', 'trim|required');
        $this->form_validation->set_rules('submittedBy', 'Project SubmittedBy', 'trim|required');
        // $this->form_validation->set_rules('letter_of_motivation', 'Project Letter Of Motivation', 'trim|required');
        // $this->form_validation->set_rules('representation', 'Project Visual Representation', 'trim|required');
       
        // $this->form_validation->set_message('is_unique', $this->lang->line('is_unique'));
        // $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        $this->form_validation->set_message('matches', $this->lang->line('matches'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        // $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        // $this->form_validation->set_message('max_length', $this->lang->line('max_length'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->project_contract();
        } else {
            //Validation passed
            $data = [];
          
            // $data['ackStatement'] = $this->input->post('ackStatement');
            $data['submittedBy'] = $this->input->post('submittedBy');
            $data['complete'] = 1;
            
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->updateApplication($data,$this->uri->segment(2));
            //Return to user list
            if($rs !== false){
                $search_arr = "status=1 AND email='".$this->session->userdata('email')."'";
                $data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr);
         
                $search_arr = "active=1 AND id=".$this->uri->segment(2);
                $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
                  $to      = $this->session->userdata('email');
			$subject = 'Doca | Application Successful';
			$message = 'Hello '.$data[0]['name']."\r\n" ;
			$message.= "<br>Congratulations!! Your application for ".$grant[0]['title']." has been received successfully. You will receive an update on the status of your application in due course.<br><br>Thank you";

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
			
			
			
			
			$to      = 'no-reply@documentaryafrica.org';
			$subject = 'Doca | New Grant Application';
			$message = ' '.$data[0]['name']."\r\n" ;
			$message.= "has successfully applied for ".$grant[0]['title']." > Please log in to your Admin Dashboard to review the Application.<br><br>Thank you";

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
			
            //  return true;
             
                $extra = [];
                $extra['contract_id'] = $this->input->post('contract_id');
                $extra['answer'] = $this->input->post();
                $this->Csz_admin_model->contractStore($extra,$rs);
             
             
                //Return to user list
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert success alert-success" role="alert"><span class="closebtn" onclick="this.parentElement.style.display=`none`;">&times;</span> Application Successfully submitted</div>');
                redirect('dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error').'</div>');
                $this->project_contract();
            }
            // redirect('login', 'refresh');
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