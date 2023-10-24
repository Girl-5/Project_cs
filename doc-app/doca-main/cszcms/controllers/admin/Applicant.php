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
class Applicant extends CI_Controller {

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

    public function index() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        $this->load->library('pagination');
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        // $search_arr = " user_type = 'admin' ";
        $search_arr.= ' 1=1 ';
        if($this->input->get('search')){
            $search_arr.= ' 1=1 ';
            if($this->input->get('search')){
                $search_arr.= " AND name LIKE '%".$this->input->get('search', TRUE)."%'";
            }
        }
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->Csz_model->countData('applicant', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/applicant/';
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link);     
        ($this->uri->segment(3))? $pagination = $this->uri->segment(3) : $pagination = 0;
        //Get users from database
        
        //$this->template->setSub('applicant', $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr));        
        
        $this->template->setSub('applicant',  $this->Csz_admin_model->getApplicantlist($search_arr));
        
        
        $country = $this->returnCountry();
        $this->template->setSub('country', $country ); 
        $this->template->setSub('total_row', $total_row);       
        //Load the view
        $this->template->loadSub('admin/applicant/index');
    }
  
    //========= FOR ALL APPLICANTS ========  
    public function applicant_profile() {

        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        $this->load->library('pagination');
        $this->db->cache_on();
        $this->csz_referrer->setIndex();
        // $search_arr = " user_type = 'admin' ";
        $search_arr.= '1=1';
        if($this->uri->segment(4) == "completed_profile" ){   ///===  COMPLETED PROFILES
            $search_arr.= ' AND applicant.complete= 1 AND applicant.status = 1';
        }
        if($this->uri->segment(4) == "activated_profiles" ){    ///===  ACTIVATED PROFILES
            $search_arr.= ' AND applicant.complete= 0 AND applicant.status = 1';
        }
        if($this->uri->segment(4) == "inactive_profile" ){    ///=== IN-ACTIVE PROFILES
            $search_arr.= ' AND applicant.complete= 0 AND applicant.status = 0 ';
        }
        // Pages variable
        $result_per_page = 20;
        $total_row = $this->Csz_model->countData('applicant', $search_arr);
        $num_link = 10;
        $base_url = $this->Csz_model->base_link(). '/admin/applicant/applicant_profile/'.$this->uri->segment(4);
        // Pageination config
        $this->Csz_admin_model->pageSetting($base_url,$total_row,$result_per_page,$num_link, $uri_segmentno = 5);     
        ($this->uri->segment(5))? $pagination = $this->uri->segment(5) : $pagination = 0;
        //Get users from database
        //$this->template->setSub('applicant', $this->Csz_admin_model->getIndexData('applicant', $result_per_page, $pagination, 'id', 'DESC', $search_arr));
       //  $this->template->setSub('applicant', $this->Csz_admin_model->getIndexData('applicant', '', '', 'id', 'DESC', $search_arr));        
    
        $this->template->setSub('applicant',  $this->Csz_admin_model->getApplicantlist($search_arr));        
        
        $country = $this->returnCountry();
        $this->template->setSub('country', $country ); 
        $this->template->setSub('total_row', $total_row);       
        //Load the view
        $this->template->loadSub('admin/applicant/applicant_profile');
    }
    

    public function addapplicant() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        //Load the form helper
        $this->load->helper('form');
        //Load the view
        $this->template->loadSub('admin/applicant/add');
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
            $this->addapplicant();
        } else {
            //Validation passed
            //Add the user
            // print_r($this->input->post()); die;
            $rs =$this->Csz_admin_model->createapplicant($id='');
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

    public function editapplicant() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        if($this->Csz_auth_model->is_group_allowed('admin users', 'backend') === FALSE){
            redirect('/admin/applicant', 'refresh');
        }
        //Load the form helper
        $this->load->helper('form');
        if($this->uri->segment(4)){
            $this->db->cache_on();
            $this->db->cache_delete_all();
            //Get user details from database
            $where = 'id='.$this->uri->segment(4);
            $applicant = $this->Csz_model->getValue('*', 'applicant', $where, '', 1);
            if($applicant !== FALSE){
                $this->template->setSub('applicant', $applicant);
                //Load the view
                $this->template->loadSub('admin/applicant/edit');
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
            redirect('/admin/applicant', 'refresh');
        }       
        //Load the form validation library
        $this->load->library('form_validation');
        //Set validation rules
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required');
        // $this->form_validation->set_rules('description', $this->lang->line('description'), 'required');
        $this->form_validation->set_message('required', $this->lang->line('required'));

        if ($this->form_validation->run() == FALSE) {
            //Validation failed
            $this->editapplicant();
        } else {
            //Validation passed
            //Update the user
            $rs = $this->Csz_admin_model->createapplicant($this->uri->segment(4));
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
    

    public function delete() {
        admin_helper::is_logged_in($this->session->userdata('admin_email'));
        admin_helper::is_allowchk('admin users');
        admin_helper::is_allowchk('delete');
        if($this->uri->segment(4)){
                //Delete the user account
                $this->Csz_admin_model->deleteData('applicant',$this->uri->segment(4),'id');
                $this->db->cache_delete_all();
                $this->session->set_flashdata('error_message','<div class="alert alert-success" role="alert">'.$this->lang->line('success_message_alert').'</div>');
           
        }
        //Return to user list
        redirect($this->csz_referrer->getIndex(), 'refresh');
    }

    /*     * ************ Forgotten Password Resets ************* */


}
