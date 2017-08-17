<!DOCTYPE html>
<html lang="<?php blog_info('language'); ?>">
<head>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noodp">
	<title><?php blog_info('name'); ?></title>
	<link href="<?php get_style(); ?>" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?= get_icon('png'); ?>" type="image/x-icon">
</head>
<body id="theme-vip">
	<header id="vip-header">
		<div class="vh-up n_w">
			<div class="hedaer-logo">
				<a href="<?php blog_info('url') ?>"><?php blog_info('name'); ?></a>
			</div>
			<div class="float-r">
				<div class="fb-plug">
					<iframe name="f21e8f925b954" width="330px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/plugins/like.php?action=like&amp;channel=<?php blog_info('url') ?>&amp;container_width=0&amp;href=<?php blog_info('url') ?>&amp;layout=button_count&amp;locale=pt_BR&amp;sdk=joey&amp;share=true&amp;show_faces=false&amp;width=330" style="border: none; visibility: visible; width: 190px; height: 20px;" class=""></iframe>
				</div>
				<div class="header-search">
					<form action="<?php blog_info('url'); ?>" method="GET">
						<input type="text" class="s" name="s" placeholder="Pesquisar...">
						<button type="submit" class="icon-search"></button>
					</form>
				</div>
			</div>
		</div>
		<div class="vh-down">
			<nav>
				<ul class="n_w">
					<li class="<?= page_active(); ?>">
						<a href="<?php blog_info('url'); ?>">Início</a>
					</li>
					<li class="<?= page_active('news'); ?>">
						<a href="<?php blog_info('url'); ?>/news">Notícias</a>
					</li>
					<li class="<?= page_active('sobre'); ?>">
						<a href="<?php blog_info('url'); ?>/sobre">Sobre</a>
					</li>
					<li class="<?= page_active('contato'); ?>">
						<a href="<?php blog_info('url'); ?>/contato">Contato</a>
					</li>
				</ul>
			</nav>
		</div>
	</header>