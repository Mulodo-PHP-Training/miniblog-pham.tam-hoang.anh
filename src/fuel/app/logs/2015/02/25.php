<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2015-02-25 11:24:09 --> 1452 - Cannot add or update a child row: a foreign key constraint fails (`mini_blog`.`post`, CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE) [ INSERT INTO `post` (`title`, `description`, `content`, `image`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('post_4', 'post 4', 'post 4', 'post_4.jpg', 0, '1', '2015-02-25 11:24:09', '2015-02-25 11:24:09') ] in /Applications/MAMP/htdocs/MiniBlog/miniblog-pham.tam-hoang.anh/src/fuel/core/classes/database/mysql/connection.php on line 257
ERROR - 2015-02-25 11:24:47 --> 1452 - Cannot add or update a child row: a foreign key constraint fails (`mini_blog`.`post`, CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE) [ INSERT INTO `post` (`title`, `description`, `content`, `image`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('post_4', 'post 4', 'post 4', 'post_4.jpg', 0, '1', '2015-02-25 11:24:47', '2015-02-25 11:24:47') ] in /Applications/MAMP/htdocs/MiniBlog/miniblog-pham.tam-hoang.anh/src/fuel/core/classes/database/mysql/connection.php on line 257
ERROR - 2015-02-25 11:28:57 --> 1452 - Cannot add or update a child row: a foreign key constraint fails (`mini_blog`.`post`, CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE) [ INSERT INTO `post` (`title`, `description`, `content`, `image`, `user_id`, `status`, `created_at`, `updated_at`) VALUES ('post_4', 'post 4', 'post 4', 'post_4.jpg', 0, '1', '2015-02-25 11:28:57', '2015-02-25 11:28:57') ] in /Applications/MAMP/htdocs/MiniBlog/miniblog-pham.tam-hoang.anh/src/fuel/core/classes/database/mysql/connection.php on line 257
