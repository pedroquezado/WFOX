<?php
	$pageTitle 		= 'Nova Publicação';
	$pageButSave 	= 'Salvar Post';
	$postTitle 		= '';
	$postUrl 		= 'p' . $id_post;
	$postThumb 		= 'default';

	$postVisibilidade = 'Rascunho';
	if($_GET['action'] == 'edit-post'){
		$pageTitle = 'Editar Publicação';
		$pageButSave = 'Atualizar Post';

		$updatePost = $pdo->prepare("SELECT * FROM `posts` WHERE `p_id`=?");
		$updatePost->execute(array($id_post));
		$linhaUP = $updatePost->fetch(PDO::FETCH_ASSOC);
		$postTitle = $linhaUP['p_titulo'];
		$postStitle = $linhaUP['p_stitulo'];
		$postDesc = $linhaUP['p_desc'];
		$postVisibilidade = $linhaUP['p_visibilidade'];
		$postUrl = $linhaUP['p_link'];
		$postTemplate = $linhaUP['p_template'];
		$postThumb 	= $linhaUP['p_thumb'];
	}
?>
<div class="pBox-right float-r">
	<div class="boxPost-newElement">
		<div class="bp-import overflow-a">
			<div class="page-desc float-l">
				<?php echo $pageTitle; ?>
				<span class="load-reload"></span>
			</div>
			<div class="page-buttons float-r">
				<div class="but-list overflow-a">
					<input class="cButton but-sav" but-date="post" type="button" name="page-save" value="<?php echo $pageButSave; ?>">
					<input class="cButton but-del mLeft-10" type="button" name="page-save" value="Deletar Post">
				</div>
			</div>
		</div>
		<div class="bp-toolbar">
			<div class="toolbar">
				<a href="#" data-command='undo' onclick="formatDoc('undo');"><i class='fa fa-undo'></i></a>
				<a href="#" data-command='redo' onclick="formatDoc('redo');"><i class='fa fa-repeat'></i></a>
				<div class="fore-wrapper">
					<i class='fa fa-font' style='color:#C96;'></i>
					<div class="fore-palette"></div>
				</div>
				<div class="back-wrapper">
					<i class='fa fa-font' style='background:#C96;'></i>
					<div class="back-palette"></div>
				</div>
				<div class="fonts-wrapper">
					<i class='fa fa-font'></i>
					<div class="fonts-palette"></div>
				</div>
				<a href="#" data-command='bold' onclick="formatDoc('bold');"><i class='fa fa-bold'></i></a>
				<a href="#" data-command='italic' onclick="formatDoc('italic');"><i class='fa fa-italic'></i></a>
				<a href="#" data-command='underline' onclick="formatDoc('underline');"><i class='fa fa-underline'></i></a>
				<a href="#" data-command='strikeThrough' onclick="formatDoc('strikeThrough');"><i class='fa fa-strikethrough'></i></a>
				<a href="#" data-command='justifyLeft' onclick="formatDoc('justifyLeft');"><i class='fa fa-align-left'></i></a>
				<a href="#" data-command='justifyCenter' onclick="formatDoc('justifyCenter');"><i class='fa fa-align-center'></i></a>
				<a href="#" data-command='justifyRight' onclick="formatDoc('justifyRight');"><i class='fa fa-align-right'></i></a>
				<a href="#" data-command='justifyFull' onclick="formatDoc('justifyFull');"><i class='fa fa-align-justify'></i></a>
				<a href="#" data-command='indent' onclick="formatDoc('indent');"><i class='fa fa-indent'></i></a>
				<a href="#" data-command='outdent' onclick="formatDoc('outdent');"><i class='fa fa-outdent'></i></a>
				<a href="#" data-command='insertUnorderedList' onclick="formatDoc('insertUnorderedList');"><i class='fa fa-list-ul'></i></a>
				<a href="#" data-command='insertOrderedList' onclick="formatDoc('insertOrderedList');"><i class='fa fa-list-ol'></i></a>
				<a href="#" data-command='h1' onclick="formatDoc('formatblock','h1');">H1</a>
				<a href="#" data-command='h2' onclick="formatDoc('formatblock','h2');">H2</a>
				<a href="#" data-command='createlink' onclick="var sLnk=prompt('Write the URL here','http:\/\/');if(sLnk&&sLnk!=''&&sLnk!='http://'){formatDoc('createlink',sLnk)}"><i class='fa fa-link'></i></a>
				<a href="#" data-command='unlink' onclick="formatDoc('unlink');"><i class='fa fa-unlink'></i></a>
				<a href="#" id="myBtn" data-command='insertimage' onclick="formatDoc('insertimage');"><i class='fa fa-image'></i></a>
				<a href="#" data-command='p' onclick="formatDoc('p');">P</a>
				<a href="#" data-command='subscript' onclick="formatDoc('subscript');"><i class='fa fa-subscript'></i></a>
				<a href="#" data-command='superscript' onclick="formatDoc('superscript');"><i class='fa fa-superscript'></i></a>
			</div>							
		</div>
		<div class="bp-scport-post">
			<div class="scPost-box">
				<div class="post-title mBottom-15">
					<div class="post-divider nav-dropdown">
						<i id="view-urlbtn" class="urldropbtn fa fa-link tooltip">
							<span id="tooltipLink" class="tooltiptext tooltip-bottom">Editar URL do post</span>
							<div id="permalink" class="dropdown-content">
								<div id="nssL" class="editor-slug">
									<span id="nssL" class="editor-slug__url-path"><?php echo WFOX_SITE_URL . '/' . date('Y/m/d'); ?></span>
									<span id="nssL" class="form-text-input url-postTemp"><?php echo $postUrl; ?></span>
								</div>
							</div>
						</i>
						<input id="pTitle" type="type" name="pTitle" placeholder="Post title" value="<?php echo $postTitle; ?>">
					</div>
				</div>
				<div class="post-stitle mBottom-15">
					<input type="type" name="pStitle" placeholder="Subtitle" value="<?php echo $postStitle; ?>">
				</div>
				<div id='editor' contenteditable data-text="O que deseja publicar?"><?php echo $postDesc; ?></div>

				<input type="hidden" name="thumbTempPost" value="<?php echo $postThumb; ?>">
			</div>
			<div class="scConf-box">
				<div class="conf-post-box">
					<div class="cp-divider-box">
						<div class="conf-post-title">Status</div>
						<div class="conf-post-sett">
							<div class="mToggle">
								<div class="conf-post-subtitle">Visibilidade: <span><?php echo validStatPost($postVisibilidade); ?></span></div>
								<div class="ref-toggle statPost-listBtn">
									<div class="bordg-sl">
										<input type="radio" id="v1" name="visib-post" value="V" <?php if($postVisibilidade == 'V'){echo 'checked';}?>>
										<label for="v1"><span>✓</span>Público</label>
									</div>
									<div class="bordg-sl">
										<input type="radio" id="v2" name="visib-post" value="P" <?php if($postVisibilidade == 'P'){echo 'checked';}?>>
										<label for="v2"><span>✓</span>Privado</label>
									</div>
								</div>
							</div>
							<div class="mToggle">
								<div class="conf-post-subtitle">Publicar: <span>imediatamente</span></div>
								<div class="ref-toggle statPost-listBtn">
									<input type="date" name="visib-post" value="<?php echo date('d,m,Y'); ?>">
									asdas
								</div>
							</div>
						</div>
					</div>
					<div class="cp-divider-box">
						<div class="conf-post-title">Categorias</div>
						<div class="conf-post-sett">
							<div class="position-r">
								<input id="newCatBut" type="text" class="conf-post-butNew" placeholder="+ Nova Categoria">
								<div class="submitNewCat">
									<div class="oky_d">✓</div>
								</div>
							</div>
							<div class="conf-post-listBtn listBtn-cats">
								<ul>
									<?php
										$bc_cats = $pdo->prepare("SELECT * FROM `categories` ORDER BY `c_id` ASC");
										$bc_cats->execute();

										if($bc_cats->rowCount() > 0){
											while($linhaCats = $bc_cats->fetch(PDO::FETCH_ASSOC)) {
									?>
											<li>
												<input 
													type="checkbox" 
													id="c<?php echo $linhaCats['c_id']; ?>" 
													name="newcategory" 
													value="<?php echo $linhaCats['c_id']; ?>" 
													<?php 
													if(validCatFilter($pdo,$linhaCats['c_id'],$id_post) == TRUE){echo 'checked';} 
													?>
												>
												<label for="c<?php echo $linhaCats['c_id']; ?>">
													<span>✓</span><?php echo $linhaCats['c_nome']; ?>
												</label>
											</li>
									<?php
											}
										}
									?>
								</ul>
							</div>
						</div>
					</div>

					<div class="cp-divider-box">
						<div class="conf-post-title">Tags</div>
						<div class="conf-post-sett">
							<div class="position-r">
								<input id="newTagBut" type="text" class="conf-post-butNew" placeholder="+ Nova Tag">
								<div class="submitNewTag">
									<div class="oky_d">✓</div>
								</div>
							</div>
							<div class="conf-post-listBtn listBtn-tags">
								<ul>
									<?php
										$bc_tags = $pdo->prepare("SELECT * FROM `tags` ORDER BY `t_id` ASC");
										$bc_tags->execute();

										if($bc_tags->rowCount() > 0){
											while($linhaTags = $bc_tags->fetch(PDO::FETCH_ASSOC)) {
										?>
											<li>
												<input 
													type="checkbox" 
													id="t<?php echo $linhaTags['t_id']; ?>" 
													name="newtag" 
													value="<?php echo $linhaTags['t_id']; ?>" 
													<?php 
													if(validTagFilter($pdo,$linhaTags['t_id'],$id_post) == TRUE){echo 'checked';} 
													?>
												>
												<label for="t<?php echo $linhaTags['t_id']; ?>">
													<span><?php echo $linhaTags['t_nome']; ?></span>
												</label>
											</li>
									<?php
											}
										}
									?>
								</ul>
							</div>
						</div>
					</div>

					<div class="cp-divider-box">
						<div class="conf-post-title">Página personalizada</div>
						<div class="conf-post-sett">
							<div class="_cmd-marg">
								<label for="page_personalit">Modelo</label>
								<select id="page_personalit" name="page_personalit">
									<option value="none">---</option>
									<?php
										foreach(comment_titlePage() as $key => $value):
											if($value != ''):
												echo '<option value="'.$key.'"';
												if($postTemplate == $key){echo 'selected';}
												echo '>'.$value.'</option>';
											endif;
										endforeach;
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="cp-divider-box">
						<div class="conf-post-title">Imagem em destaque</div>
						<div class="conf-post-sett">
							<div id="featuredImage" class="_cmd-marg">
								<img id="featured" src="<?= getThumb($pdo,$postThumb); ?>">
								<div class="position-r">
									<form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo WFOX_SITE_URL; ?>/define_log.php">
										<div class="_cmd-title">Definir imagem em destaque</div>
										<input type="file" id="imagemPost" name="imagem" />

										<input type="hidden" name="wfox_api" value="upload">
										<input type="hidden" name="wfox_form" value="thumb_profile">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>