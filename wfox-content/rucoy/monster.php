<?php
/*
File Name: Monstros
*/
?>

<?php get_header(); ?>
		<div class="cCenter">
			<div class="art-player">
				<div class="c_player01"></div>
			</div>
			<div class="glowLineBox">
				<div class="barPostTop"></div>
				<div class="inLine-04">
					<div class="barPostCenter">Criaturas</div>
				</div>
				<div class="contPostBox">
					<div class="_cP01">
						<div class="contLineDesc">
									<?php 
										switch (_get( 'value' )) {
											case 'criatura':
												include('monster/criatura.php');
												break;
											case 'bosses':
												include('monster/bosses.php');
												break;
											
											default:
												echo 	'<table class="criatura">
															<tbody>
																<tr>
																	<td>
																		<a href="' . get_bloginfo('url') . '/monstros?value=criatura">
																			<img src="' . get_bloginfo('url_theme') . '/assets/images/monster/pharaoh.gif">
																			<div>Criaturas</div>
																		</a>
																	</td>
																	<td>
																		<a href="' . get_bloginfo('url') . '/monstros?value=bosses">
																			<img src="' . get_bloginfo('url_theme') . '/assets/images/monster/bosses/general_krinok.gif">
																			<div>Bosses</div>
																		</a>
																	</td>
																</tr>
															</tbody>
														</table>';
												break;
										}
									?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>