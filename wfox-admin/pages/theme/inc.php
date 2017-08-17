<div class="boxElement-right float-r">
    <div class="beThemesModal">
        <?php
        	$ap = WFOX_SITE_DIR; // PASTAS DE TEMAS
        	$dir = '/';

        	if (is_dir($ap . $dir)) {

                // ABERTUR DA PASTA
        		$dh = opendir($ap . $dir);

        		if ($dh) {

        			while (($file = readdir($dh)) !== false) {

        				if ($file === '.' || $file === '..') {
        				    continue;
        				}

                        // PASTA DO THEMA LISTADO
        				$atual = $ap . $dir . $file;

                        // ARQUIVO 'theme.txt' DO THEMA LISTADO
        				$theme = $ap . $dir . $file . '/theme.txt';

                        // ARQUIVO 'bg.jpg' DO THEMA LISTADO
                        $background = $ap . $dir . $file . '/bg.jpg';

                        // PRE DEFINIÇÃO 'WFOX_SITE_THEME' >> FORM POST
                        $sur_theme = '/' . $file;


                        // SE O THEMA DO WFOX NÃO FOR IGUAL AO THEMA LISTADO
                        if(WFOX_SITE_THEME != $atual) {
                            $selectTheme = 'Selecionar tema';
                            $sClass = '';
                            $dInput = '';

                        // CASO SEJA IGUAL
                        } else { 
                            $selectTheme = 'TEMA ATUAL'; 
                            $sClass = 'noSelectTheme';
                            $dInput = 'disabled';
                        }
                        

                        // SE NÃO EXISTIR O ARQUIVO 'bg.jpg' DO THEMA LISTADO
                        if(!file_exists($background)){
                            $lbackground = WFOX_SITE_ADM . '/assets/images/bg.jpg';

                        // CASO EXISTA
                        } else {
                            $lbackground = WFOX_SITE_CONTENT . $dir . $file . '/bg.jpg';
                        }
                        

        				if (is_dir($atual)) { // SE HOUVER ACESSO

        					if (file_exists($theme)) { // O ARQUIVO EXISTIR
        						$linhas = fopen ($theme, "r");
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
        ?>
                                                <form method="post" action="<?php echo WFOX_SITE_URL; ?>/define_log.php">
                                                    <?php echo '<input type="submit" class="'.$sClass.' selectTheme" name="selectTheme" value="'.$selectTheme.'" '.$dInput.'>'; ?>
                                                    <input type="hidden" name="wfox_api" value="config">
                                                    <input type="hidden" name="wfox_form" value="theme">
                                                    <input type="hidden" name="WFOX_SITE_THEME" value="<?php echo $sur_theme; ?>">
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