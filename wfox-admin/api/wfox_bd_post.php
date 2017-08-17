<?php
	function get_last_postID($pdo){
		$procurarPost = $pdo->prepare("SELECT * FROM `posts`");
		$procurarPost->execute();

		if($procurarPost->rowCount() != 0){
			$getLastID = $pdo->prepare("SELECT * FROM `posts` ORDER BY `p_id` DESC limit 1");
			$getLastID->execute();
			$linha = $getLastID->fetch(PDO::FETCH_ASSOC);
			$lastID = $linha['p_id'];

			$newLastID = $lastID;
			return $newLastID;
		} else {
			return '1';
		}
	}

	function validar_newLastID($pdo,$pId){
		$procurarPost = $pdo->prepare("SELECT * FROM `posts` WHERE `p_id`=?");
		$procurarPost->execute(array($pId));

		if($procurarPost->rowCount() != 0){
			return '0';
		} else {
			return '1';
		}
	}

	function validStatPost($return){
		switch ($return) {
			case 'V':
				return 'Público';
				break;
			case 'P':
				return 'Privado';
				break;
			case 'R':
				return 'Rascunho';
				break;
		}
	}

	function sanitizeString($str) {
	    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
	    $str = preg_replace('/[éèêë]/ui', 'e', $str);
	    $str = preg_replace('/[íìîï]/ui', 'i', $str);
	    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
	    $str = preg_replace('/[úùûü]/ui', 'u', $str);
	    $str = preg_replace('/[ç]/ui', 'c', $str);
	    $str = preg_replace('/[^a-z0-9]/i', '-', $str);
	    $str = preg_replace('/-+/', '-', $str);
	    return $str;
	}

	function validCatFilter($pdo,$cID,$pID) {
		$qCatNew = $pdo->prepare("SELECT * FROM `post_categories` WHERE `pc_post_id`=? AND `pc_cat_id`=?");
		$qCatNew->execute(array($pID, $cID));

		if($qCatNew->rowCount() == 0){
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function validTagFilter($pdo,$tID,$pID) {
		$qTagNew = $pdo->prepare("SELECT * FROM `post_tags` WHERE `pt_post_id`=? AND `pt_tag_id`=?");
		$qTagNew->execute(array($pID, $tID));

		if($qTagNew->rowCount() == 0){
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function validPost($pdo,$titulo) {
		$procurarPost = $pdo->prepare("SELECT * FROM `posts` WHERE `p_titulo`=?");
		$procurarPost->execute(array($titulo));

		if($procurarPost->rowCount() == 0){
			return FALSE;
		} else {
			return TRUE;
		}
	}


	function validPostURL($pdo,$url) {
		$procurarPost = $pdo->prepare("SELECT * FROM `posts` WHERE `p_link`=?");
		$procurarPost->execute(array($url));

		if($procurarPost->rowCount() == 0){
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function get_includeTheme($pdo,$url) {
		$postIncludeSearch = $pdo->prepare("SELECT * FROM `posts` WHERE `p_link`=?");
		$postIncludeSearch->execute(array($url));
		$linha = $postIncludeSearch->fetch(PDO::FETCH_ASSOC);
		
		return $linha['p_template'];
	}

	function update_viewPost( $url ){
		$pdo = getConnection();

		$postSearch = $pdo->prepare("SELECT * FROM `posts` WHERE `p_link`=?");
		$postSearch->execute(array($url));
		$linha = $postSearch->fetch(PDO::FETCH_ASSOC);
		$postID = $linha['p_id'];
		$postView = $linha['p_view'];

		$reView = $postView + 1;
		$sql = "UPDATE `posts` SET p_view = ? WHERE p_id = ?";
		$addPost = $pdo->prepare($sql);
		$addPost->execute(array($reView,$postID));
	}

	function delet_post_byID($pdo,$pid){
		$procurarPost = $pdo->prepare("SELECT * FROM `posts` WHERE `p_id`=?");
		$procurarPost->execute(array($pid));

		if($procurarPost->rowCount() != 0){
			$deletPostSQL = "DELETE FROM `posts` WHERE `p_id`=:p_id";
			$stmt = $pdo->prepare($deletPostSQL);
			$stmt->bindParam(':p_id', $pid, PDO::PARAM_INT);   
			
			if($stmt->execute()){
				$deletPC_SQL = "DELETE FROM `post_categories` WHERE `pc_post_id`=:pc_post_id";
				$stmtpc = $pdo->prepare($deletPC_SQL);
				$stmtpc->bindParam(':pc_post_id', $pid, PDO::PARAM_INT);
				$stmtpc->execute();

				$deletPT_SQL = "DELETE FROM `post_tags` WHERE `pt_post_id`=:pt_post_id";
				$stmtpt = $pdo->prepare($deletPT_SQL);
				$stmtpt->bindParam(':pt_post_id', $pid, PDO::PARAM_INT);
				$stmtpt->execute();

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

	function fetchAllPost($pdo,$uId){
		$procurarPost = $pdo->prepare("SELECT * FROM `posts` WHERE `p_uid`=?");
		$procurarPost->execute(array($uId));

		return $procurarPost->rowCount();
	}

	function convertCategory( $cID ){
		$pdo = getConnection();

		$bc_cats = $pdo->prepare("SELECT * FROM `categories` WHERE `c_id`=?");
		$bc_cats->execute(array($cID));
		$linhaCat = $bc_cats->fetch(PDO::FETCH_ASSOC);

		return $linhaCat['c_nome'];
	}

	function linkCategory( $cID ) {
		return WFOX_SITE_URL . '/category/' . sanitizeString(strtolower(convertCategory($cID)));
	}

	function get_category_link(){
		$catPage = _view(1);
		$catPost = get_category();

		foreach($catPost as $cat):
			$catList = sanitizeString(strtolower(convertCategory($cat->c_id)));
			if($catList === $catPage){
				$valueReturn = $cat->c_id;

				break;
			}
		endforeach;

		return $valueReturn;
	}

	if(isset($_POST['wfox_api']) && $_POST['wfox_api'] == 'post') {
		$method = $_POST['wfox_form'];

		//PRE-POST
			if($method == 'pre-add'){
				$preVisib = 'R';
				$preAddPost = $pdo->prepare("INSERT INTO `posts`(p_visibilidade,p_uid) VALUES(:p_visibilidade,:p_uid)");
				$preAddPost->bindValue(":p_visibilidade",$preVisib);
				$preAddPost->bindValue(":p_uid",$user_id);
				$preAddPost->execute();
				header("Location: " . WFOX_SITE_ADM . '/index.php?action=add-post&newLastID=' . get_last_postID($pdo));
				exit();
			}

		//ADD-CATEGORIA ADD-TAG
			if($method == 'addNewReturn'){
				$mType = $_POST['rType'];

				if($mType == 'cat'){
					$newValue = $_POST['newValue'];
					$addCatNew = $pdo->prepare("INSERT INTO `categories`(c_nome, c_data) VALUES(:c_nome, :c_data)");
					$addCatNew->bindValue(":c_nome",$newValue);
					$addCatNew->bindValue(":c_data",date('d-m-Y'));

					if($addCatNew->execute()){
						$rCatNew = $pdo->prepare("SELECT * FROM `categories` WHERE `c_nome`=?");
						$rCatNew->execute(array($newValue));
						$linhaNC = $rCatNew->fetch(PDO::FETCH_ASSOC);
						$catID = $linhaNC['c_id'];

						echo '<li><input type="checkbox" id="c' . $catID . '" name="newcategory" value="' . $catID . '"><label for="c' . $catID . '"><span>✓</span>' . $newValue . '</label></li>';
					}
				}

				if($mType == 'tag'){
					$newValue = $_POST['newValue'];
					$addTagNew = $pdo->prepare("INSERT INTO `tags`(t_nome, t_data) VALUES(:t_nome, :t_data)");
					$addTagNew->bindValue(":t_nome",$newValue);
					$addTagNew->bindValue(":t_data",date('d-m-Y'));

					if($addTagNew->execute()){
						$rTagNew = $pdo->prepare("SELECT * FROM `tags` WHERE `t_nome`=?");
						$rTagNew->execute(array($newValue));
						$linhaNT = $rTagNew->fetch(PDO::FETCH_ASSOC);
						$tagID = $linhaNT['t_id'];

						echo '<li><input type="checkbox" id="t' . $tagID . '" name="newtag" value="' . $tagID . '"><label for="t' . $tagID . '"><span>' . $newValue . '</span></label></li>';
					}
				}

			}

		//URL-POST (CHANGE)
			if($method == 'url_change'){
				$url_post = $_POST['url_post'];
				echo sanitizeString($url_post);
			}


		//FILTER-POST
			if($method == 'addFilter'){
				$mType = $_POST['rType'];

				if($mType == 'cat'){
					$pc_post_id 	= $_POST['pc_post_id'];
					$pc_cat_id 		= $_POST['pc_cat_id'];

					if(validCatFilter($pdo,$pc_cat_id,$pc_post_id) == FALSE){
						$insetCatNew = $pdo->prepare("INSERT INTO `post_categories`(pc_post_id, pc_cat_id) VALUES(:pc_post_id, :pc_cat_id)");
						$insetCatNew->bindValue(":pc_post_id",$pc_post_id);
						$insetCatNew->bindValue(":pc_cat_id",$pc_cat_id);
						if($insetCatNew->execute()){
							echo '1';
						} else {
							echo '0';
						}
					} else {
						$deletPC_SQL = "DELETE FROM `post_categories` WHERE `pc_post_id`=:pc_post_id AND `pc_cat_id`=:pc_cat_id";
						$stmtpc = $pdo->prepare($deletPC_SQL);
						$stmtpc->bindParam(':pc_post_id', $pc_post_id, PDO::PARAM_INT);
						$stmtpc->bindParam(':pc_cat_id', $pc_cat_id, PDO::PARAM_INT);
						
						if($stmtpc->execute()){
							echo '1';
						} else {
							echo '0';
						}
					}
				}

				if($mType == 'tag'){
					$pt_post_id 	= $_POST['pt_post_id'];
					$pt_tag_id 		= $_POST['pt_tag_id'];

					if(validTagFilter($pdo,$pt_tag_id,$pt_post_id) == FALSE){
						$insetTagNew = $pdo->prepare("INSERT INTO `post_tags`(pt_post_id, pt_tag_id) VALUES(:pt_post_id, :pt_tag_id)");
						$insetTagNew->bindValue(":pt_post_id",$pt_post_id);
						$insetTagNew->bindValue(":pt_tag_id",$pt_tag_id);
						if($insetTagNew->execute()){
							echo '1';
						} else {
							echo '0';
						}
					} else {
						$deletPT_SQL = "DELETE FROM `post_tags` WHERE `pt_post_id`=:pt_post_id AND `pt_tag_id`=:pt_tag_id";
						$stmtpt = $pdo->prepare($deletPT_SQL);
						$stmtpt->bindParam(':pt_post_id', $pt_post_id, PDO::PARAM_INT);
						$stmtpt->bindParam(':pt_tag_id', $pt_tag_id, PDO::PARAM_INT);
						
						if($stmtpt->execute()){
							echo '1';
						} else {
							echo '0';
						}
					}
				}
			}

		//ADD-POST
			if($method == 'add'){
				$p_titulo 		= $_POST['p_titulo'];
				$p_stitulo 		= $_POST['p_stitulo'];
				$p_desc 		= $_POST['p_desc'];
				$p_visibilidade = $_POST['p_visibilidade'];
				if ($p_visibilidade == '') {
					$p_visibilidade = 'V';
				}
				$p_data 		= date('Y-m-d');
				$p_hora 		= date('H:i:s');
				$p_link 		= strtolower($_POST['p_link']);
				$p_template 	= $_POST['p_template'];
				$p_type 		= 'post';
				if($p_template != 'none'){
					$p_visibilidade = 'P';
					$p_type = 'page';
				}
				$p_thumb 		= $_POST['p_thumb'];
				$newLastID 		= $_POST['newLastID'];

				
					$sql = "UPDATE `posts` 
							SET p_titulo = ?,
								p_stitulo = ?,
								p_desc = ?,
								p_visibilidade = ?,
								p_data = ?,
								p_hora = ?,
								p_link = ?,
								p_template = ?,
								p_uid = ?,
								p_thumb = ?,
								p_type = ?
							WHERE p_id = ?";
					$addPost = $pdo->prepare($sql);
					
					if($addPost->execute(array($p_titulo, $p_stitulo, $p_desc, $p_visibilidade, $p_data, $p_hora, $p_link, $p_template, $user_id, $p_thumb, $p_type, $newLastID))) {
						echo '1';
					} else {
						echo '0'; // RETORNA ERRO
					}
				
			}

		//DELET-POST
			if($method == 'delet'){
				$id_post = $_POST['id_post'];
				if(isset($id_post) && $id_post != ''){
					if(is_numeric($id_post)){
						if(validar_newLastID($pdo,$id_post) == 0) {
							delet_post_byID($pdo,$id_post);
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
	}