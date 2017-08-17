<?php
	/*
	* SISTEMA DE DEFINIÇÕES
	* INSERÇÃO DAS TABELAS
	*/
	if($_SESSION['temp_prov'] == TRUE) {

		// CAPTURA E FILTRA A VERSÃO DO API (GET URL)
		$api = _get( 'api' ); 

		if(isset($api) && $api != ''){ // VALIDA A API

			/*
			* INSTALAÇÃO DA TABELA
			*/

			// FUNÇÃO CONN
			function tempLowConectar() {
				try {
					$pdoLTemp = new PDO("mysql:host=" . $_SESSION['temp_host'] . ";dbname=" . $_SESSION['temp_db'], $_SESSION['temp_user'] , $_SESSION['temp_pass'] );
				} catch(PDOException $e) {
					echo $e->getMessage();
					}
				return $pdoLTemp;
			}
			$pdoLTemp = tempLowConectar(); // Registra na Variavel


			if($api == 'pdoTemp'){ // VERIFICA VERSÃO DO API

				// REGISTRO DE TABELAS
				$sql = file_get_contents( WFOX_INSTALL_DIR . '/sql/wfox-sql.sql'); // Localiza tabelas SQL para registro unico
				try {
				    $stmt = $pdoLTemp->prepare($sql);
				    $stmt->execute(); // EXECUTA AS CRIAÇÃO DAS TABELAS
				} catch (PDOException $e) {
				    echo $e->getMessage();
				    die();
				}

			}

			if($api == 'installWFox'){ // VERIFICA VERSÃO DO API

				// ALTERAR ARQUIVO CONFIG script
				$post1['DBNAME'] = _var( $_SESSION['temp_db'] ); // Servidor do banco de dados
				$post1['DBUSER'] = _var( $_SESSION['temp_user'] ); // Nome do Banco de Dados
				$post1['DBPASS'] = _var( $_SESSION['temp_pass'] ); // Nome de usuário
				$post1['DBHOST'] = _var( $_SESSION['temp_host'] ); // Senha

				$file1 = WFOX_ADMIN_DIR . '/database/config.php';
				$data1 = file($file1);
				$line1 = 0;
				$size1 = count($data1);

				foreach ($post1 as $k => $v) {
				    while ($line1 < $size1) {
				        if (strstr($data1[$line1], '\''.$k.'\'') !== false) {
				            $arr = explode('\'', $data1[$line1]);
				            $arr[3] = $v;

				            $data1[$line1] = implode('\'', $arr);
				            break;
				        }
				        $line1++;
				    }
				}

				
				// ALTERAR ARQUIVO DEFINE LOG script
				$post2['WFOX_SITE_URL']  = _var( $_SESSION['temp_surl'] ); // Titulo do site
				$post2['WFOX_SITE_NAME'] = _var( $_SESSION['temp_stitle'] ); // URL LOCAL DO SITE

				$file2 = WFOX_BASE_DIR . '/define_log.php';
				$data2 = file($file2);
				$line2 = 0;
				$size2 = count($data2);

				foreach ($post2 as $k => $v) {
				    while ($line2 < $size2) {
				        if (strstr($data2[$line2], '\''.$k.'\'') !== false) {
				            $arr = explode('\'', $data2[$line2]);
				            $arr[3] = $v;

				            $data2[$line2] = implode('\'', $arr);
				            break;
				        }
				        $line2++;
				    }
				}

				
				// ALTERAR ARQUIVO INSTALL script
				$postInstall['WFOX_INSTALL_STATUS']  = 'TRUE';
				$fileInstall = WFOX_BASE_DIR . '/install.php';
				$dataInstall = file($fileInstall);
				$lineInstall = 0;
				$sizeInstall = count($dataInstall);

				foreach ($postInstall as $k => $v) {
				    while ($lineInstall < $sizeInstall) {
				        if (strstr($dataInstall[$lineInstall], '\''.$k.'\'') !== false) {
				            $arr = explode('\'', $dataInstall[$lineInstall]);
				            $arr[3] = $v;

				            $dataInstall[$lineInstall] = implode('\'', $arr);
				            break;
				        }
				        $lineInstall++;
				    }
				}

				// REGISTRAR NOVO ADMIN
				$u_email 		= $_POST['emailAdmin'];
				$u_nome 		= $_POST['nameAdmin'];
				$u_sobrenome	= $_POST['snameAdmin'];
				$u_senha		= md5($_POST['passAdmin']);
				$u_role			= '1';
				$u_data			= date('d-m-Y');
		
				$procurarUser = $pdoLTemp->prepare("SELECT * FROM `users` WHERE `u_email`=?");
				$procurarUser->execute(array($u_email));

				if($procurarUser->rowCount() == 0){
					$rgt_user = $pdoLTemp->prepare("INSERT INTO `users`(u_email,
																	    u_nome,
																	    u_sobrenome,
																	    u_senha,
																	    u_role,
																	    u_data)
												  		    	 VALUES(:u_email,
																   	    :u_nome,
																   	    :u_sobrenome,
																   	    :u_senha,
																   	    :u_role,
																   	    :u_data)");
					$rgt_user->bindValue(":u_email",$u_email);
					$rgt_user->bindValue(":u_nome",$u_nome);
					$rgt_user->bindValue(":u_sobrenome",$u_sobrenome);
					$rgt_user->bindValue(":u_senha",$u_senha);
					$rgt_user->bindValue(":u_role",$u_role);
					$rgt_user->bindValue(":u_data",$u_data);
					
					if($rgt_user->execute()){

						file_put_contents($file1, implode('', $data1)); // ALTERAR ARQUIVO CONFIG
						file_put_contents($file2, implode('', $data2)); // ALTERAR ARQUIVO DEFINE LOG
						file_put_contents($fileInstall, implode('', $dataInstall)); // ALTERAR ARQUIVO INSTALL

					} 
					else {
						header("Location: ./install.php?step=3&error=insertUser");
					}
				} else {
					header("Location: ./install.php?step=3&error=emailInstall");
				}

				// COMPLETO
				session_destroy();
			}
		} else {
			header("Location: ../install");
		}

	} else {
		header("Location: ../install");
	}