<?php
	if(isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];

		$validar_l = $pdo->prepare("SELECT * FROM `users` WHERE `u_id`=?");
		$validar_l->execute(array($user_id));

		if($validar_l->rowCount() == 0){
			header("Location: " . WFOX_SITE_ADM . '/login.php');
		}
	} else {
		header("Location: " . WFOX_SITE_ADM . '/login.php');
	}
?>