<!DOCTYPE html>
<html lang="<?php blog_info('language'); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noodp">

	<title>.::<?php blog_info('name'); ?>::.</title>
	
	<script src="<?= get_bloginfo('url_theme'); ?>/assets/js/jquery-1.7.2.min.js"></script>
	<script src="<?= get_bloginfo('url_theme'); ?>/assets/js/jquery-ui-1.8.21.custom.min.js"></script>
	<script src="<?= get_bloginfo('url_theme'); ?>/assets/js/loadApp.js"></script>

	<link href="<?php get_style(); ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?= get_bloginfo('url_theme'); ?>/assets/style/w3.css">

	<link href="//fonts.googleapis.com/css?family=Open%20Sans:300italic,400italic,600italic,700italic,400,300,600,700,800" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Open%20Sans:400,300,600,700" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<div class="max_width h_header">
			<div class="logo">
				<a href="./">
					<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/logo.png">
				</a>
			</div>
			<div class="header_boxRight">
				<div class="br_lines">
					<div class="produtos">
						<div class="prod_link dropdown">
							<span>Menu</span>
							<div class="dropdown-content">
								<ul>
									<li><a href="<?= get_bloginfo('url'); ?>">Início</a></li>
									<li><a href="<?= get_bloginfo('url'); ?>/sobre">Quem somos</a></li>
									<li><a href="<?= get_bloginfo('url'); ?>/clientes">Clientes</a></li>
									<li><a href="<?= get_bloginfo('url'); ?>/contato">Contato</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="produtos">
						<div class="prod_link">Produtos</div>
					</div>
				</div>
				<form method="GET">
					<input type="text" name="q" placeholder="O que você procura?">
					<button>Buscar</button>
				</form>
			</div>
		</div>
	</header>
	<div id="content">