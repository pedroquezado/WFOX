<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, noarchive">
	
	<title><?= get_bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?= get_style(); ?>">
</head>
<body>
	<div id="content">
		<header>
			<div class="header-marg">
				<div class="head-boxTop">
					<div class="h-siteTitle">
						<?php
							$palavra = get_bloginfo('name');
							$prisn = substr($palavra,0,1);
						?>
						<a href="<?= get_bloginfo('url'); ?>" title="<?= $palavra; ?>">
							<div class="boxLogo"><?= $prisn; ?></div>
						</a>
					</div>
					<div class="h-search">
						<form action="<?php blog_info('url'); ?>" method="GET">
							<input type="text" class="s" name="s" placeholder="Pesquisar...">
							<input class="ok_search" src="<?php blog_info('url_theme'); ?>/assets/images/btn-busca.png" type="image">
						</form>
					</div>
				</div>
				<div class="head-boxBottom">
					<nav>
						<div class="nav-list">
							<div class="nlist list-menu">
								<h3>Menu</h3>
								<ul>
									<li>
										<a href="#">Início</a>
									</li>
									<li>
										<a href="#">Novidades</a>
									</li>
									<li>
										<a href="#">Sobre</a>
									</li>
									<li>
										<a href="#">Contato</a>
									</li>
								</ul>
							</div>
							<?php $categorys = get_category(); if( $categorys ) { ?>
							<div class="nlist list-category">
								<h3>Categorias</h3>
								<ul>
									<?php
										foreach($categorys as $cat){
											echo '<li><a href="' . linkCategory($cat->c_id) . '">' . convertCategory($cat->c_id) . '</a></li>';
										}
									?>
								</ul>
							</div>
							<?php } ?>
							<div class="nlist list-contact">
								<h3>Fale conosco</h3>
								<ul>
									<li>
										<a href="#">mail@provedor.com</a>
									</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<div class="cont-body">
			<div class="cont-head">
				<div class="ch-Subline">
					<a href="<?= get_bloginfo('url'); ?>"><h3><?= get_bloginfo('name'); ?></h3></a>
					<p>New WFox Themes Generation.</p>
					<a href="#" class="butLos">
						<div class="butLosA effect-all">Sobre nos</div>
					</a>
				</div>
			</div>
			<div class="cont-listForm">
				<div class="pagIndexTitle">
					<p>Saiba mais</p>
				</div>
				<div class="pagListPosts">
					<?php
						$total_reg = get_bloginfo('post_by_page');
						$posts = get_posts( $total_reg );
						if ( $posts ) : foreach($posts as $post):
					?>
					<div class="pagPost">
						<h3 class="titlePost"><?= $post->p_titulo ?></h3>
						<div class="descPost"><?= post_reduzi($post->p_desc, 300); ?></div>
						<a href="<?= get_link($post->p_link); ?>" class="linkPost">Saiba mais</a>
					</div>
					<div class="_dividerPost" ></div>
					<?php endforeach; endif; ?>
				</div>
				<div class="pagPagination"><?php pagination($total_reg); ?></div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="footer-sob">Privacidade e Termos</div>
		<div class="footer-bot"><?= get_bloginfo('name'); ?> © 2017</div>
	</div>
</body>
</html>