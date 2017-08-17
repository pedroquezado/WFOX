<?php
	$ap = WFOX_FUNCTIONS_DIR; // PASTAS DE FUNÇÕES
	$dir = '/';

	if (is_dir($ap . $dir)) {

		// ABERTUR DA PASTA
        $dh = opendir($ap . $dir);

		if ($dh) {

        	while (($file = readdir($dh)) !== false) {

        		if ($file === '.' || $file === '..') {
        		    continue;
        		}

        		// PASTA DA FUNÇÃO LISTADA
        		$atual = $ap . $dir . $file;
        		$nameAtual = return_theme($atual);

        		$functiosStatus = $pdo->prepare("SELECT * FROM `functions` WHERE `f_name`=?");
				$functiosStatus->execute(array($nameAtual));
				$linha = $functiosStatus->fetch(PDO::FETCH_ASSOC);
				$f_status = $linha['f_status'];

				if($f_status == '1') {
					include( WFOX_FUNCTIONS_DIR . '/' . $nameAtual . '/func.php');
				}
        	}

        }
	}
?>