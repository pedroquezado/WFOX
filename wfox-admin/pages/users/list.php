<div class="pBox-right float-r">
	<div class="boxPost-newElement">
		<div class="bp-import overflow-a shadow">
			<div class="page-desc float-l">
				Usuários
				<span>
					<?php $selectLimitView = $_GET['pLimitView'];?>
					<select id="pLimitView" select-type-view="users">
					    <option value="25" <?php if($selectLimitView == '25'){ echo 'selected';} ?>>25</option>
					    <option value="50" <?php if($selectLimitView == '50'){ echo 'selected';} ?>>50</option>
					    <option value="100" <?php if($selectLimitView == '100'){ echo 'selected';} ?>>100</option>
					    <option value="200" <?php if($selectLimitView == '200'){ echo 'selected';} ?>>200</option>
					</select>
				</span>
			</div>
			<div class="page-buttons float-r">
				<div class="but-list overflow-a">
					<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=add-user" class="cButton but-red">+ Adicionar usuário</a>
				</div>
			</div>
		</div>
		<div class="bp-scport-users">
			<table>
				<thead>
					<tr>
						<th></th>
						<th>Nome</th>
						<th>Email</th>
						<th>Função</th>
						<th>Posts</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$pLimitView = 25;
						if(isset($_GET['pLimitView']) && is_numeric($_GET['pLimitView'])){
							$pLimitView = $_GET['pLimitView'];
							if ($pLimitView == '' || $pLimitView == '0') {
								$pLimitView = 25;
							}
						}
						$bc_users = $pdo->prepare("SELECT * FROM `users` ORDER BY `u_id` DESC limit $pLimitView");
						$bc_users->execute();

						if($bc_users->rowCount() > 0){
							while($linhaUser = $bc_users->fetch(PDO::FETCH_ASSOC)) {
					
					 ?>
					<tr class="listPost lUserID-<?php echo $linhaUser['u_id']; ?>">
						<td>
							<div class="tb-vla thumb-profile-list">
								<div class="boxProfile wh38 mAuto" style="background-image: url(<?php echo getThumbProfil($pdo,$linhaUser['u_id']); ?>);">
							</div>
						</td>
						<td><div class="tb-vla"><?php echo $linhaUser['u_nome'] . ' ' . $linhaUser['u_sobrenome']; ?></div></td>
						<td><div class="tb-vla"><?php echo $linhaUser['u_email']; ?></div></td>
						<td><div class="tb-vla"><?php echo getFunctionUser($linhaUser['u_role']); ?></div></td>
						<td><div class="tb-vla"><?php echo fetchAllPost($pdo,$linhaUser['u_id']); ?></div></td>
						<td>
							<div class="tb-vla d-flex">
								<a class="d-flex-1 butList butList-edit" href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=edit-user&id_user=<?php echo $linhaUser['u_id']; ?>">Editar</a>
								<?php if($linhaUser['u_role'] != '4' && $linhaUser['u_id'] != $user_id) { ?>
								<div class="d-flex-1 butList butUser-delet" id-user-delet="<?php echo $linhaUser['u_id']; ?>">Apagar</div>
								<?php } else { echo '<div class="d-flex-1"></div>'; }?>
							</div>
						</td>
					</tr>
					<?php 
							}
						} 
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>