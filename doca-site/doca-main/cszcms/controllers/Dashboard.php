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
class Dashboard extends CI_Controller {

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
        if(empty($this->session->userdata('user_id'))){
            redirect(base_url('login'));
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
            $grant = $this->Csz_admin_model->getIndexData('grant', '', '', 'id', 'DESC', $search_arr);
            $grantArray = [];
            if(!empty($grant)){
                foreach($grant as $vl){
                    $grantArray[$vl['id']] = $vl['title'];
                }
            }
            // print_r($grantArray); die;
            $result['grant'] = $grantArray;
            $search_arr = "user_id=".$this->session->userdata('user_id');
            $result['application'] = $this->Csz_admin_model->getIndexData('application', '', '', 'id', 'DESC', $search_arr);
            $this->templateFront('dashboard',$result);
        }
    }
    
   
}