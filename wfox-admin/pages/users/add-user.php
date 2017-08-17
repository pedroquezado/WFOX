<?php
	$pageTitle 		= 'Adicionar Novo Usuário';
	$pageButSave 	= 'Adicionar';
	$labelSenha 	= 'Senha';
	$wfox_form 		= 'add';

	$userEmail 		= '';
	$userNome 		= '';
	$userSobrenome 	= '';
	$userThumb 		= 'default';
	$userRole		= '';
	$returnThumb	= '';

	if($_GET['action'] == 'edit-user'){

		$pageTitle 		= 'Editar Usuário';
		$pageButSave 	= 'Atualizar';
		$labelSenha 	= 'Editar Senha';
		$wfox_form 		= 'edit';

		$id_userOQ = _get( 'id_user' );
		$updateUser = $pdo->prepare("SELECT * FROM `users` WHERE `u_id`=?");
		$updateUser->execute(array($id_userOQ));
		$linhaUP = $updateUser->fetch(PDO::FETCH_ASSOC);

		$userEmail 		= $linhaUP['u_email'];
		$userNome 		= $linhaUP['u_nome'];
		$userSobrenome 	= $linhaUP['u_sobrenome'];
		$userThumb 		= $linhaUP['u_thumb'];
		$userRole 		= $linhaUP['u_role'];
		$returnThumb	= 'style="background-image: url(' . getThumbProfil($pdo,$linhaUP['u_id']) . '); background-size: cover"';

	}
?>
<div class="pBox-right float-r">
	<div class="boxPost-newElement">
		<div class="bp-import overflow-a shadow">
			<div class="page-desc float-l">
				<?php echo $pageTitle; ?>
				<span class="load-reload"></span>
			</div>
			<div class="page-buttons float-r">
				<div class="but-list overflow-a">
					<input class="cButton but-sav" but-date="user" type="button" name="page-save" value="<?php echo $pageButSave; ?>">
				</div>
			</div>
		</div>
		<div class="bp-scport-users">
			<?php if($_GET['action'] == 'add-user'){ ?>
			<div class="form-subtitle">Crie um novo usuário e adicione-o a este site.</div>
			<?php } ?>
			<div class="d-flex">
				<div class="form-horizontal bord-r d-flex-1">
					<div class="form-group">
						<label for="u_email" class="control-label">Email</label>
						<div class="control-divider">
							<input type="email" class="input-control" id="u_email" name="u_email" value="<?php echo $userEmail; ?>">
							<p class="form-setting no-select">Não será exibido publicamente</p>
						</div>
					</div>
					<div class="d-flex">
						<div class="form-group d-flex-1">
							<label for="u_nome" class="control-label">Nome</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="u_nome" name="u_nome" value="<?php echo $userNome; ?>">
							</div>
						</div>
						<div class="form-group d-flex-1">
							<label for="u_sobrenome" class="control-label">Sobrenome</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="u_sobrenome" name="u_sobrenome" value="<?php echo $userSobrenome; ?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="u_senha" class="control-label"><?php echo $labelSenha; ?></label>
						<div class="control-divider">
							<input type="password" class="input-control" id="u_senha"  name="u_senha" onkeyup="javascript:verifica()">
							<div id="returnPass">
								<div class="verf-PassBox mNull"> Validar </div>
							</div>
							<p class="form-verf no-select">Dica: A senha deve ter no mínimo sete caracteres. Para torná-la mais forte, use letras maiúsculas e minúsculas, números e símbolos como ! "? $% ^ & ).</p>
							<?php if($_GET['action'] == 'edit-user'){ ?>
							<p class="form-setting no-select">Se não for alterar a senha pode deixar o campo em branco.</p>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<div class="robSendPass">
							<span class="label-span">Enviar Senha?</span>
							<span>
								<input type="checkbox" name="sendEmail" value="sendPass">
								<span class="label-span-logb">Envie esta senha para o novo usuário por e-mail.</span>
							</span>
						</div>
					</div>
					<div class="form-group">
						<div class="robSendPass">
							<span class="label-span">Função</span>
							<span>
								<select class="select-control" name="u_role">
									<option value=""></option>
									<option value="1" <?php if($userRole == '1'){echo 'selected'; } ?>>Administrador</option>
									<option value="2" <?php if($userRole == '2'){echo 'selected'; } ?>>Editor</option>
									<option value="3" <?php if($userRole == '3'){echo 'selected'; } ?>>Autor</option>
								</select>
							</span>
						</div>
					</div>
					<input type="hidden" name="thumbTempProfile" value="<?php echo $userThumb; ?>">
					<input type="hidden" name="wfox_userForm" value="<?php echo $wfox_form; ?>">
					<?php if($_GET['action'] == 'edit-user'){ ?>
					<input type="hidden" name="editUserID" value="<?php echo $_GET['id_user']; ?>">
					<?php } ?>
				</div>
				<div class="d-flex-1">
					<form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo WFOX_SITE_URL; ?>/define_log.php">
						<div class="box-modal-gener">
							<div class="upload-new-file tooltip">
								<span class="tooltiptext tooltip-top">ENVIAR FOTO</span>
								<div id="status" class="prof-bord prof-back" <?php echo $returnThumb; ?>></div>
								<input type="file" id="imagem" name="imagem" />
							</div>
							<div class="relostProfil"></div>
						</div>
						<div id="visualizar"></div>
						<input type="hidden" name="wfox_api" value="upload">
						<input type="hidden" name="wfox_form" value="thumb_profile">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>