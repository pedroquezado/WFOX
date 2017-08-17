<?php
	//LIPA OS ERROS PRINT
	error_reporting(0);

	// INICIA A SESSÃO
	session_start();

	// CAPTURA E LINHA A ETAPA
	$step = strip_tags( filter_input(INPUT_GET, 'step') );

	// DEFINÇÕES: LOCALIZAÇÕES PASTAS
	define('WFOX_BASE_DIR', __DIR__);
	define('WFOX_ADMIN_DIR', WFOX_BASE_DIR . '/wfox-admin');
	define('WFOX_INSTALL_DIR', WFOX_BASE_DIR . '/wfox-install');

	// INCLUDES
	include( WFOX_ADMIN_DIR . '/api/wfox_bd_api.php'); // API FILTRO
	//include( WFOX_ADMIN_DIR . '/api/wfox_bd_user.php'); // API USER
	include( WFOX_INSTALL_DIR . '/wfox-install[header].php'); // HEADER HTML


	// VALIDAÇÃO DA INSTALAÇÃO
	define('WFOX_INSTALL_STATUS', 'TRUE'); // SE "TRUE" INSTALAÇÃO JÁ FOI FEITA, SE "FALSE" PERMITE UMA NOVA INSTALAÇÃO
	installStatus( WFOX_INSTALL_STATUS ); // VERIFICA A "WFOX_INSTALL_STATUS"


	/*
	* GLOBAR PRIMEIRA CONECÇÃO
	*/
	if(isset($_POST['conn']) && $_POST['conn'] == 'connect') { // SE HOUVER PREENCHIMENTO

		// FUNÇÃO CONN
		function tempConectar() {
			try {
				$pdoTemp = new PDO("mysql:host=" . $_POST['host'] . ";dbname=" . $_POST['database'], $_POST['user'] , $_POST['pass'] );
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
			return $pdoTemp;
		}

		$pdoTemp = tempConectar(); // Registra na Variavel

		if(!$pdoTemp){ // Se Não Conectar

			// Página de ERRO
			header("Location: ./install.php?step=erro"); 

		} else { // Se Conectar

			// SALVA VALORES NA SESSION (CONN)
			$_SESSION['temp_host'] 	= _var($_POST['host']); // Servidor do banco de dados
			$_SESSION['temp_db'] 	= _var($_POST['database']); // Nome do Banco de Dados
			$_SESSION['temp_user'] 	= _var($_POST['user']); // Nome de usuário
			$_SESSION['temp_pass'] 	= _var($_POST['pass']); // Senha

			//Valor "temp_prov" que será usuado para proteguer etapas não concluidas
			$_SESSION['temp_prov'] 	= TRUE; 

			// Redireciona para a Página seguinte
			header("Location: ./install.php?step=3&api=pdoTemp");

		}
	}


	// FLUXO DE ETAPAS
	switch ($step) {

		case '1': // ETAPA INICIAL - (INICIALIZAÇÃO DA CONECÇÃO);
			include( WFOX_INSTALL_DIR . '/step/step_1.php' ); // Include HTML
			break;


		case '2': // ETAPA 2 - (FORNECIMENTO DOS DADOS PARA CONECÇÃO DO SERVIDOR);
			include( WFOX_INSTALL_DIR . '/step/step_2.php' );// Include HTML
			break;


		case '3': // ETAPA 3 - (FORNECIMENTO DOS DADOS PARA GERAR ADMIN E DADOS DO SITE);
			if($_SESSION['temp_prov'] == TRUE){ // VALIDA PROTEÇÃO "temp_prov"

				// INCLUDES
				include( WFOX_INSTALL_DIR . '/wfox-install[api].php' ); // INSERE VALORES DO SITE E ADMIN
				include( WFOX_INSTALL_DIR . '/step/step_3.php' ); // Include HTML

			} else { // PÁGINA VALIDADA COMO FALSA

				// Redireciona para a Página anterior
				header("Location: ./install.php?step=2");

			}
			break;


		case 'conn': // ETAPA 4 CONN - (INSTALAÇÃO DOS DADOS NO SISTEMA);
			if($_SESSION['temp_prov'] == TRUE && $_POST['install']){ // VALIDA PROTEÇÃO "temp_prov" e localiza valor "install"

				// SALVA VALORES NA SESSION (SITE DADOS)
				$_SESSION['temp_stitle'] 	= _var($_POST['siteTitle']); // Titulo do site
				$_SESSION['temp_surl'] 		= _var($_POST['siteUrl']); // URL LOCAL DO SITE

				// SALVA VALORES NAS VARIAVEIS (ADMIN);
				$temp_aname		= _var($_POST['nameAdmin']); // Nome do Admin
				$temp_asname	= _var($_POST['snameAdmin']); // Sobrenome do Admin
				$temp_apass		= _var($_POST['passAdmin']); // Senha do Admin
				$temp_aemail	= _var($_POST['emailAdmin']); // Email do Admin

				// INCLUDES
				include( WFOX_INSTALL_DIR . '/wfox-install[api].php' ); // INSERE VALORES DO SITE E ADMIN
				include( WFOX_INSTALL_DIR . '/step/step_4.php' ); // Include HTML (Finalização)

			} else { // PÁGINA VALIDADA COMO FALSA

				// Redireciona para a Página anterior
				header("Location: ./install.php?step=3&error=post_install");

			}
			break;


		case 'erro': // PÁGINA DE ERRO AO ESTABELECER CONECÇÃO;
			include( WFOX_INSTALL_DIR . '/step/step_error.php' ); // Include HTML
			break;


		default: // ETAPA INICIAL - (INICIALIZAÇÃO DA CONECÇÃO);
			include( WFOX_INSTALL_DIR . '/step/step_1.php' ); // Include HTML
			break;
	}

	// INCLUDE
	include( WFOX_INSTALL_DIR . '/wfox-install[footer].php'); // FOOTER HTML
