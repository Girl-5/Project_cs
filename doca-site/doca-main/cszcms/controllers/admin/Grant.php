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
class Grant extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->lang->load('admin', $this->Csz_admin_model->getLang());
        $this->template->set_template('admin');
        $this->_init();
    }

    public function _init() {
        $this->template->set('core_css', $this->Csz_admin_model->coreCss());
        $this->template->set('core_js', $this->Csz_admin_model->coreJs());
        $this->template->set('title', 'Backend System | ' . $this->Csz_admin_model->load_config()->site_name);
        $this->template->set('meta_tags', $this->Csz_admin_model->coreMetatags('Backend System for CSZ Content Management System'));
        $this->template->set('cur_page', $this->Csz_admin_model->getCurPages());
    }

    public function index() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        $this->load->library('pagination');
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        // $search_arr = " user_type = 'admin' ";
        if($this->input->get('search')){
            $search_arr.= ' 1=1 ';
            if($this->input->get('search')){
                $search_arr.= " AND title LIKE '%".$this->input->get('search', TRUE)."%'";
            }
        }
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->Csz_model->countData('grant', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/grant/';
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link);     
        ($this->uri->segment(3))? $pagination = $this->uri->segment(3) : $pagination = 0;
        //Get users from database
        $this->template->setSub('grant', $this->Csz_admin_model->getIndexData('grant', $result_per_page, $pagination, 'id', 'DESC', $search_arr));        
        $this->template->setSub('total_row', $total_row);       
        //Load the view
        $this->template->loadSub('admin/grant/index');
    }

    public function addgrant() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        $search_arr.= ' 1=1 ';
        $form_main = $this->Csz_admin_model->getIndexData('form_main', 20, 0, 'form_main_id', 'DESC', $search_arr); 
        //Load the form helper
        $this->load->helper('form');
        //Load the view
        $this->template->setSub('form_main', $form_main);
        $this->template->loadSub('admin/grant/add');
    }

    public function confirm() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        admin_helper::is_allowchk('save');
        //Load the form validation library
        $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
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
            $this->addgrant();
        } else {
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->creategrant($id='');
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

    public function editgrant() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        if($this->Csz_auth_model->is_group_allowed('admin users', 'backend') === FALSE){
            redirect('/admin/grant', 'refresh');
        }
        //Load the form helper
        $this->load->helper('form');
        if($this->uri->segment(4)){
            $this->db->cache_on();
            $this->db->cache_delete_all();
            // Get forms
            $search_arr.= ' 1=1 ';
            $form_main = $this->Csz_admin_model->getIndexData('form_main', 20, 0, 'form_main_id', 'DESC', $search_arr); 
            //Get user details from database
            $where = 'id='.$this->uri->segment(4);
            $grant = $this->Csz_model->getValue('*', 'grant', $where, '', 1);
            if($grant !== FALSE){
                $this->template->setSub('grant', $grant);
                $this->template->setSub('form_main', $form_main);
                //Load the view
                $this->template->loadSub('admin/grant/edit');
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
            redirect('/admin/grant', 'refresh');
        }       
        //Load the form validation library
        $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('title', $this->lang->line('title'), 'required');
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        $this->form_validation->set_message('required', $this->lang->line('required'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->editgrant();
        } else {
            //Validation passed
            //Update the user
            $rs = $this->Csz_admin_model->creategrant($this->uri->segment(4));
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

    public function delete() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        admin_helper::is_allowchk('delete');
        if($this->uri->segment(4)){
                //Delete the user account
                $this->Csz_admin_model->deleteData('grant',$this->uri->segment(4),'id');
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
           
        }
        //Return to user list
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }

    /*     * ************ Forgotten Password Resets ************* */


}
