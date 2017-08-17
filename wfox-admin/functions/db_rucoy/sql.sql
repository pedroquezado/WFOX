CREATE TABLE IF NOT EXISTS `ro_arma` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_image` varchar(200) NOT NULL,
  `a_nome` varchar(200) NOT NULL,
  `a_att` varchar(200) NOT NULL,
  `a_bnpc` varchar(200) NOT NULL,
  `a_snpc` varchar(200) NOT NULL,
  `a_drop` varchar(200) NOT NULL,
  `a_type` enum('1','2','3') NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ro_bosses` (
  `b_id` int(11) NOT NULL,
  `b_image` varchar(200) NOT NULL,
  `b_nome` varchar(200) NOT NULL,
  `b_cn` varchar(350) NOT NULL,
  `b_drop` varchar(350) NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ro_criaturas` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_image` varchar(200) NOT NULL,
  `c_nome` varchar(200) NOT NULL,
  `c_leve` int(50) NOT NULL,
  `c_hp` int(50) NOT NULL,
  `c_xp` int(50) NOT NULL,
  `c_drop` varchar(100) NOT NULL,
  `c_spawn` int(20) NOT NULL,
  `c_desc` mediumtext NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ro_maps` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_image` varchar(200) NOT NULL,
  `m_nome` varchar(200) NOT NULL,
  `m_desc` longtext NOT NULL,
  `m_type` varchar(100) NOT NULL,
  `m_monster` varchar(200) NOT NULL,
  `m_npcs` varchar(200) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;