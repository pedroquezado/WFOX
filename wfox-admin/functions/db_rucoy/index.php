<style type="text/css">
	textarea {
		min-height: 200px;
	}

	table.plug-listTable {
		width: 100%;
	}
	table.plug-listTable tr th, table.plug-listTable tr td {
	    background: #f6f6f6;
	    border: 1px solid #d6d6d6;
	    padding: 5px 10px;
	    text-align: center;
	}
</style>
<form method="post" action="<?php echo WFOX_SITE_ADM; ?>/index.php?action=status&func=db_rucoy&ro=<?= _get( 'ro' ) ?>" enctype="multipart/form-data">
	<div class="bp-import overflow-a shadow">
		<div class="page-desc float-l">
			PLUGIN::Rucoy Online - <b>DATABASE</b>
			<span class="load-reload"></span>
		</div>
		<div class="page-buttons float-r">
			<div class="but-list overflow-a">
				<input type="submit" class="cButton but-sav" value="SALVAR CONFIGURAÇÕES">
			</div>
		</div>
	</div>

	<div class="bp-toolbar">
		<a href="./index.php?action=status&func=db_rucoy&ro=MAPS" class="butList">MAPAS</a>
		<a href="./index.php?action=status&func=db_rucoy&ro=CRIATURAS" class="butList">CRIATURAS</a>
		<a href="./index.php?action=status&func=db_rucoy&ro=BOSSES" class="butList">BOSSES</a>
	</div>

	<div class="bp-scport-conf">
		<div class="d-flex">
			<?php if (_get( 'ro' ) == 'MAPS') { ?>
				<?php
					if(_get( 'ro_action' ) == 'edit') {
						$mapLocal = ro_listar_local('ro_maps','m_id',$_GET['ro_id']);

						$returnMapsNome 	= 'value="'. $mapLocal['m_nome'] .'"';
						$returnMapsDesc 	= $mapLocal['m_desc'];
						$returnMapsType 	= 'value="'. $mapLocal['m_type'] .'"';
						$returnMapsMonster 	= 'value="'. $mapLocal['m_monster'] .'"';
						$returnMapsNpc 		= 'value="'. $mapLocal['m_npcs'] .'"';
					}
				?>
				<div class="form-horizontal bord-r d-flex-1">
					<div class="form-group">
						<label for="m_image" class="control-label">Imagem</label>
						<div class="control-divider">
							<input type="file" id="m_image" name="m_image" />
						</div>
					</div>

					<div class="form-group">
						<label for="m_nome" class="control-label">Nome</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="m_nome" name="m_nome" <?= $returnMapsNome; ?> required>
						</div>
					</div>

					<div class="form-group">
						<label for="m_desc" class="control-label">Descrição</label>
						<div class="control-divider">
							<textarea class="input-control" id="m_desc" name="m_desc"><?= $returnMapsDesc; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="m_type" class="control-label">Tipo</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="m_type" name="m_type" <?= $returnMapsType; ?> required>
						</div>
					</div>

					<div class="form-group">
						<label for="m_monster" class="control-label">Monstros</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="m_monster" name="m_monster" <?= $returnMapsMonster; ?> required>
						</div>
					</div>

					<div class="form-group">
						<label for="m_npcs" class="control-label">NPCs</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="m_npcs" name="m_npcs" <?= $returnMapsNpc; ?> required>
						</div>
					</div>
				</div>

				<div class="d-flex-1">
					<div class="form-horizontal">
						<table class="plug-listTable">
							<thead>
								<tr>
									<th>:ID:</th>
									<th>Nome</th>
									<th>Tipo</th>
									<th>AÇÃO</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$list = ro_listar_db('ro_maps');
									foreach ($list as $ro_query) {
										echo '<tr>';
										echo '<td>'. $ro_query->m_id .'</td>';
										echo '<td>'. $ro_query->m_nome .'</td>';
										echo '<td>'. $ro_query->m_type .'</td>';
										echo '<td>
												<a href="./index.php?action=status&func=db_rucoy&ro=MAPS&ro_action=edit&ro_id='. $ro_query->m_id .'" class="butList">Editar</a>
												<a href="#" class="butList">Apagar</a>
											  </td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }  elseif (_get( 'ro' ) == 'CRIATURAS') { ?>
				<div class="form-horizontal bord-r d-flex-1">
					<div class="form-group">
						<label for="m_image" class="control-label">Imagem</label>
						<div class="control-divider">
							<input type="file" id="m_image" name="m_image" />
						</div>
					</div>

					<div class="d-flex">
						<div class="form-group d-flex-1">
							<label for="c_nome" class="control-label">Nome</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="c_nome" name="c_nome" required>
							</div>
						</div>

						<div class="form-group d-flex-1">
							<label for="c_leve" class="control-label">Level</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="c_leve" name="c_leve" required>
							</div>
						</div>
					</div>

					<div class="d-flex">
						<div class="form-group d-flex-1">
							<label for="c_hp" class="control-label">HP</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="c_hp" name="c_hp" required>
							</div>
						</div>

						<div class="form-group d-flex-1">
							<label for="c_xp" class="control-label">XP</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="c_xp" name="c_xp" required>
							</div>
						</div>
					</div>

					<div class="d-flex">
						<div class="form-group d-flex-1">
							<label for="c_drop" class="control-label">Drop</label>
							<div class="control-divider">
								<input type="text" class="input-control" id="c_drop" name="c_drop" required>
							</div>
						</div>

						<div class="form-group d-flex-1">
							<label for="m_npcs" class="control-label">Spawn</label>
							<div class="control-divider">
								<select id="c_spawn" name="c_spawn" class="select-control">	
									<?php
										$list = ro_listar_db('ro_maps');
										foreach ($list as $ro_query) {
											echo '<option value="'. $ro_query->m_id .'">'. $ro_query->m_nome .'</option>';
										}
									?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="c_desc" class="control-label">Descrição</label>
						<div class="control-divider">
							<textarea class="input-control" id="c_desc" name="c_desc"></textarea>
						</div>
					</div>
				</div>

				<div class="d-flex-1">
					<div class="form-horizontal">
						<table class="plug-listTable">
							<thead>
								<tr>
									<th>:ID:</th>
									<th>Nome</th>
									<th>Level</th>
									<th>Spawn</th>
									<th>AÇÃO</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$list = ro_listar_db('ro_criaturas');
									foreach ($list as $ro_query) {
										echo '<tr>';
										echo '<td>'. $ro_query->c_id .'</td>';
										echo '<td>'. $ro_query->c_nome .'</td>';
										echo '<td>'. $ro_query->c_leve .'</td>';
										echo '<td>'. ro_mapsLocal($ro_query->c_spawn) .'</td>';
										echo '<td><a href="#">Editar</a><a href="#">Apagar</a></td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }  elseif (_get( 'ro' ) == 'BOSSES') { ?>
				<div class="form-horizontal">
					<div class="form-group">
						<label for="m_image" class="control-label">Imagem</label>
						<div class="control-divider">
							<input type="file" id="m_image" name="m_image" />
						</div>
					</div>

					<div class="form-group">
						<label for="b_nome" class="control-label">Nome</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="b_nome" name="b_nome" required>
						</div>
					</div>

					<div class="form-group">
						<label for="b_cn" class="control-label">Dungeon</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="b_cn" name="b_cn" required>
						</div>
					</div>

					<div class="form-group">
						<label for="b_drop" class="control-label">Drop</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="b_drop" name="b_drop" required>
						</div>
					</div>
				</div>
			<?php } else {echo 'Plugin por: <i>Pedro Quezado</i>.';} ?>
		</div>

		<input type="hidden" name="wfox_func" value="<?= $_GET['func'] ?>">
		<input type="hidden" name="wfox_form" value="insertBD">
		<input type="hidden" name="return_ro" value="<?= _get( 'ro' ) ?>">
	</div>
</form>
