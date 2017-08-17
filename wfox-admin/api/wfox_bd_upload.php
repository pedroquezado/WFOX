<?php
    if(isset($_POST['wfox_api']) && $_POST['wfox_api'] == 'upload') {
        $method = $_POST['wfox_form'];

        //UPLOAD PROFILE IMAGE
            if($method == 'thumb_profile'){

                define('WFOX_UPLOAD_DATE', date('Y') . '/' . date('m') . '/');
                $pasta = WFOX_ADMIN_DIR . "/uploads/" . WFOX_UPLOAD_DATE;
                mkdir(WFOX_ADMIN_DIR . "/uploads/" . date('Y') . '/');
                mkdir($pasta);
                
                /* formatos de imagem permitidos */
                $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
                
                if(isset($_POST)){
                    $nome_imagem    = $_FILES['imagem']['name'];
                    $tamanho_imagem = $_FILES['imagem']['size'];
                     
                    /* pega a extensão do arquivo */
                    $ext = strtolower(strrchr($nome_imagem,"."));
                    
                    /*  verifica se a extensão está entre as extensões permitidas */
                    if(in_array($ext,$permitidos)){
                        
                        /* converte o tamanho para KB */
                        $tamanho = round($tamanho_imagem / 6000);
                        
                        if($tamanho < 5000){ //se imagem for até 5MB envia
                            //$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
                            $nome_atual = md5(uniqid(time())).'.jpg'; //nome que dará a imagem
                            $tmp = $_FILES['imagem']['tmp_name']; //caminho temporário da imagem
                            
                            /* se enviar a foto, insere o nome da foto no banco de dados */
                            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
                                $file_year = date('Y');
                                $file_mount = date('m');
                                $data_upload = date("d/m/Y H:i:s");
                                $upload_f = $pdo->prepare("INSERT INTO `upload_thumb`(ut_file,
                                                                                      ut_name,
                                                                                      ut_ano,
                                                                                      ut_dia,
                                                                                      ut_data_upload)
                                                                               VALUES(:ut_file,
                                                                                      :ut_name,
                                                                                      :ut_ano,
                                                                                      :ut_dia,
                                                                                      :ut_data_upload)");
                                $upload_f->bindValue(":ut_file",$nome_atual);
                                $upload_f->bindValue(":ut_name",$nome_imagem);
                                $upload_f->bindValue(":ut_ano",$file_year);
                                $upload_f->bindValue(":ut_dia",$file_mount);
                                $upload_f->bindValue(":ut_data_upload",$data_upload);
                                $upload_f->execute();
                                echo WFOX_SITE_ADM . "/uploads/" . WFOX_UPLOAD_DATE . $nome_atual;
                            }else{
                                echo "Falha ao enviar";
                            }
                        }else{
                            echo "A imagem deve ser de no máximo 5MB";
                        }
                    }else{
                        echo "Somente são aceitos arquivos do tipo Imagem";
                    }
                }else{
                    echo "Selecione uma imagem";
                    exit;
                }
            }

        //VIEW GALLEY (IMAGES)
            if($method == 'gallery'){
                $bc_thumb = $pdo->prepare("SELECT * FROM `upload_thumb` ORDER BY `ut_id` DESC limit 20");
                $bc_thumb->execute();

                if($bc_thumb->rowCount() > 0){
                    echo '<div class="galleryResultBox"><ul class="listGalleryThumb">';
                    while($linhaThumb = $bc_thumb->fetch(PDO::FETCH_ASSOC)) {
?>
                        <li class="dataThumb" data-thumb-id="<?php echo $linhaThumb['ut_id']; ?>">
                            <div class="viewListThumb" style="background-image: url(<?php echo getThumb($pdo,$linhaThumb['ut_file']); ?>);"></div>
                        </li>
                            
<?php              
                    }
                    echo '</ul></div>';
                } else {
                    echo '<div class="loadNoFind">Nenhuma imagem.</div>';
                }
            }

        //DELET THUMB 
            if($method == 'delet'){
                foreach($_POST['thumbIDS'] as $key => $value) {
                    $procurarThumbOQ = $pdo->prepare("SELECT * FROM `upload_thumb` WHERE `ut_id`=?");
                    $procurarThumbOQ->execute(array($value));
                    $ut_line = $procurarThumbOQ->fetch(PDO::FETCH_ASSOC);
                    $thumb  = $ut_line['ut_file'];
                    $ut_ano = $ut_line['ut_ano'];
                    $ut_dia = $ut_line['ut_dia'];

                    $deletThumbByID = "DELETE FROM `upload_thumb` WHERE `ut_id`=:ut_id";
                    $stmtpc = $pdo->prepare($deletThumbByID);
                    $stmtpc->bindParam(':ut_id', $value, PDO::PARAM_INT);

                    if($stmtpc->execute()){

                        if($ut_dia < '10'){ $ut_dia = '0'.$ut_dia; }
                        
                        $fileOut = '/uploads/' . $ut_ano . '/' . $ut_dia . '/' . $thumb;
                        $filename = WFOX_ADMIN_DIR . $fileOut;
                        unlink($filename);

                    }
                }
            }
    }
?>