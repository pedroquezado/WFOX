<?php get_header(); ?>

<!-- VIP BODY -->
<div id="vip-content" class="_noListGroup">
	<div class="wrapper">
		<!-- VIP BODY CONTENT -->
		<div class="bg-content">
			
			<div class="content-glow">
				<?php 
					$post = get_post( $page );
				?>
				<div class="cglow-listPost view-post post-list-marg box-border">
					<div class="postStyle">
						<h3><?= $post['p_titulo']; ?></h3>
						<div class="sViewPost">
							<div><?= $post['p_desc']; ?></div>
							<div class="entry-meta"></div>
							<div class="list-fintCategory">
								<span class="entry-meta-label">Categoria:</span>
								<span>
									<?php
										$catPost = get_category($post['p_id']);
										if ( $catPost ) : foreach($catPost as $cat):
											echo '<a href="' . linkCategory($cat->pc_cat_id) . '">'.convertCategory($cat->pc_cat_id) . '</a> · ';
										endforeach; endif;
									?>
								</span>
							</div>
						</div>
					</div>
				</div>
				<?php
					$posts = post_related();
					if( $posts ):
				?>	
					<div class="page-related">
						<h2>Notícias relacionadas</h2>
						<?php
							foreach($posts as $pt):
								echo '<div class="related-box">';
								echo '<p>'.date('d, m, Y', strtotime($pt['p_data']) ).'</p>';
								echo '<h3><a href="'.get_link($pt['p_link']).'">'.$pt['p_titulo'].'</a></h3>';
								echo '</div>';
							endforeach;
						?>
					</div>
				<?php endif; ?>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>	

<?php get_footer(); ?>
