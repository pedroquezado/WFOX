<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo WFOX_SITE_URL; ?>/wfox-icon.png" sizes="16x16 32x32" type="image/png">

    <title>WFOX | Painel Administrativo</title>

	<link rel="stylesheet" type="text/css" href="<?php echo WFOX_SITE_ADM; ?>/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo WFOX_SITE_ADM; ?>/assets/css/star.css">
	<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css">
	<link rel="stylesheet prefetch" href="https://fonts.googleapis.com/css?family=Dosis|Candal">

	<script type="text/javascript" src="<?php echo WFOX_SITE_ADM; ?>/assets/js/jquery.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo WFOX_SITE_ADM; ?>/assets/js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo WFOX_SITE_ADM; ?>/assets/js/function.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,400i,500,700,900" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/2.5.61/jodit.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jodit/2.5.61/jodit.min.js"></script>
	<script type="text/javascript">
		var url_adm = '<?php echo WFOX_SITE_ADM; ?>';
		var url_log = '<?php echo WFOX_SITE_URL; ?>';
	</script>
</head>
<body>
<?php if(isset($_SESSION['user_id'])) { ?>
<section id="painel-log">
	<div class="content-painel">
		<header class="cp-header">
			<div class="cph-logo ">
				<a href="<?php echo WFOX_SITE_ADM; ?>/">
					<img src="<?php echo WFOX_SITE_ADM; ?>/assets/images/logo-branco.svg">
				</a>
			</div>
			<div class="cph-navbar">
				<div class="navbar-content">
					<div class="nav-l">
						<div class="nav-but">
							<form action="" method="POST">
								<input type="hidden" name="wfox_api" value="post">
								<input type="hidden" name="wfox_form" value="pre-add">
								<input type="submit" class="cButton but-newp" value="+ Add Post">
							</form>
						</div>
					</div>
					<div class="nav-r">
						<div class="nav-sett">
							<div class="nav-dropdown">
								<button onclick="navMenuDrop()" class="dropbtn">
									<span><?php echo retornaDadosUser($pdo,$user_id,'nCompleto'); ?></span>
									<img class="icon-dropdown mLeft-5" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-dropdown.svg">
								</button>
								<div id="navMenuDrop" class="dropdown-content">
									<a href="#">Link 1</a>
									<a href="#">Link 2</a>
									<a href="<?php echo WFOX_SITE_ADM; ?>/logout.php">Sair</a>
								</div>
							</div>
							
						</div>
						<div class="nav-rWeb">
							<a href="<?php echo WFOX_SITE_URL; ?>" target="_blank">Visite o site</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="cp-pBox">
			<div class="pBox-divider overflow-a">
				<div id="pBox-menu" class="pBox-left float-l">
					<ul class="ul-lines-menu">
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>">
								<div class="but-raf tooltip butr-lt">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-fast.svg">
									<span class="tooltiptext tooltip-right">Dashboard</span>
								</div>
							</a>
						</li>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=posts">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-caneta.svg">
									<span class="tooltiptext tooltip-right">Publicação</span>
								</div>
							</a>
						</li>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=pages">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-page.svg">
									<span class="tooltiptext tooltip-right">Páginas</span>
								</div>
							</a>
						</li>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=gallery">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-image.svg">
									<span class="tooltiptext tooltip-right">Galeria</span>
								</div>
							</a>
						</li>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=theme">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-theme.svg">
									<span class="tooltiptext tooltip-right">Temas</span>
								</div>
							</a>
						</li>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=users">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-user.svg">
									<span class="tooltiptext tooltip-right">Usuários</span>
								</div>
							</a>
						</li>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=status">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-perf.svg">
									<span class="tooltiptext tooltip-right">Plugin</span>
								</div>
							</a>
						</li>
						<?php if($user_id && retornaDadosUser($pdo,$user_id,'role') == '1') {?>
						<li>
							<a href="<?php echo WFOX_SITE_ADM; ?>/index.php?action=settings">
								<div class="but-raf tooltip">
									<img class="svg" src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-conf.svg">
									<span class="tooltiptext tooltip-right">Configurações</span>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
<?php } ?>