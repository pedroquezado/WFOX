<!DOCTYPE html>
<html lang="<?php blog_info('language'); ?>">
<head>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noodp">
	<title><?php blog_info('name'); ?></title>
	<link href="<?php get_style(); ?>" rel="stylesheet" type="text/css" />
</head>
<body id="wfox">
	<div id="wfox-header">
		<div class="wrapper overflow-a">
			<div class="theme-logo float-l">
				<a href="<?php blog_info('url'); ?>"><?php blog_info('name'); ?></a>
			</div>
			<div class="theme-menu-list float-r">
				<ul>
					<li>
						<a href="#">About</a>
					</li>
					<li>
						<a href="#">Contact US</a>
					</li>
					<li class="search_blog position-r">
						<form action="<?php blog_info('url'); ?>" method="GET">
							<input class="d_fd" id="s" name="s" placeholder="Pesquisar..." type="text">
							<input class="ok_search" src="<?php blog_info('url_theme'); ?>/images/btn-busca.png" type="image">
						</form>
					</li>
				</ul>
			</div>
		</div>
	</div>