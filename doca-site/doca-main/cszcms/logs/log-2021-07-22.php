<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-07-22 06:14:18 --> Severity: error --> Exception: Call to undefined function form_open_multipart() /home/document/grants.documentaryafrica.org.documentaryafrica.org/cszcms/views/admin/home.php 86
ERROR - 2021-07-22 06:15:00 --> Severity: error --> Exception: Call to undefined function form_open() /home/document/grants.documentaryafrica.org.documentaryafrica.org/cszcms/views/admin/home.php 86
ERROR - 2021-07-22 06:20:21 --> Severity: error --> Exception: Call to undefined function form_open() /home/document/grants.documentaryafrica.org.documentaryafrica.org/cszcms/views/admin/home.php 88
ERROR - 2021-07-22 06:43:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'where (YEAR(addon) = 2021)
                                    from applicant' at line 9 - Invalid query: select 
                                    sum(case when (status=1 AND complete = 1 and YEAR(addon) = 2021) then 1 else 0 end) as completed_profile, 
                                    sum(case when (status=1 AND complete = 0 and YEAR(addon) = 2021) then 1 else 0 end) as activated_profiles, 
                                    sum(case when (status=0 AND complete = 0 and YEAR(addon) = 2021) then 1 else 0 end) as inactive_profile, 
                                    sum(case when (gender = 1 AND complete = 1 and YEAR(addon) = 2021) then 1 else 0 end) as male_g, 
                                    sum(case when (gender = 2 AND complete = 1 and YEAR(addon) = 2021) then 1 else 0 end) as female_g, 
                                    sum(case when (gender = 3 AND complete = 1 and YEAR(addon) = 2021) then 1 else 0 end) as non_binary,  
                                    sum(case when (gender = 4 AND complete = 1 and YEAR(addon) = 2021) then 1 else 0 end) as rather_not_say, 
                                    COUNT(*) as total_applicant where (YEAR(addon) = 2021)
                                    from applicant
ERROR - 2021-07-22 06:43:06 --> Severity: error --> Exception: Call to a member function row_array() on bool /home/document/grants.documentaryafrica.org.documentaryafrica.org/cszcms/models/Csz_admin_model.php 223
