<?php
	if(tableExists('ro_arma') != '1'){
		// REGISTRO DE TABELAS
		$sql = file_get_contents(WFOX_FUNCTIONS_DIR . '/db_rucoy/sql.sql'); // Localiza tabelas SQL para registro unico
		try {
		    $stmt = $pdo->prepare($sql);
		    $stmt->execute(); // EXECUTA AS CRIAÇÃO DAS TABELAS
		} catch (PDOException $e) {
		    echo $e->getMessage();
		    die();
		}
	}

	if(isset($_POST['wfox_func']) && $_POST['wfox_func'] == 'db_rucoy') {
		$method = $_POST['wfox_form'];

		if($method == 'insertBD'){
			$return_ro = $_POST['return_ro'];

			define('WFOX_UPLOAD_DATE', date('Y') . '/' . date('m') . '/');
			$pasta = WFOX_ADMIN_DIR . "/uploads/" . WFOX_UPLOAD_DATE;
			mkdir(WFOX_ADMIN_DIR . "/uploads/" . date('Y') . '/');
			mkdir($pasta);

			/* formatos de imagem permitidos */
			$permitidos = array(".jpg",".jpeg",".gif",".GIF",".png", ".bmp");

			if(isset($_POST)){
			    $nome_imagem    = $_FILES['m_image']['name'];
			    $tamanho_imagem = $_FILES['m_image']['size'];
			     
			    /* pega a extensão do arquivo */
			    $ext = strtolower(strrchr($nome_imagem,"."));
			    
			    /*  verifica se a extensão está entre as extensões permitidas */
			    if(in_array($ext,$permitidos)){
			        
			        /* converte o tamanho para KB */
			        $tamanho = round($tamanho_imagem / 6000);
			        
			        if($tamanho < 5000){ //se imagem for até 5MB envia
			            //$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
			            $nome_atual = md5(uniqid(time())).'.jpg'; //nome que dará a imagem
			            $tmp = $_FILES['m_image']['tmp_name']; //caminho temporário da imagem
			            
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

			                if ($upload_f->execute()) {

			                	if ($return_ro == 'MAPS') {
				                	$insert_bd = $pdo->prepare("INSERT INTO `ro_maps`(m_image,
				                                                               	      m_nome,
				                                                               	      m_desc,
				                                                               	      m_type,
				                                                               	      m_monster,
				                                                               	      m_npcs)
				                                                               VALUES(:m_image,
				                                                            	      :m_nome,
				                                                            	      :m_desc,
				                                                            	      :m_type,
				                                                            	      :m_monster,
				                                                            	      :m_npcs)");
					                $insert_bd->bindValue(":m_image",$nome_atual);
					                $insert_bd->bindValue(":m_nome",$_POST['m_nome']);
					                $insert_bd->bindValue(":m_desc",$_POST['m_desc']);
					                $insert_bd->bindValue(":m_type",$_POST['m_type']);
					                $insert_bd->bindValue(":m_monster",$_POST['m_monster']);
					                $insert_bd->bindValue(":m_npcs",$_POST['m_npcs']);
					            }

					            if ($return_ro == 'CRIATURAS') {
				                	$insert_bd = $pdo->prepare("INSERT INTO `ro_criaturas`(c_image,
				                                                               		       c_nome,
				                                                               		       c_leve,
				                                                               		       c_hp,
				                                                               		       c_xp,
				                                                               		       c_drop,
				                                                               		       c_spawn,
				                                                               		       c_desc)
				                                                        	        VALUES(:c_image,
				                                                            		       :c_nome,
				                                                            		       :c_leve,
				                                                            		       :c_hp,
				                                                            		       :c_xp,
				                                                            		       :c_drop,
				                                                            		       :c_spawn,
				                                                            		       :c_desc)");
					                $insert_bd->bindValue(":c_image",$nome_atual);
					                $insert_bd->bindValue(":c_nome",$_POST['c_nome']);
					                $insert_bd->bindValue(":c_leve",$_POST['c_leve']);
					                $insert_bd->bindValue(":c_hp",$_POST['c_hp']);
					                $insert_bd->bindValue(":c_xp",$_POST['c_xp']);
					                $insert_bd->bindValue(":c_drop",$_POST['c_drop']);
					                $insert_bd->bindValue(":c_spawn",$_POST['c_spawn']);
					                $insert_bd->bindValue(":c_desc",$_POST['c_desc']);
					            }

					            if ($return_ro == 'BOSSES') {
				                	$insert_bd = $pdo->prepare("INSERT INTO `ro_bosses`(b_image,
				                                                               	        b_nome,
				                                                               	        b_cn,
				                                                               		    b_drop)
				                                                        	     VALUES(:b_image,
				                                                            		    :b_nome,
				                                                            		    :b_cn,
				                                                            		    :b_drop)");
					                $insert_bd->bindValue(":b_image",$nome_atual);
					                $insert_bd->bindValue(":b_nome",$_POST['b_nome']);
					                $insert_bd->bindValue(":b_cn",$_POST['b_cn']);
					                $insert_bd->bindValue(":b_drop",$_POST['b_drop']);
					            }

			                	if ($insert_bd->execute()) {
			                		header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=INSERT_ALL_'. $return_ro);
			                	} else {
			                		header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=ERROR_INSERT_'. $return_ro);
			                	}

			                	
			                } else {
			                	header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=ERROR_INSERT');
			                }

			            } else {
			                header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=ERROR_MOVE_FILE');
			            }

			        } else {
			            header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=5MB_IMAGE');
			        }

			    } else {
			        header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=TYPE_IMAGE');
			    }

			} else {
			    header("Location: " . WFOX_SITE_ADM . '/index.php?action=status&func='. $_POST['wfox_func'] .'&ro='. $return_ro .'&status=SELECT_IMAGE');
			    exit;
			}
		}
	}

	function ro_listar_db($table) {
		$pdo = getConnection();

		$stmt = $pdo->prepare("SELECT * FROM $table");
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	function ro_listar_local($table,$nameID,$idLocal) {
		$pdo = getConnection();

		$stmt = $pdo->prepare("SELECT * FROM `$table` WHERE `$nameID`=:idLocal");
		$stmt->bindValue('idLocal',$idLocal);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function ro_mapsLocal($mid) {
		$pdo = getConnection();

		$stmt = $pdo->prepare("SELECT * FROM `ro_maps` WHERE `m_id`=:mid");
		$stmt->bindValue('mid',$mid);
		$stmt->execute();

		$m_line = $stmt->fetch(PDO::FETCH_ASSOC);
		$mapa_name = $m_line['m_nome'];

		return $mapa_name;
	}

	function ro_mapsImage($mid) {
		$pdo = getConnection();

		$stmt = $pdo->prepare("SELECT * FROM `ro_maps` WHERE `m_id`=:mid");
		$stmt->bindValue('mid',$mid);
		$stmt->execute();

		$m_line = $stmt->fetch(PDO::FETCH_ASSOC);
		$mapa_name = $m_line['m_image'];

		return $mapa_name;
	}
?>