<?php
	include('../define_log.php');
	
	$action = _get( 'action' );

	include(WFOX_ADMIN_DIR . '/pages/header.php');

	include(WFOX_ADMIN_DIR . '/pages/login/login_validar.php');

	switch ($action) {
		//POST
		case 'post':
			include(WFOX_ADMIN_DIR . '/pages/post/post.php');
			break;
		case 'posts':
			include(WFOX_ADMIN_DIR . '/pages/post/posts.php');
			break;
		case 'add-post':
			$newLastID = strip_tags( filter_input(INPUT_GET, 'newLastID') );
			if(isset($newLastID) && $newLastID != ''){
				if(is_numeric($newLastID)){
					if(validar_newLastID($pdo,$newLastID) == 0) {
						include(WFOX_ADMIN_DIR . '/pages/post/add-post.php');
					} else {
						include(WFOX_ADMIN_DIR . '/pages/error/error.php');
					}
				} else {
					include(WFOX_ADMIN_DIR . '/pages/error/error.php');
				}
			} else {
				include(WFOX_ADMIN_DIR . '/pages/error/error.php');
			}
			break;
		case 'edit-post':
			$id_post = strip_tags( filter_input(INPUT_GET, 'id_post') );
			if(isset($id_post) && $id_post != ''){
				if(is_numeric($id_post)){
					if(validar_newLastID($pdo,$id_post) == 0) {
						include(WFOX_ADMIN_DIR . '/pages/post/add-post.php');
					} else {
						include(WFOX_ADMIN_DIR . '/pages/error/error.php');
					}
				} else {
					include(WFOX_ADMIN_DIR . '/pages/error/error.php');
				}
			} else {
				include(WFOX_ADMIN_DIR . '/pages/error/error.php');
			}
			break;

		//GALLERY
		case 'gallery':
			include(WFOX_ADMIN_DIR . '/pages/gallery/list.php');
			break;

		//USER
		case 'users':
			include(WFOX_ADMIN_DIR . '/pages/users/list.php');
			break;
		case 'add-user':
			include(WFOX_ADMIN_DIR . '/pages/users/add-user.php');
			break;
		case 'delet-users':
			include(WFOX_ADMIN_DIR . '/pages/users/delet-user.php');
			break;
		case 'user':
			include(WFOX_ADMIN_DIR . '/pages/users/user.php');
			break;
		case 'edit-user':
			$idUser_temp = _get( 'id_user' );
			if(isset($idUser_temp) && $idUser_temp != ''){
				if(is_numeric($idUser_temp)){
					if(validar_userID($pdo,$idUser_temp) == 0) {
						include(WFOX_ADMIN_DIR . '/pages/users/add-user.php');
					} else {
						include(WFOX_ADMIN_DIR . '/pages/error/error.php');
					}
				} else {
					include(WFOX_ADMIN_DIR . '/pages/error/error.php');
				}
			} else {
				include(WFOX_ADMIN_DIR . '/pages/error/error.php');
			}
			break;

		//THEME
		case 'theme':
			include(WFOX_ADMIN_DIR . '/pages/theme/inc.php');
			break;

		//STATUS
		case 'status':
			include(WFOX_ADMIN_DIR . '/pages/status/inc.php');
			break;

		//CONFIG - SITE
		case 'settings':
			include(WFOX_ADMIN_DIR . '/pages/settings/setting.php');
			break;
				
		default:
			include(WFOX_ADMIN_DIR . '/pages/home/dashboard.php');
			break;
	}

	include(WFOX_ADMIN_DIR . '/pages/footer.php');