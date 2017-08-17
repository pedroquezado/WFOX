<?php
	include('define_log.php');

	$page = _view(0);

	switch ($page) {
		case 'page':
			include( WFOX_SITE_THEME . '/page.php');
			break;
		case 'category':
			include( WFOX_SITE_THEME . '/category.php');
			break;

		// PAINEL 
		case 'admin':
			header("Location: " . WFOX_SITE_ADM . '/index.php');
			break;
		case 'login':
			header("Location: " . WFOX_SITE_ADM . '/index.php');
			break;

		// INSTALL 
		case 'install':
			header("Location: ./install.php");
			break;

		// INDEX SITE	
		default:
			if($page){
				if(validPostURL($pdo,$page) == TRUE) {
					$templetaInclude = get_includeTheme($pdo,$page);
					if($templetaInclude != 'none'){
						include( WFOX_SITE_THEME . '/' . $templetaInclude);
					} else {
						update_viewPost( $page );
						include( WFOX_SITE_THEME . '/single.php');
					}
				} else {
					include( WFOX_SITE_THEME . '/404.php');
				}
			} else {
				$search_query = _get( 's' );
				if($search_query){
					include( WFOX_SITE_THEME . '/search.php');
				} else {
					include( WFOX_SITE_THEME . '/index.php');
				}
			}
			break;
	}
?>