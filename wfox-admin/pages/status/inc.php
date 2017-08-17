<?php 
    if(_get( 'func' )){ 
        $functiosStatus = $pdo->prepare("SELECT * FROM `functions` WHERE `f_name`=?");
        $functiosStatus->execute(array(_get( 'func' )));

        if($functiosStatus->rowCount() != 0) {
            $linha = $functiosStatus->fetch(PDO::FETCH_ASSOC);
            $f_status = $linha['f_status'];

            if($f_status == '1') {
?>

            <div class="pBox-right float-r">
                <div class="boxPost-newElement">
                    <?php include( WFOX_FUNCTIONS_DIR . '/' . _get( 'func' ) . '/index.php'); ?>
                </div>
            </div>

<?php 
            } else {
                include(WFOX_ADMIN_DIR . '/pages/error/error.php');
            }
        } else {
            include(WFOX_ADMIN_DIR . '/pages/error/error.php');
        }
    } else { 
?>

<div class="boxElement-right float-r">
    <div class="beThemesModal">
    <?php
    	$ap = WFOX_FUNCTIONS_DIR; // PASTAS DE TEMAS
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

                    // ARQUIVO 'function.txt' DA FUNÇÃO LISTADA
    				$function = $ap . $dir . $file . '/function.txt';

                    // ARQUIVO 'bg.jpg' A FUNÇÃO LISTADA
                    $background = $ap . $dir . $file . '/bg.jpg';

                    // PRE DEFINIÇÃO 'WFOX_SITE_THEME' >> FORM POST
                    $sur_function = '/' . $file;

                    $functiosStatus = $pdo->prepare("SELECT * FROM `functions` WHERE `f_name`=?");
                    $functiosStatus->execute(array($nameAtual));
                    $linha = $functiosStatus->fetch(PDO::FETCH_ASSOC);
                    $f_status = $linha['f_status'];


                    // SE O THEMA DO WFOX NÃO FOR IGUAL AO THEMA LISTADO
                    if($f_status != '1') {
                        $selectTheme = 'Ativar';
                        $sClass = '';

                    // CASO SEJA IGUAL
                    } else { 
                        $selectTheme = 'Desativar'; 
                        $sClass = 'noSelectTheme';
                    }
                    

                    // SE NÃO EXISTIR O ARQUIVO 'bg.jpg' DO THEMA LISTADO
                    if(!file_exists($background)){
                        $lbackground = WFOX_SITE_ADM . '/assets/images/bg.jpg';

                    // CASO EXISTA
                    } else {
                        $lbackground = WFOX_SITE_FUNCTIONS . $dir . $file . '/bg.jpg';
                    }
                    

    				if (is_dir($atual)) { // SE HOUVER ACESSO

    					if (file_exists($function)) { // O ARQUIVO EXISTIR
    						$linhas = fopen ($function, "r");
    ?>
                            <div class="themeFille">
                                <div class="tfImg" style="background-image: url(<?php echo $lbackground; ?>);"></div>
                                <div class="tfDesc">
                                    <div class="cnh-drow">
                                        <div class="linesHit">						 
    <?php
    						while (!feof ($linhas)) {
    							$ponteiro = fgets($linhas, 4096);
    							$valores = preg_split("[: ]",$ponteiro);
                                echo '<div class="mBottom-5">';
                                echo '<p class="labelForDescLine">' . $valores[0] . '</p>';
                                echo '<p class="descLinesTheme">' . $valores[1] . '</p>';
                                echo '</div>';
                            }

                            if($f_status == '1') {
                                echo '<a href="./index.php?action=status&func='. $nameAtual .'">Abrir</a>';
                            }
    ?>
                                            <form method="post" action="<?php echo WFOX_SITE_URL; ?>/define_log.php">
                                                <?php echo '<input type="submit" class="'.$sClass.' selectTheme" name="selectFunction" value="'.$selectTheme.'">'; ?>
                                                <input type="hidden" name="wfox_api" value="config">
                                                <input type="hidden" name="wfox_form" value="function">
                                                <input type="hidden" name="functiosStatus" value="<?php echo $nameAtual; ?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>                     
                            </div>
    <?php
    						fclose ($linhas);

    						$acessivel = true;
    					}

    				}

    			}
    			closedir($dh);
    		}
    	}
    ?>

    </div>
</div>

<?php } ?>