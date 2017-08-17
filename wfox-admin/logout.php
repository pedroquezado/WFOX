<?php
	include('../define_log.php');
	session_destroy();
	header("Location: " . WFOX_SITE_ADM . '/index.php');
?>