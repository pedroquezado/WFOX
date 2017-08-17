-- INSTALL SQL WFOX
CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_nome` varchar(100) NOT NULL,
  `c_data` varchar(50) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_titulo` varchar(200) NOT NULL,
  `p_stitulo` varchar(300) NOT NULL,
  `p_desc` longtext NOT NULL,
  `p_visibilidade` enum('V','P','R') NOT NULL DEFAULT 'R',
  `p_data` varchar(60) NOT NULL,
  `p_hora` varchar(20) NOT NULL,
  `p_link` varchar(400) NOT NULL,
  `p_uid` int(11) NOT NULL,
  `p_view` int(200) NOT NULL,
  `p_template` varchar(250) NOT NULL DEFAULT 'none',
  `p_thumb` varchar(300) NOT NULL DEFAULT 'default',
  `p_type` enum('post','page') NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `post_categories` (
  `pc_id` int(11) NOT NULL AUTO_INCREMENT,
  `pc_post_id` int(11) NOT NULL,
  `pc_cat_id` int(11) NOT NULL,
  PRIMARY KEY (`pc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `post_tags` (
  `pt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_post_id` int(11) NOT NULL,
  `pt_tag_id` int(11) NOT NULL,
  PRIMARY KEY (`pt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tags` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_nome` varchar(200) NOT NULL,
  `t_data` varchar(50) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `upload_thumb` (
  `ut_id` int(30) NOT NULL AUTO_INCREMENT,
  `ut_file` varchar(200) NOT NULL,
  `ut_name` varchar(200) DEFAULT 'Sem títuloSem t&#237;tulo',
  `ut_ano` int(11) NOT NULL,
  `ut_dia` int(11) NOT NULL,
  `ut_data_upload` varchar(50) NOT NULL,
  PRIMARY KEY (`ut_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_email` varchar(150) NOT NULL,
  `u_senha` varchar(60) NOT NULL,
  `u_nome` varchar(50) NOT NULL,
  `u_sobrenome` varchar(50) NOT NULL,
  `u_thumb` varchar(200) NOT NULL,
  `u_role` enum('1','2','3') NOT NULL,
  `u_data` varchar(100) NOT NULL,
  `u_last_login` varchar(100) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `functions` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(100) NOT NULL,
  `f_status` enum('0','1') NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `meta` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(50) NOT NULL,
  `m_value` varchar(500) NOT NULL,
  `m_private` int(1) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

INSERT INTO `meta` (`m_id`, `m_name`, `m_value`, `m_private`) VALUES
(1, 'description', '', 1),
(2, 'news_keywords', '', 1),
(3, 'original-source', '', 1),
(4, 'canonical', '', 1),
(5, 'publisher', '', 1),
(6, 'og:locale', '', 1),
(7, 'og:type', '', 1),
(8, 'og:title', '', 1),
(9, 'og:description', '', 1),
(10, 'og:url', '', 1),
(11, 'og:site_name', '', 1),
(12, 'og:image', '', 1),
(13, 'og:image:width', '', 1),
(14, 'og:image:height', '', 1),
(15, 'article:publisher', '', 1),
(16, 'article:author', '', 1),
(17, 'fb:app_id', '', 1),
(18, 'fb:admins', '', 1),
(19, 'fb:page_id', '', 1),
(20, 'twitter:card', '', 1),
(21, 'twitter:description', '', 1),
(22, 'twitter:title', '', 1),
(23, 'twitter:site', '', 1),
(24, 'twitter:image', '', 1),
(25, 'twitter:creator', '', 1),
(26, 'twitter:app:country', '', 1),
(27, 'twitter:app:name:iphone', '', 1),
(28, 'twitter:app:id:iphone', '', 1),
(29, 'twitter:app:name:ipad', '', 1),
(30, 'app:id:ipad', '', 1),
(31, 'twitter:app:name:googleplay', '', 1),
(32, 'twitter:app:id:googleplay', '', 1);