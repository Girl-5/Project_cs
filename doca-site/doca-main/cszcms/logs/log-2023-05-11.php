<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-05-11 12:03:27 --> Could not find the language line "description"
ERROR - 2023-05-11 12:03:53 --> Could not find the language line "title"
ERROR - 2023-05-11 12:03:53 --> Query error: Unknown column 'project_summary_form_id' in 'field list' - Invalid query: UPDATE `grant` SET `title` = 'Project Support Doc Organisations', `description` = 'DocA will provide project support to documentary organisations working within the continent. This may include funding to develop, execute, monitor, and evaluate projects throughout: Training (workshops, residencies, labs), Mentorships, festivals and but not limited to film markets.', `eligibility` = 'i. Comprehensive narrative reports on results and deliverables achieved; and on the impact on the targeted film communities.\r\nii. Comprehensive financial reports. ', `grant_type` = '3', `description_type` = '4', `contract` = '1', `startDate` = '2021-03-10', `endDate` = '2021-05-14', `project_summary_form_id` = '3', `project_description_form_id` = '2', `active` = 1, `image` = '2021/1615329070_1-org.jpg'
WHERE `id` = '23'
ERROR - 2023-05-11 12:13:00 --> Could not find the language line "description"
ERROR - 2023-05-11 12:13:13 --> Could not find the language line "title"
ERROR - 2023-05-11 12:13:13 --> Query error: Unknown column 'project_summary_form_id' in 'field list' - Invalid query: UPDATE `grant` SET `title` = 'Project Support Doc Organisations', `description` = 'DocA will provide project support to documentary organisations working within the continent. This may include funding to develop, execute, monitor, and evaluate projects throughout: Training (workshops, residencies, labs), Mentorships, festivals and but not limited to film markets.', `eligibility` = 'i. Comprehensive narrative reports on results and deliverables achieved; and on the impact on the targeted film communities.\r\nii. Comprehensive financial reports. ', `grant_type` = '3', `description_type` = '4', `contract` = '1', `startDate` = '2021-03-10', `endDate` = '2021-05-14', `project_summary_form_id` = '4', `project_description_form_id` = '2', `active` = 1, `image` = '2021/1615329070_1-org.jpg'
WHERE `id` = '23'
ERROR - 2023-05-11 12:13:18 --> Could not find the language line "description"
ERROR - 2023-05-11 12:19:58 --> Could not find the language line "title"
ERROR - 2023-05-11 12:20:01 --> Could not find the language line "description"
ERROR - 2023-05-11 12:32:19 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 456
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 12:32:19 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 456
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:38:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') (`form_main_id`, `form_field_id`, `form_field_name`, `application_id`) VALU...' at line 1 - Invalid query: INSERT INTO form_submission) (`form_main_id`, `form_field_id`, `form_field_name`, `application_id`) VALUES ('3', 'project_title', 'test_field', 457)
ERROR - 2023-05-11 13:38:55 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 457
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:38:55 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 457
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:42:14 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 458
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:42:14 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 458
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:43:48 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 459
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:43:48 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 459
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:44:36 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:44:36 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:46:00 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:46:00 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
LEFT JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:47:07 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:47:07 --> Query error: Column 'form_main_id' in where clause is ambiguous - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:47:46 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 13:51:32 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:32:40 --> Severity: error --> Exception: syntax error, unexpected token "}" C:\xampp\htdocs\appdata\cszcms\controllers\Grant_apply.php 203
ERROR - 2023-05-11 14:37:04 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:38:18 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:38:36 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:38:38 --> Query error: Unknown column 'grant_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `grant_id` = '23'
AND `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:38:38 --> Could not find the language line "error"
ERROR - 2023-05-11 14:38:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:38:47 --> Query error: Unknown column 'grant_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project Edited'
WHERE `grant_id` = '23'
AND `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:38:47 --> Could not find the language line "error"
ERROR - 2023-05-11 14:38:47 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:40:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:40:46 --> Query error: Unknown column 'grant_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project Edited'
WHERE `grant_id` = '23'
AND `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:40:46 --> Could not find the language line "error"
ERROR - 2023-05-11 14:40:46 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:42:40 --> Query error: Unknown column 'grant_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project Edited'
WHERE `grant_id` = '23'
AND `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:43:10 --> Query error: Unknown column 'grant_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = NULL
WHERE `grant_id` = '23'
AND `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:43:10 --> Could not find the language line "error"
ERROR - 2023-05-11 14:43:10 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:43:23 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:43:25 --> Query error: Unknown column 'grant_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `grant_id` = '23'
AND `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:43:25 --> Could not find the language line "error"
ERROR - 2023-05-11 14:43:25 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:44:38 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:44:38 --> Could not find the language line "error"
ERROR - 2023-05-11 14:44:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:44:40 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:44:40 --> Could not find the language line "error"
ERROR - 2023-05-11 14:44:40 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:44:46 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:44:48 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:44:48 --> Could not find the language line "error"
ERROR - 2023-05-11 14:44:48 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:45:13 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:45:13 --> Could not find the language line "error"
ERROR - 2023-05-11 14:45:13 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:45:18 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:45:20 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:45:20 --> Could not find the language line "error"
ERROR - 2023-05-11 14:45:20 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:46:09 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:46:18 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:46:23 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project Edited'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:46:33 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:46:39 --> Query error: Unknown column 'user_id' in 'where clause' - Invalid query: UPDATE `form_submission` SET `form_field_value` = 'The Test Project Edited'
WHERE `application_id` = '460'
AND `form_main_id` = '3'
AND `user_id` = '1127'
ERROR - 2023-05-11 14:48:34 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:48:45 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:49:47 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 14:49:54 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:03:37 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:05:30 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:06:35 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:35:53 --> Severity: error --> Exception: Unmatched ')' C:\xampp\htdocs\appdata\cszcms\views\front\project_description_new.php 6
ERROR - 2023-05-11 15:51:47 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:52:13 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 460
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:52:28 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:52:56 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:53:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:53:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:55:18 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:55:18 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:55:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:55:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:59:54 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 15:59:54 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:00:03 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:00:03 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:00:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:00:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:03:01 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:03:01 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:03:37 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:03:37 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:04:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:04:38 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:05:13 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:05:13 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:06:12 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:07:33 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:08:12 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:09:05 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:09:09 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:09:21 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:02 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:02 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:17 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:17 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:42 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:52 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:10:52 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:14:51 --> Query error: Column 'grant_id' cannot be null - Invalid query: INSERT INTO `application` (`grant_id`, `user_id`) VALUES (NULL, '1127')
ERROR - 2023-05-11 16:14:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'and `form_submission`.`application_id` IS NULL
ORDER BY `form_field_id` ASC' at line 4 - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = and `form_submission`.`application_id` IS NULL
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:14:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'and `form_submission`.`application_id` IS NULL
ORDER BY `form_field_id` ASC' at line 4 - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = and `form_submission`.`application_id` IS NULL
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:15:33 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:15:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
ERROR - 2023-05-11 16:15:39 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 2 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
