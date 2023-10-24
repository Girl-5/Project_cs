<?php
defined('BASEPATH') || exit('No direct script access allowed');

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
class Admin extends CI_Controller {

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
        if (CACHE_TYPE == 'file') {
            $this->load->driver('cache', array('adapter' => 'file', 'key_prefix' => EMAIL_DOMAIN . '_'));
        } else {
            $this->load->driver('cache', array('adapter' => CACHE_TYPE, 'backup' => 'file', 'key_prefix' => EMAIL_DOMAIN . '_'));
        }
    }

    public function index() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::chk_reset_password();
        if($this->config->item('runStartupEnable') !== false){
            $this->load->model('Csz_startup');
            $this->Csz_startup->chkStartRun(TRUE);
        }
        $foryear = date("Y");
        $this->csz_referrer->setIndex();
        $this->load->helper('form');
        $config = $this->Csz_model->load_config();
        if(!$config->pagecache_time){
            $pagecache_time = 1;
        }else{
            $pagecache_time = $config->pagecache_time;
        }
        $this->load->library('RSSParser');
        $this->rssparser->set_feed_url($this->config->item('csz_backend_feed_url')); /* Main Link */ 
        /* get feed from CSZ CMS Article */
        $this->rssparser->set_cache_life($pagecache_time); /* Set cache life time in minutes */
        $this->template->setSub('rss', $this->rssparser->runFeedBackend(7)); /* have function cache (backend_rssfeed_news) */
        if($this->input->post('searchdata')){
           $foryear = $this->input->post('years');
        }
        $application_count =  $this->Csz_admin_model->getCountFromApplication($foryear);
        $applicant_count =  $this->Csz_admin_model->getCountFromApplicant($foryear);
        
        //============ APPLICATION COUNT WITH DIFFERENT STATUS ==================================================
        $this->template->setSub('all_applications', $application_count['all_applications']);      // COUNT SUBMITTED APPLICATIONS 
        $this->template->setSub('incomplete_applications', $application_count['incomplete_applications']);      // COUNT SUBMITTED APPLICATIONS 
        $this->template->setSub('submitted_applications', $application_count['submitted_applications']);      // COUNT SUBMITTED APPLICATIONS 
        $this->template->setSub('preselected_applications', $application_count['preselected_applications']);   // COUNT IN PROGRESS APPLICATIONS
        $this->template->setSub('shortlisted_applications', $application_count['shortlisted_applications']);        // COUNT REJECTED APPLICATIONS
        $this->template->setSub('accepted_applications', $application_count['accepted_applications']);       // COUNT REJECTED APPLICATIONS
        
        //=========== APPLICANT COUNT WITH DIFFERENT STATUS ============================================================
        $this->template->setSub('all_applicant', $applicant_count['total_applicant']);               // COUNT ALL APPLICANTS
        $this->template->setSub('completed_profile', $applicant_count['completed_profile']);        // COUNT COMPLETED APPLICANTS PROFILE
        $this->template->setSub('activated_profiles', $applicant_count['activated_profiles']);     // COUNT ACTIVATED APPLICANTS PROFILE
        $this->template->setSub('inactive_profile', $applicant_count['inactive_profile']);        // COUNT IN-ACTIVATED APPLICANTS PROFILE
        
        // =========GET COUNT FOR GENDER ============================================================================================
          $this->template->setSub('male_g', $applicant_count['male_g']);  // FOR MALE COUNT
          $this->template->setSub('female_g', $applicant_count['female_g']); // FOR FEMALE COUNT
          $this->template->setSub('non_binary', $applicant_count['non_binary']);  // FOR NON BINARY COUNT
          $this->template->setSub('rather_not_say', $applicant_count['rather_not_say']); // FOR RATHER NOT SAY COUNT
        // ======================================================================================================================
        
        //========GET NATIONALITY VISE COUNT DATA ===================================================
          $where = "nationality != '' and YEAR(addon) =".$foryear;
          $nationality_data = $this->Csz_admin_model->getIndexData('applicant', '', '', 'nationality', 'ASC', $where, "nationality");
          $this->template->setSub('nationality_data', $nationality_data);   
          $nationality_names = [];
          foreach ($nationality_data as $key => $value) {    
             
            $where1 = array("nationality"=>$value['nationality']);
            $nationality_names[$value['nationality']] = $this->Csz_model->countData('applicant', $where1);  // FOR NATIONALITY COUNT
          }
          $this->template->setSub('nationality_names', $nationality_names);
        //===========================================================================================
            
        //========GET COUNT FOR:  SUBMITTED GRANT APPLICATIONA ==================================================
          $where = "active = 1 ";
          $grantnameArray = $this->Csz_model->getValueArray('*', 'grant', 'active', '1', "0", "title");
          $this->template->setSub('grantnameArray', $grantnameArray);   
          $submitted_grant_application = [];
          foreach ($grantnameArray as $key => $value) {   
              
            $where1 = array("grant_id"=>$value['id'], "complete"=>1, "status"=>0, "YEAR(addon)"=>$foryear);
            $submitted_grant_application[$value['id']] = $this->Csz_model->countData('application', $where1);  // FOR NATIONALITY COUNT
          }
          $this->template->setSub('submitted_grant_application', $submitted_grant_application);
        //===========================================================================================
        
        //========GET COUNT FOR:  GRANT APPLICATIONA IN PROGRESS ======================================
          $inprogress_grant_application = [];
          foreach ($grantnameArray as $key => $value) {                 
            $where1 = array("grant_id"=>$value['id'], "complete"=>0, "status"=>0, "YEAR(addon)"=>$foryear);
            $inprogress_grant_application[$value['id']] = $this->Csz_model->countData('application', $where1);  // FOR NATIONALITY COUNT
          }
          $this->template->setSub('inprogress_grant_application', $inprogress_grant_application);
        //===========================================================================================
        
        //========= COUNTRY LIST ================================================================
        $country = $this->returnCountry();
        $this->template->setSub('country', $country);
        // ==============================================================================================
        
        $this->template->loadSub('admin/home');
    }
    
    public function getreviews() {
        
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        $reviews = $this->Csz_admin_model->getapplicationsreview();
          foreach ($reviews as $key => $value) {                 
            $where1 = array("application_id"=>$value['application_id'], "eleven_ques_a"=>1);   //  FOR  RECOMMEND
            $reviews[$key]["recommend"] = $this->Csz_model->countData('admin_reviews', $where1);  // FOR RECOMMEND COUNT
            
            $where1 = array("application_id"=>$value['application_id'], "eleven_ques_a"=>2);   //  FOR  UNDECIDED
            $reviews[$key]["undecided"] = $this->Csz_model->countData('admin_reviews', $where1);  // FOR UNDECIDED COUNT
            
            $where1 = array("application_id"=>$value['application_id'], "eleven_ques_a"=>3);   //  FOR NOT RECOMMEND
            $reviews[$key]["not_recommend"] = $this->Csz_model->countData('admin_reviews', $where1);  // FOR NOT RECOMMEND COUNT
          }
        $this->template->setSub('reviews', $reviews);
        $this->template->loadSub('admin/getreviews');
    }
    
    
    public function getreviewcomments() {
        
        admin_helper::is_logged_in($this->session->userdata('admin_email')); 
        $next_id = 0;
        $previous_id = 0;
        if($this->uri->segment(3) && is_numeric($this->uri->segment(3))){
           $id = $this->uri->segment(3);
        }else{
            $id = 0;
        }
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
        $get_one_row_review =  $this->Csz_admin_model->get_one_row_data("admin_reviews", array("id"=>$id));
        
        $reviews_comments = $this->Csz_admin_model->getreviewcomments($get_one_row_review["application_id"]);

        
        //============ FOR NEXT_ID AND PREVEVIOUS_ID ONLY FOR THE COMPLETE APPLICATION ====================================
        if($get_one_row_review){
            
            $oneapplication =  $this->Csz_admin_model->get_one_row_data("application", array("id"=>$get_one_row_review["application_id"]));
            if($oneapplication["grant_id"] == 23 || $oneapplication['title'] == "Project Support Doc Organisations"){
               $is_1st_grant = $oneapplication["grant_id"];
            }
          $getnext = $this->Csz_admin_model->getNextPrevious_for_reviews($get_one_row_review["id"], 1 ); // FOR NEXT 
          if($getnext){
            $next_id = $getnext['id'];
          }
          $getprevious = $this->Csz_admin_model->getNextPrevious_for_reviews($get_one_row_review["id"], 0 ); // FOR PREVIOUS 
          if($getprevious){
            $previous_id = $getprevious['id'];
          }
        }
        // ===========FOR NEXT_ID AND PREVEVIOUS_ID END HERE ================================================
        
        // ========== FOR COUNT OF RECOMMEND AND NOT RECOMMEND AND UNDECIDED
        $where1 = array("application_id"=>$get_one_row_review['application_id'], "eleven_ques_a"=>1);   //  FOR  RECOMMEND
        $recommend = $this->Csz_model->countData('admin_reviews', $where1);  // FOR RECOMMEND COUNT
        
        $where1 = array("application_id"=>$get_one_row_review['application_id'], "eleven_ques_a"=>2);   //  FOR  UNDECIDED
        $undecided = $this->Csz_model->countData('admin_reviews', $where1);  // FOR UNDECIDED COUNT
        
        $where1 = array("application_id"=>$get_one_row_review['application_id'], "eleven_ques_a"=>3);   //  FOR NOT RECOMMEND
        $not_recommend = $this->Csz_model->countData('admin_reviews', $where1);  // FOR NOT RECOMMEND COUNT
        // ===================================================================
        
        $this->template->setSub('undecided',  $undecided);
        $this->template->setSub('recommend',  $recommend);
        $this->template->setSub('not_recommend',  $not_recommend);
        
        $this->template->setSub('is_admin',  $is_admin);
        $this->template->setSub('is_editor',  $is_editor);
        $this->template->setSub('is_1st_grant',  $is_1st_grant);
        
        $this->template->setSub('next_id',  $next_id);
        $this->template->setSub('previous_id',  $previous_id);
             
        $this->template->setSub('reviews_comments', $reviews_comments);
        $this->template->loadSub('admin/getreviewcomments');
    }
    
    
    public function analytics() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('analytics');
        $this->load->helper('form');
        $this->db->cache_on();
        $settings = $this->Csz_admin_model->load_config();
        $this->csz_referrer->setIndex();
        if($this->uri->segment(3) && is_numeric($this->uri->segment(3))){
            $days = $this->uri->segment(3);
        }else{
            $days = 30;
        }
        $this->template->setJS('<!-- Step 2: Load the library. -->
        <script>
        (function(w,d,s,g,js,fjs){
          g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
          js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
          js.src="https://apis.google.com/js/platform.js";
          fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load("analytics")};
        }(window,document,"script"));
        </script>
        <script>
        gapi.analytics.ready(function() {
          /* Step 3: Authorize the user. */
          var CLIENT_ID = "'.$settings->ga_client_id.'";
          var VIEW_ID = "ga:'.str_replace('ga:', '', $settings->ga_view_id).'";
          gapi.analytics.auth.authorize({
            container: "auth-button",
            clientid: CLIENT_ID,
          });
          /* Step 4: Create the view selector. */
          var viewSelector = new gapi.analytics.ViewSelector({
            container: "view-selector"
          });
          /* Step 5: Create the timeline chart. activeUsers */
          var referdata = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:fullReferrer",
              "metrics": "ga:sessions,ga:pageviews",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
              "sort": "-ga:sessions",
            },
            chart: {
              type: "TABLE",
              container: "timeline-refer"
            }
          });
          var timeline = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:country",
              "metrics": "ga:sessions",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
            },
            chart: {
              type: "GEO",
              container: "timeline-map",
              keepAspectRatio: true,
              width: "100%",
            }
          });
          var timeline2 = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:date",
              "metrics": "ga:sessions",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
            },
            chart: {
              type: "LINE",
              container: "timeline-sessions",
            }
          });
          var timeline3 = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:browser",
              "metrics": "ga:sessions",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
            },
            chart: {
              type: "PIE",
              container: "timeline-device",
            }
          });
          var timeline4 = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:source",
              "metrics": "ga:sessions",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
            },
            chart: {
              type: "PIE",
              container: "timeline-source",
            }
          });
          var allpagedata = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:pagePath",
              "metrics": "ga:sessions,ga:pageviews,ga:bounceRate",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
              "sort": "-ga:sessions",
            },
            chart: {
              type: "TABLE",
              container: "timeline-allpage"
            }
          });
          var allkeyworddata = new gapi.analytics.googleCharts.DataChart({
            reportType: "ga",
            query: {
              "ids": VIEW_ID,
              "dimensions": "ga:keyword",
              "metrics": "ga:sessions,ga:organicSearches",
              "start-date": "'.$days.'daysAgo",
              "end-date": "today",
              "sort": "-ga:sessions",
            },
            chart: {
              type: "TABLE",
              container: "timeline-allkeyword"
            }
          });
          /* Step 6: Hook up the components to work together. */
          gapi.analytics.auth.on("success", function(response) {
            timeline.set().execute();
            timeline2.set().execute();
            timeline3.set().execute();
            referdata.set().execute();
            timeline4.set().execute();
            allpagedata.set().execute();
            allkeyworddata.set().execute();
          });
        });
        </script>');
        $this->template->setSub('settings', $settings);
        $this->template->loadSub('admin/analytics');
    }
    
    public function deleteEmailLogs() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('email logs');
        admin_helper::is_allowchk('delete');
        //Delete the languages
        if($this->uri->segment(4)) {
            $this->Csz_admin_model->removeData('email_logs', 'email_logs_id', $this->uri->segment(4));
            $this->db->cache_delete_all();
            $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        }
        //Return to languages list
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }

    public function login() {
        admin_helper::login_already($this->session->userdata('admin_email'));
        //Load the form helper
        //$this->Csz_model->clear_uri_cache($this->config->item('base_url').urldecode('admin'));
        $this->template->setSub('error', '');
        $this->load->helper('form');
        $this->template->loadSub('admin/login');
    }

    public function loginCheck() {
        admin_helper::login_already($this->session->userdata('admin_email'));
        //Load the form validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', $this->lang->line('login_email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('password', $this->lang->line('login_password'), 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_message('valid_email', $this->lang->line('valid_email'));
        $this->form_validation->set_message('required', $this->lang->line('required'));
        $this->form_validation->set_message('min_length', $this->lang->line('min_length'));
        $this->form_validation->set_message('max_length', $this->lang->line('max_length'));
        if ($this->form_validation->run() == FALSE) {
            $this->login();
        }else{
            $email = $this->Csz_model->cleanEmailFormat($this->input->post('email', TRUE));
            $result = $this->Csz_model->login($email, $this->input->post('password', TRUE), TRUE); /* TRUE for backend login */
            if ($result == 'SUCCESS') {
                $this->Csz_model->saveLogs($email, 'Backend Login Successful!', $result);
                if($this->session->userdata('cszblogin_cururl')){
                    $this->Csz_admin_model->jsredirect($this->session->userdata('cszblogin_cururl'));
                }else{
                    $this->Csz_admin_model->jsredirect($this->Csz_model->base_link().'/admin');
                }
            } else {
                $this->Csz_model->saveLogs($email, 'Backend Login Invalid!', $result);
                $this->template->setSub('error', $result);
                $this->load->helper('form');
                $this->template->loadSub('admin/login');
            }
        } 
    }

    public function logout() {
        $this->Csz_model->logout($this->Csz_model->base_link().'/admin/login');
    }

    public function social() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('social');
        //Load the form helper
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        $this->load->helper('form');

        $this->template->setSub('social', $this->Csz_admin_model->getSocial());
        $this->template->loadSub('admin/social');
    }

    public function updateSocial() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('social');
        admin_helper::is_allowchk('save');
        $this->Csz_admin_model->updateSocial();
        $this->db->cache_delete_all();
        $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }
    
    public function genSitemap() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('site settings');
        admin_helper::is_allowchk('save');
        $this->load->model('Csz_sitemap');
        $this->Csz_sitemap->runSitemap();
        $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }
    
    public function testSendMail() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('site settings');
        admin_helper::is_allowchk('save');
        $config = $this->Csz_admin_model->load_config();
        $message_html = 'Dear ' . $config->default_email . ',<br><br>Test send email from ' . $config->site_name . '.<br>Your email config on Site Settings been successful!<br><br>Best Regards,<br><a href="' . $this->Csz_model->base_link(). '" target="_blank"><b>' . $config->site_name . '</b></a>';
        $mailrs = @$this->Csz_model->sendEmail($config->default_email, 'Test send email from '.$config->site_name, $message_html, 'no-reply@' . EMAIL_DOMAIN, $config->site_name);
        if($mailrs == 'success'){
            $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        }else{
            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">Error! '.$mailrs.'</div>');
        }
        $this->db->cache_delete_all();
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }

    public function settings() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('site settings');
        //Load the form helper
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        $this->load->helper('form');
        $this->load->helper('directory');
        $this->load->model('Csz_sitemap');
        $this->template->setSub('themesdir', directory_map(APPPATH . 'views/templates/', 1, TRUE));
        $this->template->setSub('langdir', directory_map(APPPATH . 'language/', 1, TRUE));
        $this->template->setSub('sitemaptime', $this->Csz_sitemap->getFileTime());
        $this->template->setSub('settings', $this->Csz_admin_model->load_config());
        $this->template->loadSub('admin/settings');
    }

    public function updateSettings() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('site settings');
        admin_helper::is_allowchk('save');
        $res = $this->Csz_admin_model->updateSettings();
        if($res !== FALSE){
            $this->db->cache_delete_all();
            $this->Csz_model->clear_all_cache();
            $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        }else{
            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error_message_alert').'</div>');
        }
        $this->Csz_admin_model->jsredirect($this->csz_referrer->getIndex());
    }
    
    public function uploadIndex() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('file upload');
        //Load the form helper
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        $this->load->helper('form');
        $this->load->library('pagination');
        $search_arr = ' 1=1 ';
        if($this->input->get('search')){
            if($this->input->get('search')){
                $search_arr.= " AND year LIKE '%".$this->input->get('search', TRUE)."%' OR remark LIKE '%".$this->input->get('search', TRUE)."%' OR file_upload LIKE '%".$this->input->get('search', TRUE)."%'";
            }
        }
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->Csz_model->countData('upload_file', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/uploadindex/';
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url, $total_row, $result_per_page, $num_link);
        ($this->uri->segment(3)) ? $pagination = ($this->uri->segment(3)) : $pagination = 0;
        
        $this->template->setSub('showfile', $this->Csz_admin_model->getIndexData('upload_file', $result_per_page, $pagination, 'timestamp_create', 'desc', $search_arr));
        $this->template->loadSub('admin/upload_index');
    }
    
    public function uploadDownload() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('file upload');
        //Load the form helper
        if($this->uri->segment(3)){
            $file = $this->Csz_model->getValue('file_upload', 'upload_file', "upload_file_id", $this->uri->segment(3), 1);
            $path = FCPATH."/photo/upload/".$file->file_upload;
            $this->load->helper('file');
            $data = read_file($path);
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $filename = strtolower(pathinfo($path, PATHINFO_FILENAME));
            $this->load->helper('download');
            force_download($filename.'.'.$ext, $data);
        }else{
            redirect($this->csz_referrer->getIndex(), 'refresh');
        }
    }

    public function uploadIndexSave() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('file upload');
        admin_helper::is_allowchk('save');
        $path = FCPATH . "/photo/upload/";
        $filedel = $this->input->post('filedel');
        if(isset($filedel)){
            admin_helper::is_allowchk('delete');
            foreach ($filedel as $value) {
                if ($value) {
                    $filename = $this->Csz_model->getValue('file_upload', 'upload_file', 'upload_file_id', $value, 1);
                    if($filename->file_upload){
                        @unlink($path . $filename->file_upload);
                    }
                    $this->Csz_admin_model->removeData('upload_file', 'upload_file_id', $value);
                }
            }
        }
        $remark = $this->input->post('remark',TRUE);
        if(isset($remark)){
            foreach ($remark as $key => $value) {
                if ($value && $key) {
                    $this->db->set('remark', $value, TRUE);
                    $this->db->set('timestamp_update', $this->Csz_model->timeNow(), TRUE);
                    $this->db->where('upload_file_id', $key);
                    $this->db->update('upload_file');
                }
            }
        }
        $this->db->cache_delete_all();
        $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }

    public function htmlUpload() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('file upload');
        admin_helper::is_allowchk('save');
        if ($this->uri->segment(3)) {
            $year = $this->uri->segment(3);
        } else {
            $year = date("Y");
        }
        $path = FCPATH . "photo/upload/";
        $files = $_FILES;
        if(!empty($files)){
            $cpt = count($_FILES['files']['name']);
            for($i=0; $i<$cpt; $i++) {   
                if($files['files']['name'][$i]){
                    $file_id = time() . "_" . rand(1111, 9999);
                    $photo_name = $files['files']['name'][$i];
                    $photo = $files['files']['tmp_name'][$i];
                    $file_id1 = $this->Csz_admin_model->file_upload($photo, $photo_name, '', $path, $file_id, '', $year);
                    if ($file_id1) {
                        $this->Csz_admin_model->insertFileUpload($year, $file_id1);
                    }
                }
            }
            $this->db->cache_delete_all();
            $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
        }else{
            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error_message_alert').'</div>');
        }
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }
    
    public function tinyMCEfile() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        //Load the form helper
        $this->load->helper('form');
        $this->load->library('pagination');
        $search_arr = '';
        if($this->input->get('type', TRUE)){
            if($this->input->get('type', TRUE) == 'image'){
                $search_arr.= " file_upload LIKE '%.jpg' OR file_upload LIKE '%.jpeg' OR file_upload LIKE '%.png' OR file_upload LIKE '%.gif' ";
            }else if($this->input->get('type', TRUE) == 'media'){
                $search_arr.= " file_upload LIKE '%.mp4' OR file_upload LIKE '%.flv' OR file_upload LIKE '%.avi' OR file_upload LIKE '%.mov' OR file_upload LIKE '%.m4v' OR file_upload LIKE '%.wmv' ";
            }
        }
        
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->Csz_model->countData('upload_file', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/tinyMCEfile/';

        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url, $total_row, $result_per_page, $num_link);
        ($this->uri->segment(3)) ? $pagination = ($this->uri->segment(3)) : $pagination = 0;
        $data['showfile'] = $this->Csz_admin_model->getIndexData('upload_file', $result_per_page, $pagination, 'timestamp_create', 'desc', $search_arr);
        $data['total_row'] = $total_row;
        $data['core_css'] = $this->Csz_admin_model->coreCss();
        $data['core_js'] = $this->Csz_admin_model->coreJs();
        $this->load->view('admin/tinymce_index', $data);
    }
    
    public function tinyMCEhtmlUpload() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('save');
        $year = date("Y");
        $path = FCPATH . "photo/upload/";
        if(!empty($_FILES)){
            if($_FILES['files']['name']){
                $file_id = time() . "_" . rand(1111, 9999);
                $photo_name = $_FILES['files']['name'];
                $photo = $_FILES['files']['tmp_name'];
                $file_id1 = $this->Csz_admin_model->file_upload($photo, $photo_name, '', $path, $file_id, '', $year);
                if ($file_id1) {
                    $this->Csz_admin_model->insertFileUpload($year, $file_id1, $this->input->post('remark', TRUE));
                    $this->db->cache_delete_all();
                }
                $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
            }
        }else{
            $this->session->set_flashdata('error_message','<div class="alert alert-danger" role="alert">'.$this->lang->line('error_message_alert').'</div>');
        }
        redirect($this->input->post('return_url', TRUE), 'refresh');
    }
    
    public function saveDraft() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('save');
        if(!empty($_POST) && is_array($_POST)){
            $formarr = array();
            $referrer = $this->input->post("current_url");
            foreach ($_POST as $key => $value) {
                if($key && $value && $key != 'csrf_csz' && $key != 'current_url'){
                    if($key == 'content'){
                        $content1 = str_replace('&lt;', '<', $value);
                        $value = str_replace('&gt;', '>', $content1);
                    }
                    $formarr[$key] = $value;
                }
            }
            if(!empty($formarr) && !empty($referrer)){
                $input_data = base64_encode(json_encode($formarr));
                $chk_draft = $this->Csz_model->countData('save_formdraft', "form_url = '".$referrer."'");
                if($chk_draft > 0){
                    $this->db->set('submit_array', $input_data);
                    $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
                    $this->db->where('form_url', $referrer);
                    $this->db->where('user_admin_id', $this->session->userdata('user_admin_id'));
                    $this->db->update('save_formdraft');
                }else{
                    $this->db->set('form_url', $referrer);
                    $this->db->set('submit_array', $input_data);
                    $this->db->set('user_admin_id', $this->session->userdata('user_admin_id'));
                    $this->db->set('timestamp_create', $this->Csz_model->timeNow(), TRUE);
                    $this->db->insert('save_formdraft');
                }       
                $this->db->cache_delete_all();
                echo "SUCCESS";
            }else{
                echo "FAIL";
            }
        }else{
            echo "FAIL";
        }
        exit(1);
    }
    
    public function manifest() {
        $config = $this->Csz_model->load_config();
        ($config->pagecache_time == 0) ? $cache_time = 1 : $cache_time = $config->pagecache_time;
        $expires = 60 * 60 * 24 * 30; // Cache lifetime 30 days
        if(!$this->cache->get('backend_manifest')){      
            $manifest = '{
                "name": "('.$config->site_name.') Backend System",
                "short_name": "CSZCMS Backend",
                "icons": [{
                      "src": "'.base_url('', '', TRUE).'templates/admin/img/cszcms_icon_128.png",
                      "type": "image/png",
                      "sizes": "128x128"
                    }, {
                      "src": "'.base_url('', '', TRUE).'templates/admin/img/cszcms_icon_152.png",
                      "type": "image/png",
                      "sizes": "152x152"
                    }, {
                      "src": "'.base_url('', '', TRUE).'templates/admin/img/cszcms_icon_144.png",
                      "type": "image/png",
                      "sizes": "144x144"
                    }, {
                      "src": "'.base_url('', '', TRUE).'templates/admin/img/cszcms_icon_192.png",
                      "type": "image/png",
                      "sizes": "192x192"
                    },
                    {
                      "src": "'.base_url('', '', TRUE).'templates/admin/img/cszcms_icon_256.png",
                      "type": "image/png",
                      "sizes": "256x256"
                    },
                    {
                      "src": "'.base_url('', '', TRUE).'templates/admin/img/cszcms_icon_512.png",
                      "type": "image/png",
                      "sizes": "512x512"
                    }],
                "start_url": "'.$this->Csz_model->base_link().'/admin",
                "scope": "'.$this->Csz_model->base_link().'",
                "display": "standalone",
                "orientation": "portrait",
                "background_color": "#337ab7",
                "theme_color": "#337ab7",
                "related_applications": [{
                    "platform": "web"
                }],
                "related_applications": [],
                "prefer_related_applications": false
              }';
            
            $this->cache->save('backend_manifest', $manifest, $cache_time);
            unset($manifest);
        }
        header('Content-Type: application/json');
        header("Accept-Ranges: bytes");
	header("Pragma: public; maxage={$expires}");
        header("Expires: " . gmdate ("D, d M Y H:i:s", time() + ($expires)) . " GMT");
        header("Cache-Control: max-age={$expires}");
        header("Cache-Control: public");
        echo $this->cache->get('backend_manifest');
        $this->output->cache($cache_time);
        unset($cache_time, $expires, $config);
	exit(0);
    }
    
    public function serviceWorker() {
        $config = $this->Csz_model->load_config();
        ($config->pagecache_time == 0) ? $cache_time = 1 : $cache_time = $config->pagecache_time;
        $expires = 60 * 60 * 24 * 30; // Cache lifetime 30 days
        if(!$this->cache->get('backend_serviceWorker')){      
            $service = 'var filesToCache = [
                        "'.base_url('', '', TRUE).'/templates/admin",
                        "'.base_url('', '', TRUE).'/assets",
                      ];
                      var staticCacheName = "pages-cache-v1";
                      self.addEventListener("install", function(event) {
                        console.log("Attempting to install service worker and cache static assets");
                        event.waitUntil(
                          caches.open(staticCacheName)
                          .then(function(cache) {
                            return cache.addAll(filesToCache);
                          })
                        );
                      });';            
            $this->cache->save('backend_serviceWorker', $service, $cache_time);
            unset($service);
        }
        header('Content-Type: text/javascript');
        echo $this->cache->get('backend_serviceWorker');
        $this->output->cache($cache_time);
        unset($cache_time, $expires, $config);
	exit(0);
    }
    
     public function returnCountry(){
        $country = [];
        $country = array(
			            "" => "",
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

}
