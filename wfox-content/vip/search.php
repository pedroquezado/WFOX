<?php get_header(); ?>

<!-- VIP BODY -->
<div id="vip-content" class="_noListGroup">
	<div class="wrapper">
		<!-- VIP BODY CONTENT -->
		<div class="bg-content">
			
			<div class="content-glow">
				<?php 
					$total_reg = get_bloginfo('post_by_page');
					$posts = get_posts( $total_reg, 0, null, $search_query );
					if ( $posts ) : foreach($posts as $post): 
				?>
				<div class="cglow-listPost post-list-marg box-border">
					<div class="postStyle">
						<p>
							<span><?= date('d, m, Y', strtotime($post->p_data) ); ?></span>
							· 
							<span class="slit_author"><?= get_author($post->p_uid); ?></span>
						</p>
						<h3>
							<a href="<?= get_link($post->p_link); ?>"><?= $post->p_titulo; ?></a>
						</h3>
						<div><?= post_reduzi($post->p_desc, 300); ?></div>
						<a href="#">Leia mais</a>
						<div class="entry-meta"></div>
						<div class="list-fintCategory">
							<span class="entry-meta-label">Categoria:</span>
							<span>
								<?php
									$catPost = get_category($post->p_id);
									if ( $catPost ) : foreach($catPost as $cat):
										echo '<a href="' . linkCategory($cat->pc_cat_id) . '">'.convertCategory($cat->pc_cat_id) . '</a> · ';
									endforeach; endif;
								?>
							</span>
						</div>
					</div>
				</div>
				<?php endforeach; else: ?>
					<div class="cglow-listPost post-list-marg box-border">
						<div class="postStyle no-find-page">
							<h1>Desculpe. Esta página não está disponível.</h1>
							<p>Pode ser que o link usado esteja quebrado ou a página tenha sido removida.</p>
							<p>Tente pesquisar o que você está procurando.</p>
						</div>
					</div>
				<?php endif; ?>

				<div class="page-pagination"><?php pagination($total_reg, null, $search_query); ?></div>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>	

<?php get_footer(); ?>
