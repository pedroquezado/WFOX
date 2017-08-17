<?php get_header(); ?>
		<div class="cCenter">
			<div class="art-player">
				<div class="c_player01"></div>
				<div class="c_player02"></div>
				<div class="c_player03"></div>
			</div>
			<div class="glowLineBox">
				<div class="sliderLineTop"></div>
				<div class="slideDesc">
					<div class="imageSlider" style="background-image: url(<?= get_bloginfo('url_theme'); ?>/assets/images/layer/slider1.jpg);">
						<div class="sdInfoPost">
							<h1>Update 1.14</h1>
							<p>PvP Arena, New Monsters, New Items, New Boss and more</p>
							<p class="sp_postInfo">16/03/2017</p>
						</div>
					</div>
				</div>
				<div class="sliderLineBotton"></div>
			</div>
			<div class="glowLineBox">
				<div class="barPostTop"></div>
				<div class="inLine-04">
					<div class="barPostCenter">Latest News</div>
				</div>
				<div class="contPostBox">
					<div class="_cP01">
						<div class="contLineDesc">
							<?php 
								$posts = get_posts( get_bloginfo('post_by_page'), 4 );
								if ( $posts ) : foreach($posts as $post): 
							?>
							<div class="linePost-List">
								<div class="postTop">
									<span class="postTitle"><?= $post->p_titulo; ?></span>
									<span class="postData"><?= date('d, m, Y', strtotime($post->p_data) ); ?></span>
								</div>
								<div class="postDescBot">
									<div><?= $post->p_desc; ?></div>								
								</div>
							</div>
							<?php endforeach; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
<?php get_footer(); ?>