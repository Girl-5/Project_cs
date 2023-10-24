<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-05-15 00:04:55 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('315', '11', NULL, '2021/1621026295_1.pdf')
ERROR - 2021-05-15 00:12:15 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('201', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 00:15:34 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('115', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 00:27:49 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('363', '11', NULL, '2021/1621027669_1.pdf')
ERROR - 2021-05-15 00:27:49 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('363', '13', NULL, '')
ERROR - 2021-05-15 00:27:49 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('363', '14', NULL, '')
ERROR - 2021-05-15 00:41:46 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('283', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 01:12:49 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('408', '11', NULL, '2021/1621030369_1.docx')
ERROR - 2021-05-15 01:15:50 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('283', '11', NULL, '2021/1621030550_1.pdf')
ERROR - 2021-05-15 01:33:17 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('115', '11', NULL, '2021/1621031597_1.pdf')
ERROR - 2021-05-15 01:37:54 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('400', '11', NULL, '2021/1621031874_1.pdf')
ERROR - 2021-05-15 01:54:14 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('409', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 02:06:38 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('409', '11', NULL, '2021/1621033598_1-org.jpg')
ERROR - 2021-05-15 02:52:28 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('411', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 03:22:54 --> Query error: Column 'answer' cannot be null - Invalid query: INSERT INTO `contract_save` (`application_id`, `contract_id`, `answer`, `upload_file`) VALUES ('411', '11', NULL, '2021/1621038174_1.docx')
ERROR - 2021-05-15 10:52:24 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('377', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 12:03:32 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('401', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 13:32:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `grant` ON `grant`.`grant_id` = `applicant`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
ERROR - 2021-05-15 13:32:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `grant` ON `grant`.`grant_id` = `applicant`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
ERROR - 2021-05-15 13:36:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:36:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:36:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:36:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:36:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:36:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN' at line 1 - Invalid query: SELECT applicant.* GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:37:29 --> Query error: Column 'complete' in where clause is ambiguous - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:37:29 --> Query error: Column 'complete' in where clause is ambiguous - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:37:33 --> Query error: Column 'complete' in where clause is ambiguous - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:37:33 --> Query error: Column 'complete' in where clause is ambiguous - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `complete` =0 AND `status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:41:45 --> Query error: Unknown column 'applicant.user_id' in 'on clause' - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:41:45 --> Query error: Unknown column 'applicant.user_id' in 'on clause' - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grantname
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:42:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applica' at line 1 - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grant.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:42:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applica' at line 1 - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grant.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:43:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applica' at line 1 - Invalid query: SELECT `applicant`.`id`, `applicant`.`name`, GROUP_CONCAT(grant.title SEPARATOR ", ") as grant.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:43:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applica' at line 1 - Invalid query: SELECT `applicant`.`id`, `applicant`.`name`, GROUP_CONCAT(grant.title SEPARATOR ", ") as grant.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 13:45:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applica' at line 1 - Invalid query: SELECT `applicant`.*, GROUP_CONCAT(grant.title SEPARATOR ", ") as grant.title
FROM `applicant`
LEFT JOIN `application` ON `application`.`id` = `applicant`.`user_id`
LEFT JOIN `grant` ON `grant`.`grant_id` = `application`.`grant_id`
WHERE 1 = 1 AND `applicant`.`complete` =0 AND `applicant`.`status` = 1
GROUP BY `applicant`.`id`
ERROR - 2021-05-15 14:10:45 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('262', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 20:21:12 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('412', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
ERROR - 2021-05-15 21:50:24 --> Query error: Column 'organization_name' cannot be null - Invalid query: INSERT INTO `organization` (`application_id`, `organization_name`, `organization_date`, `organization_registration`, `organization_pays`, `organization_region`, `organization_address`, `organization_code`, `organization_city`, `organization_number`, `organization_email`, `organization_web`) VALUES ('262', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
