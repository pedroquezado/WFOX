<?php
	function _get( $actionName ) {
		return strip_tags( filter_input(INPUT_GET, $actionName) );
	}

	function _post($actionName) {
		return filter_input(INPUT_POST, $actionName);	
	}

	function _var($actionName) {
		return filter_var($actionName, FILTER_SANITIZE_STRING);
	}

	function _view( $n ){
		$page = _get('view');
		$page = rtrim($page, '/');
		$page = explode('/', $page);

		return $page[$n];
	}

	function tableExists($table) {
		$pdo = getConnection();
		
	    try {
	        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
	    } catch (Exception $e) {
	        return FALSE;
	    }

	    return $result !== FALSE;
	}
	
	function installStatus($status){
		if($status != 'FALSE') {
			header("Location: ./wfox-admin/");
		}
	}

	function return_theme($var) {
		$n = explode("/", $var); // SEPARA OS VALORES PELA BARRA

		return $n[count($n)-1]; 
	}

	function count_posts( $data = null ) {
		$pdo = getConnection();

		$where = 'WHERE `p_visibilidade` = :visbi';
		if( !is_null($data) && $data != '' ){
			$where = 'WHERE `p_data` = :data AND `p_visibilidade` = :visbi';
		}

		$stmt = $pdo->prepare("SELECT * FROM `posts` {$where}");
		if( !is_null($data) && $data != '' ){
			$stmt->bindValue(":data",$data);
		}
		$stmt->bindValue(":visbi",'V');
		$stmt->execute();
		$count_stmt = $stmt->rowCount();

		return $count_stmt;
	}

	function count_categorys( $data = null ) {
		$pdo = getConnection();

		$where = '';
		if( !is_null($data) && $data != '' ){
			$where = 'WHERE `c_data` = :data';
		}

		$stmt = $pdo->prepare("SELECT * FROM `categories` {$where}");
		if( !is_null($data) && $data != '' ){
			$stmt->bindValue(":data",$data);
		}
		$stmt->execute();
		$count_stmt = $stmt->rowCount();

		return $count_stmt;
	}

	function count_users( $data = null ) {
		$pdo = getConnection();

		$where = '';
		if( !is_null($data) && $data != '' ){
			$where = 'WHERE `u_data` = :data';
		}

		$stmt = $pdo->prepare("SELECT * FROM `users` {$where}");
		if( !is_null($data) && $data != '' ){
			$stmt->bindValue(":data",$data);
		}
		$stmt->execute();
		$count_stmt = $stmt->rowCount();

		return $count_stmt;
	}

	function reg_data( $d = null, $mod = null ){
		$dia = date('d');
		if( !is_null($d) && $d != '' ){
			$dia = date('d') - $d;
		}
		$mes = date('m');
		$ano = date('Y');

		$data = mktime(0,0,0,$mes,$dia,$ano);

		$dataFinal = date('d-m-Y',$data);
		if( !is_null($mod) && $d != '' ){
			$dataFinal = date('Y-m-d',$data);
		}

		return $dataFinal;
	}

	function mes_return( $m ){
		switch ($m) {
	        case "01":    $mes = 'Janeiro';     break;
	        case "02":    $mes = 'Fevereiro';   break;
	        case "03":    $mes = 'Março';       break;
	        case "04":    $mes = 'Abril';       break;
	        case "05":    $mes = 'Maio';        break;
	        case "06":    $mes = 'Junho';       break;
	        case "07":    $mes = 'Julho';       break;
	        case "08":    $mes = 'Agosto';      break;
	        case "09":    $mes = 'Setembro';    break;
	        case "10":    $mes = 'Outubro';     break;
	        case "11":    $mes = 'Novembro';    break;
	        case "12":    $mes = 'Dezembro';    break; 
	 	}
	 
	 	return $mes;
	}

	function comment_titlePage() {
		$ap = WFOX_SITE_THEME . '/'; // PASTAS DO TEMA ATUAL

		if (is_dir($ap)) {
			// ABERTUR DA PASTA
	        $dh = opendir($ap);

	        if ($dh) {
				$arquivos = glob("$ap{*.php}", GLOB_BRACE);

				$mArray = array();
				foreach($arquivos as $php){
					$re = '/\<\?php\r\n\/\*\r\n(.*[A-z_])\r\n\*\//is';
					$str = file_get_contents($php);

					preg_match_all($re, $str, $matches);

					$return_matches = $matches[1][0];
					$loop_matches = preg_split("[File Name: ]",$return_matches);
					$mArray[return_theme($php)] = $loop_matches[1];
				}

				return $mArray;

	        }
		}
	}

	if(isset($_POST['wfox_api']) && $_POST['wfox_api'] == 'config') {
		$method = $_POST['wfox_form'];

		//CONFIGURAÇÃO GERAL
			if($method == 'geral'){
				// ATUALIZAÇÃO
				if($_POST['s_endereco'] != '') { $postSetting['WFOX_SITE_URL'] = $_POST['s_endereco']; }
				if($_POST['s_nome'] != '') { $postSetting['WFOX_SITE_NAME'] = _var( $_POST['s_nome'] ); }
				if($_POST['s_resumo'] != '') { $postSetting['WFOX_SITE_RESUMO'] = _var( $_POST['s_resumo'] ); }
				if($_POST['s_idioma'] != '') { $postSetting['WFOX_SITE_IDIOMA'] = _var( $_POST['s_idioma'] ); }
				if($_POST['s_postbypage'] != '') { $postSetting['WFOX_SITE_TOTALPAGE'] = _var( $_POST['s_postbypage'] ); }

				$fileSetting = WFOX_BASE_DIR . '/define_log.php';
				$dataSetting = file($fileSetting);
				$lineSetting = 0;
				$sizeSetting = count($dataSetting);

				foreach ($postSetting as $k => $v) {
				    while ($lineSetting < $sizeSetting) {
				        if (strstr($dataSetting[$lineSetting], '\''.$k.'\'') !== false) {
				            $arr = explode('\'', $dataSetting[$lineSetting]);
				            $arr[3] = $v;

				            $dataSetting[$lineSetting] = implode('\'', $arr);
				            break;
				        }
				        $lineSetting++;
				    }
				}

				file_put_contents($fileSetting, implode('', $dataSetting));

				header("Location: " . WFOX_SITE_ADM . '/index.php?action=settings');
			}

		//CONFIGURAÇÃO TEMA
			if($method == 'theme'){
				$postSetting['WFOX_SITE_THEME'] = $_POST['WFOX_SITE_THEME'];

				$fileSetting = WFOX_BASE_DIR . '/define_log.php';
				$dataSetting = file($fileSetting);
				$lineSetting = 0;
				$sizeSetting = count($dataSetting);

				foreach ($postSetting as $k => $v) {
				    while ($lineSetting < $sizeSetting) {
				        if (strstr($dataSetting[$lineSetting], '\''.$k.'\'') !== false) {
				            $arr = explode('\'', $dataSetting[$lineSetting]);
				            $arr[3] = $v;

				            $dataSetting[$lineSetting] = implode('\'', $arr);
				            break;
				        }
				        $lineSetting++;
				    }
				}

				file_put_contents($fileSetting, implode('', $dataSetting));

				header("Location: " . WFOX_SITE_ADM . '/index.php?action=theme');
			}

		//CONFIGURAÇÃO TEMA
			if($method == 'function'){
				$functionReturn = $_POST['functiosStatus'];

				$functiosStatus = $pdo->prepare("SELECT * FROM `functions` WHERE `f_name`=?");
				$functiosStatus->execute(array($functionReturn));

				if($functiosStatus->rowCount() == 0){
					$rgt_function = $pdo->prepare("INSERT INTO `functions`(f_name,
																		   f_status)
												  				    VALUES(:f_name,
																	   	   :f_status)");
					$rgt_function->bindValue(":f_name",$functionReturn);
					$rgt_function->bindValue(":f_status",'1');
					
					if($rgt_function->execute()){
						header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func_on='. $functionReturn .'&status=INSERT');
					} else {
						header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func_on='. $functionReturn .'&status=ERROR_INSERT');
					}

				} else {
					$linha = $functiosStatus->fetch(PDO::FETCH_ASSOC);
					$f_status = $linha['f_status'];

					if ($f_status == '1') {
						$sql = "UPDATE `functions` SET f_status = ? WHERE f_name = ?";
						$addPost = $pdo->prepare($sql);
						
						if($addPost->execute(array('0', $functionReturn))) {
							header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func_on='. $functionReturn .'&status=UPDATE_0');
						} else {
							header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func_on='. $functionReturn .'&status=ERROR_UPDATE_0');
						}

					} else {
						$sql = "UPDATE `functions` SET f_status = ? WHERE f_name = ?";
						$addPost = $pdo->prepare($sql);
						
						if($addPost->execute(array('1', $functionReturn))) {
							header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func_on='. $functionReturn .'&status=UPDATE_1');
						} else {
							header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func_on='. $functionReturn .'&status=ERROR_UPDATE_1');
						}

					}
				}

			}

	}
?>