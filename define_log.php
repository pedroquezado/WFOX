<?php
	error_reporting(0);
	session_start();
	if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != ''): $user_id = $_SESSION['user_id']; endif;
	date_default_timezone_set('America/Fortaleza');

	ini_set('default_charset', 'utf-8');

	define('WFOX_STATS', '');

	define('WFOX_BASE_DIR', __DIR__);
	define('WFOX_SITE_DIR', WFOX_BASE_DIR . '/wfox-content');
	define('WFOX_ADMIN_DIR', WFOX_BASE_DIR . '/wfox-admin');
	define('WFOX_FUNCTIONS_DIR', WFOX_ADMIN_DIR . '/functions');
	define('WFOX_INSTALL_DIR', WFOX_BASE_DIR . '/wfox-install');

	define('WFOX_SITE_URL', '');
	define('WFOX_SITE_ADM', WFOX_SITE_URL . '/wfox-admin');
	define('WFOX_SITE_CONTENT', WFOX_SITE_URL . '/wfox-content');
	define('WFOX_SITE_FUNCTIONS', WFOX_SITE_ADM . '/functions');
	define('WFOX_SITE_THEME', WFOX_SITE_DIR . '/collony');
	
	define('WFOX_SITE_NAME', '');
	define('WFOX_SITE_RESUMO', '');
	define('WFOX_SITE_IDIOMA', '');

	include( WFOX_ADMIN_DIR . '/database/conn.php');
	include( WFOX_ADMIN_DIR . '/api/wfox_bd_api.php');
	include( WFOX_ADMIN_DIR . '/api/wfox_bd_post.php');
	include( WFOX_ADMIN_DIR . '/api/wfox_bd_user.php');
	include( WFOX_ADMIN_DIR . '/api/wfox_bd_upload.php');
	include( WFOX_ADMIN_DIR . '/api/wfox_stats_chart.php');

	// NEW FUNCTIONS - ** by USER **
	include( WFOX_ADMIN_DIR . '/funtions.php');


	// FUNCTIONS BLOG
	include( WFOX_ADMIN_DIR . '/api/wfox_theme.php');

	define('WFOX_SITE_FTHEME', WFOX_SITE_CONTENT . '/' . return_theme( WFOX_SITE_THEME ));
	define('WFOX_SITE_TOTALPAGE', '5');
