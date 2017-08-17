<?php get_header(); ?>
<!-- VIP BODY -->
<div id="vip-content">
	<div class="wrapper">
		<!-- VIP BODY SLIDER -->
		<div class="bg-slider">
			<div class="box-lyer">
				<div class="b_loops">Principais notícias</div>
			</div>
			<div class="_ol99 box-border">
				<?php 
					$r_value = 4;
					$posts_slider = get_posts( $r_value );
					if ( $posts_slider ) : foreach($posts_slider as $post): 
				?>
					<div class="slider-glow a-opacity">
						<div class="glowBox-sliderLeft">
							<p><?= date('d, m, Y', strtotime($post->p_data) ); ?></p>
							<a href="<?= get_link($post->p_link); ?>">
								<h1><?php post_reduzi($post->p_titulo, 50); ?></h1>
							</a>
							<h3><?php post_reduzi($post->p_desc, 180); ?></h3>
							<a href="<?= get_link($post->p_link); ?>">Leia Mais</a>
						</div>
						<div class="glowBox-sliderRight" style="background-image: url(<?= get_thumb($post->p_thumb); ?>);"></div>
					</div>
				<?php endforeach; endif; ?>
			</div>

			<div class="glow-globs">
				<?php for($i=1; $i<=$r_value; $i++) { ?>
					<span class="glob-line box-badge" onclick="currentDiv(<?php echo $i; ?>)">•</span>
			    <?php } ?>
			</div>
		</div>

		<!-- VIP BODY CONTENT -->
		<div class="bg-content">
		
			<div class="content-glow box-border">
				<div class="cglow-title">
					<h3>Notícias e anúncios recentes</h3>
					<a href="<?php blog_info('url'); ?>/news">Ver todos</a>
				</div>
				<div class="cglow-listPost">
					<ul>
						<?php 
							$posts = get_posts( get_bloginfo('post_by_page'), 4 );
							if ( $posts ) : foreach($posts as $post): 
						?>
						<li class="postStyle">
							<p>
								<span><?= date('d, m, Y', strtotime($post->p_data) ); ?></span>
								· 
								<span class="slit_author"><?= get_author($post->p_uid); ?></span>
							</p>
							<h3>
								<a href="<?= get_link($post->p_link); ?>"><?= $post->p_titulo; ?></a>
							</h3>
						</li>
						<?php endforeach; endif; ?>
					</ul>
				</div>
			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>