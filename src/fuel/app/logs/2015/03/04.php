<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2015-03-04 04:37:55 --> 1054 - Unknown column 'comment.created_at' in 'order clause' [ SELECT COUNT(DISTINCT `t0`.`id`) AS count_result FROM `post` AS `t0` WHERE `t0`.`user_id` = '10' AND `t0`.`status` = 1 ORDER BY `comment`.`created_at` DESC, `t0`.`created_at` DESC ] in /Applications/MAMP/htdocs/MiniBlog/miniblog-pham.tam-hoang.anh/src/fuel/core/classes/database/mysql/connection.php on line 257
