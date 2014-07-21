CREATE TABLE IF NOT EXISTS `mail_manag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(200) NOT NULL,
  `on_off` tinyint(4) NOT NULL DEFAULT '0',
  `status_send` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=innodb  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `statistics_mail` (
  `id_st` int(11) NOT NULL AUTO_INCREMENT,
  `id_ml` int(11) NOT NULL,
  `data_send` int(11) NOT NULL,
  PRIMARY KEY (`id_st`)
) ENGINE=innodb  DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(90) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=innodb  DEFAULT CHARSET=utf8;