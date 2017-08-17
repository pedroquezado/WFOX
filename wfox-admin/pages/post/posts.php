<div class="pBox-right float-r">
	<div class="boxPost-newElement">
		<div class="bp-import overflow-a shadow">
			<div class="page-desc float-l">
				Publicações
				<span>
					<?php $selectLimitView = $_GET['pLimitView'];?>
					<select id="pLimitView" select-type-view="posts">
					    <option value="25" <?php if($selectLimitView == '25'){ echo 'selected';} ?>>25</option>
					    <option value="50" <?php if($selectLimitView == '50'){ echo 'selected';} ?>>50</option>
					    <option value="100" <?php if($selectLimitView == '100'){ echo 'selected';} ?>>100</option>
					    <option value="200" <?php if($selectLimitView == '200'){ echo 'selected';} ?>>200</option>
					</select>
				</span>
			</div>
		</div>
		<div class="bp-scport-posts">
			<table>
				<thead>
					<tr>
						<th class="tAlign-c">#</th>
						<th>Título</th>
						<th>Data</th>
						<th>Status</th>
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
						$bc_posts = $pdo->prepare("SELECT * FROM `posts` ORDER BY p_data DESC, p_hora DESC limit $pLimitView");
						$bc_posts->execute();

						if($bc_posts->rowCount() > 0){
							while($linhaPost = $bc_posts->fetch(PDO::FETCH_ASSOC)) {
					
					 ?>
					<tr class="listPost lPostID-<?php echo $linhaPost['p_id']; ?>">
						<td><div class="tb-vla"><?php echo $linhaPost['p_id']; ?></div></div></td>
						<td><div class="tb-vla"><?php echo $linhaPost['p_titulo']; ?></div></td>
						<td><div class="tb-vla"><?php echo date('d/m/Y', strtotime($linhaPost['p_data']) ); ?></div></td>
						<td><div class="tb-vla"><?php echo validStatPost($linhaPost['p_visibilidade']); ?></div></td>
						<td>
							<div class="tb-vla d-flex">
								<a class="d-flex-1 butList butList-edit" href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=edit-post&id_post=<?php echo $linhaPost['p_id']; ?>">Editar</a>
								<div class="d-flex-1 butList butList-delet" id-post-delet="<?php echo $linhaPost['p_id']; ?>">Apagar</div>
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