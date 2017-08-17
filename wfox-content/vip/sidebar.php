<div class="sidbar-glow">
	<?php
		$verificPost = get_post( _view(0) );
		if ( get_ifpost($verificPost) ) :
	?>
		<div class="home-sider minimal-box">
			<div class="desc-post-author">
				<a href="#">
					<img src="<?= get_author_thumb($verificPost['p_uid']); ?>">
				</a>
				<div class="dpa-line">
					<div class="_0as">
						<div class="_3rg">
							<div class="_oab04">por <b><?= get_author($verificPost['p_uid']); ?></b></div>
							<span class="_oab04"><?= date('d/m/Y', strtotime($verificPost['p_data']) ) . ' · ' . $verificPost['p_hora']; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>	
	<?php endif; ?>

	<?php
		$catPost = get_category();
		if ( $catPost ) :
	?>
	<div class="home-sider">
		<h2>Categorias</h2>
		<ul>
		<?php
			foreach($catPost as $cat):
				echo '<li><a href="' . linkCategory($cat->c_id) . '">' . convertCategory($cat->c_id) . '</a></li>';
			endforeach;
		?>
		</ul>
	</div>
	<?php endif; ?>

	<div class="home-sider">
		<h2>Fale conosco</h2>
		<a href="#">mail@provedor.com</a>
	</div>
</div>