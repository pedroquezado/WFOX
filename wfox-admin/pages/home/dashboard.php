<div class="pBox-right float-r">
	<div class="boxPost-newElement">
		<div class="bp-import overflow-a shadow">
			<div class="page-desc float-l">Dashboard</div>
		</div>
		<div class="bp-scport-dashboard">
			<div id="dashboard">
				<div class="d-flex-boxs">
					<div class="df-left">
						<div class="dbox-cont">
							<div class="dbc-title">Estatísticas</div>
							<div class="dbc-table d-flex">
								<div class="box-stats-l d-flex-1">
									<div class="bs-iYu d-flex">
										<div class="bsi-t d-flex-1">
											<p class="bsi-to"><?= count_posts(); ?></p>
											<p>Posts </p>
										</div>
										<div class="bsi-k d-flex-1">
											<?php
												$aGraphData = Array
													(array(reg_data(6), count_posts(reg_data(6,'date')), 'f'),
													 array(reg_data(5), count_posts(reg_data(5,'date')), 'f'),
													 array(reg_data(4), count_posts(reg_data(4,'date')), 'f'),
													 array(reg_data(3), count_posts(reg_data(3,'date')), 'f'),
													 array(reg_data(2), count_posts(reg_data(2,'date')), 'f'),
													 array(reg_data(1), count_posts(reg_data(1,'date')), 'f'),
													 array(reg_data(), count_posts(reg_data('a', 'date')), 'f'),
													);

												echo '<ul class="chart">' . phpHtmlChart($aGraphData, 45, 'px') . '</ul>';
											?>
										</div>
									</div>

									<div class="bs-iYu d-flex">
										<div class="bsi-t d-flex-1">
											<p class="bsi-to"><?= count_categorys(); ?></p>
											<p>Categorias </p>
										</div>
										<div class="bsi-k d-flex-1">
											<?php
												$aGraphData = Array
													(array(reg_data(6), count_categorys(reg_data(6)), 'f'),
													 array(reg_data(5), count_categorys(reg_data(5)), 'f'),
													 array(reg_data(4), count_categorys(reg_data(4)), 'f'),
													 array(reg_data(3), count_categorys(reg_data(3)), 'f'),
													 array(reg_data(2), count_categorys(reg_data(2)), 'f'),
													 array(reg_data(1), count_categorys(reg_data(1)), 'f'),
													 array(reg_data(), count_categorys(reg_data()), 'f'),
													);

												echo '<ul class="chart">' . phpHtmlChart($aGraphData, 45, 'px') . '</ul>';
											?>
										</div>
									</div>
								</div>
								<div class="box-stats-r d-flex-1">
									<div class="bs-iYu d-flex">
										<div class="bsi-t d-flex-1">
											<p class="bsi-to">14</p>
											<p>Páginas </p>
										</div>
										<div class="bsi-k d-flex-1">
											<?php
												$aGraphData = Array
													(array('Apples', 25, 'f'),
													 array('Oranges', 50, 'f'),
													 array('Limes', 15, 'f'),
													 array('Grapes', 11, 'f'),
													 array('Mangos', 32, 'f'),
													 array('Bannans', 17, 'f'),
													 array('Star Fruits', 32, 'f'),
													);

												echo '<ul class="chart">' . phpHtmlChart($aGraphData, 45, 'px') . '</ul>';
											?>
										</div>
									</div>

									<div class="bs-iYu d-flex">
										<div class="bsi-t d-flex-1">
											<p class="bsi-to"><?= count_users(); ?></p>
											<p>Usuários </p>
										</div>
										<div class="bsi-k d-flex-1">
											<?php
												$aGraphData = Array
													(array(reg_data(6), count_users(reg_data(6)), 'f'),
													 array(reg_data(5), count_users(reg_data(5)), 'f'),
													 array(reg_data(4), count_users(reg_data(4)), 'f'),
													 array(reg_data(3), count_users(reg_data(3)), 'f'),
													 array(reg_data(2), count_users(reg_data(2)), 'f'),
													 array(reg_data(1), count_users(reg_data(1)), 'f'),
													 array(reg_data(), count_users(reg_data()), 'f'),
													);

												echo '<ul class="chart">' . phpHtmlChart($aGraphData, 45, 'px') . '</ul>';
											?>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="dbox-cont">
							<div class="dbc-title">Últimos Usuários Cadastrados</div>
							<div class="dbc-table d-flex">
								<table class="table-pLines">
									<tbody>
										<?php
											$bc_lUsers = $pdo->prepare("SELECT * FROM `users` ORDER BY `u_id` DESC LIMIT 5");
											$bc_lUsers->execute();

											if($bc_lUsers->rowCount() > 0){
												while($linhaLUsers = $bc_lUsers->fetch(PDO::FETCH_ASSOC)) {
													echo 	'<tr>
																<td>' . $linhaLUsers['u_nome'] . ' ' . $linhaLUsers['u_sobrenome'] . '</td>
																<td>' . $linhaLUsers['u_email'] . '</td>
															</tr>';	
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="df-right">
						<div class="dbox-cont">
							<div class="dbc-title">Últimos Posts</div>
							<div class="dbc-table d-flex">
								<table class="table-pLines">
									<tbody>
										<?php
											$bc_lPosts = $pdo->prepare("SELECT * FROM `posts`  WHERE `p_visibilidade`=? OR `p_visibilidade`=? AND `p_type`=? ORDER BY p_data DESC, p_hora DESC LIMIT 5");
											$bc_lPosts->execute(array('V','P','post'));

											if($bc_lPosts->rowCount() > 0){
												while($linhaLPosts = $bc_lPosts->fetch(PDO::FETCH_ASSOC)) {
													echo 	'<tr>
																<td class="ellipsis">' . $linhaLPosts['p_titulo'] . '</td>
																<td>' . date('d/m/Y', strtotime($linhaLPosts['p_data']) ) . '</td>
															</tr>';	
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>