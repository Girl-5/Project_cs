<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-06-06 11:25:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'and `form_submission`.`application_id` = 462
ORDER BY `form_field_id` ASC' at line 4 - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = and `form_submission`.`application_id` = 462
ORDER BY `form_field_id` ASC
ERROR - 2023-06-06 11:25:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'and `form_submission`.`application_id` = 462
ORDER BY `form_field_id` ASC' at line 4 - Invalid query: SELECT `form_field`.*, `form_submission`.`form_field_value`
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = and `form_submission`.`application_id` = 462
ORDER BY `form_field_id` ASC
ERROR - 2023-06-06 11:25:54 --> Query error: Column 'form_field_id' in order clause is ambiguous - Invalid query: SELECT *
FROM `form_field`
INNER JOIN `form_submission` ON `form_field`.`form_field_id` = `form_submission`.`form_field_id`
WHERE `form_field`.`form_main_id` = 3 and `form_submission`.`application_id` = 461
ORDER BY `form_field_id` ASC
