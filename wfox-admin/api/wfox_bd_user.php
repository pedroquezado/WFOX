<?php
	function validar_newUser($pdo,$email){
		$procurarUser = $pdo->prepare("SELECT * FROM `users` WHERE `u_email`=?");
		$procurarUser->execute(array($email));

		if($procurarUser->rowCount() == 0){
			return '0';
		} else {
			return '1';
		}
	}

	function validar_userID($pdo,$uId){
		$procurarPost = $pdo->prepare("SELECT * FROM `users` WHERE `u_id`=?");
		$procurarPost->execute(array($uId));

		if($procurarPost->rowCount() != 0){
			return '0';
		} else {
			return '1';
		}
	}

	function getThumb($pdo = null,$thumb){
		$pdo = getConnection();

		$procurarThumbOQ = $pdo->prepare("SELECT * FROM `upload_thumb` WHERE `ut_file`=?");
		$procurarThumbOQ->execute(array($thumb));

		$ut_line = $procurarThumbOQ->fetch(PDO::FETCH_ASSOC);
		$ut_ano = $ut_line['ut_ano'];
		$ut_dia = $ut_line['ut_dia'];

		if($ut_dia < '10'){ $ut_dia = '0'.$ut_dia; }
			
		$fileOut = '/uploads/' . $ut_ano . '/' . $ut_dia . '/' . $thumb;
		$filename = WFOX_ADMIN_DIR . $fileOut;

		if (file_exists($filename)) {
			return WFOX_SITE_ADM . $fileOut;
		} else {
			return WFOX_SITE_ADM . '/assets/images/icons/icon-image-type_g.svg';
		}
	}

	function getThumbProfil($pdo,$uid){
		$procurarThumb = $pdo->prepare("SELECT * FROM `users` WHERE `u_id`=?");
		$procurarThumb->execute(array($uid));

		$linha = $procurarThumb->fetch(PDO::FETCH_ASSOC);
		$thumb = $linha['u_thumb'];

		if($thumb == 'default'){
			//SE NÃO TIVER IMAGEM DE PERFIL
			return WFOX_SITE_ADM . '/assets/images/icons/mail/profile_mark.svg';

		} else {
			$procurarThumbOQ = $pdo->prepare("SELECT * FROM `upload_thumb` WHERE `ut_file`=?");
			$procurarThumbOQ->execute(array($thumb));

			$ut_line = $procurarThumbOQ->fetch(PDO::FETCH_ASSOC);
			$ut_ano = $ut_line['ut_ano'];
			$ut_dia = $ut_line['ut_dia'];

			if($ut_dia < '10'){ $ut_dia = '0'.$ut_dia; }
			
			$fileOut = '/uploads/' . $ut_ano . '/' . $ut_dia . '/' . $thumb;
			$filename = WFOX_ADMIN_DIR . $fileOut;

			if (file_exists($filename)) {
			    return WFOX_SITE_ADM . $fileOut;
			} else {
			    return WFOX_SITE_ADM . '/assets/images/icons/mail/profile_mark.svg';
			}
		}
	}

	function getFunctionUser($functionUser){
		switch ($functionUser) {
			case '1':
				return 'Administrador';
				break;
			case '2':
				return 'Editor';
				break;
			case '3':
				return 'Autor';
				break;
		}
	}


	function retornaDadosUser($pdo,$uid,$return){
		$buscarUID = $pdo->prepare("SELECT * FROM `users` WHERE `u_id`=?");
		$buscarUID->execute(array($uid));

		if($buscarUID->rowCount() != 0){
			$linha = $buscarUID->fetch(PDO::FETCH_ASSOC);

			switch ($return) {
				case 'id':
					return $linha['u_id'];
					break;
				case 'fNome':
					return $linha['u_nome'];
					break;
				case 'sNome':
					return $linha['u_sobrenome'];
					break;
				case 'nCompleto':
					return $linha['u_nome'] . ' ' . $linha['u_sobrenome'];
					break;
				case 'email':
					return $linha['u_email'];
					break;
				case 'senha':
					return $linha['u_senha'];
					break;
				case 'thumb':
					return $linha['u_thumb'];
					break;
				case 'role':
					return $linha['u_role'];
					break;
				default:
					return 'ERROR';
					break;
			}
		}
	}

	function delet_user_byID($pdo,$uid){
		$procurarUser = $pdo->prepare("SELECT * FROM `users` WHERE `u_id`=?");
		$procurarUser->execute(array($uid));

		if($procurarUser->rowCount() != 0){
			$deletUserSQL = "DELETE FROM `users` WHERE `u_id`=:u_id";
			$stmt = $pdo->prepare($deletUserSQL);
			$stmt->bindParam(':u_id', $uid, PDO::PARAM_INT);   
			
			if($stmt->execute()){
				echo '1';
				exit();
			} else {
				echo '0'; // RETORNA ERRO
				exit();
			}
		} else {
			echo '0'; // RETORNA ERRO
			exit();
		}
	}

	if(isset($_POST['wfox_api']) && $_POST['wfox_api'] == 'user') {
		$method = $_POST['wfox_form'];

		//REGISTRAR
			if($method == 'add'){
				$u_email 		= $_POST['u_email'];
				$u_nome 		= $_POST['u_nome'];
				$u_sobrenome	= $_POST['u_sobrenome'];
				$u_senha		= md5($_POST['u_senha']);
				$u_role			= $_POST['u_role'];
				$u_data			= date('d-m-Y');
				$u_thumb		= $_POST['u_thumb'];
				
				if(validar_newUser($pdo,$u_email) == '0') {
					$rgt_user = $pdo->prepare("INSERT INTO `users`(u_email,
																   u_nome,
																   u_sobrenome,
																   u_senha,
																   u_role,
																   u_data,
																   u_thumb)
												  		    VALUES(:u_email,
															   	   :u_nome,
															   	   :u_sobrenome,
															   	   :u_senha,
															   	   :u_role,
															   	   :u_data,
															   	   :u_thumb)");
					$rgt_user->bindValue(":u_email",$u_email);
					$rgt_user->bindValue(":u_nome",$u_nome);
					$rgt_user->bindValue(":u_sobrenome",$u_sobrenome);
					$rgt_user->bindValue(":u_senha",$u_senha);
					$rgt_user->bindValue(":u_role",$u_role);
					$rgt_user->bindValue(":u_data",$u_data);
					$rgt_user->bindValue(":u_thumb",$u_thumb);
					
					if($rgt_user->execute()){
						echo '1';
					} else {
						echo '0'; // RETORNA ERRO
					}
				} else {
					echo '0'; // RETORNA ERRO
				}
			}

		//EDIT USER
			if($method == 'edit'){
				$u_id 			= $_POST['u_id'];
				$u_email 		= $_POST['u_email'];
				$u_nome 		= $_POST['u_nome'];
				$u_sobrenome	= $_POST['u_sobrenome'];
				$u_senha		= md5($_POST['u_senha']);
				$u_role			= $_POST['u_role'];
				$u_thumb		= $_POST['u_thumb'];

				if($_POST['u_senha'] == ''){
					$u_senha	= retornaDadosUser($pdo,$u_id,'senha');
				}
				
				$sql = "UPDATE `users` 
						SET u_email = ?,
							u_nome = ?,
							u_sobrenome = ?,
							u_senha = ?,
							u_role = ?,
							u_thumb = ?
						WHERE u_id = ?";
				$editUser = $pdo->prepare($sql);
					
				if($editUser->execute(array($u_email, $u_nome, $u_sobrenome, $u_senha, $u_role, $u_thumb, $u_id))) {
					echo '1';
				} else {
					echo '0'; // RETORNA ERRO
				}
			}

		//DELET-USER
			if($method == 'delet'){
				$idUser_temp = $_POST['id_user'];
				if(isset($idUser_temp) && $idUser_temp != ''){
					if(is_numeric($idUser_temp)){
						if(validar_userID($pdo,$idUser_temp) == 0) {
							delet_user_byID($pdo,$idUser_temp);
						} else {
							echo '0'; // RETORNA ERRO
						}
					} else {
						echo '0'; // RETORNA ERRO
					}
				} else {
					echo '0'; // RETORNA ERRO
				}
			}


		//LOGIN
			if($method == 'login'){

				$tEmail 	= addslashes(trim(str_replace(' ', '', $_POST['tEmail'])));
				$tSenha 		= md5( addslashes(trim(str_replace(' ', '', $_POST['tSenha']))) );

				if($tEmail != '' || $tSenha != ''){
					$validar = $pdo->prepare("SELECT * FROM `users` WHERE `u_email`=?");
					$validar->execute(array($tEmail));

					if($validar->rowCount() != 0){
						//OK
						$linha = $validar->fetch(PDO::FETCH_ASSOC);

						if($tSenha == $linha['u_senha']){
							session_start();
							$_SESSION['user_id'] = $linha['u_id'];

							$sql = "UPDATE `users` SET u_last_login = :data WHERE u_id = :uID";
							$editUser = $pdo->prepare($sql);
							$editUser->bindValue(":data",date('d-m-Y H:i'));
							$editUser->bindValue(":uID",$linha['u_id']);
							$editUser->execute();

							header('Location: ' . WFOX_SITE_ADM );

						} else {
							header('Location: ' . WFOX_SITE_ADM . '/login.php?log=_err03');
						}

					} else { 
						header('Location: ' . WFOX_SITE_ADM . '/login.php?log=_err02');
					}

				} else {
					header('Location: ' . WFOX_SITE_ADM . '/login.php?log=_err01');
				}
			}
	}
?>