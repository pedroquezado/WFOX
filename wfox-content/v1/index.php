<?php get_header(); ?>
	<div id="wfox-home-content">
		<div class="div-lis-slider">
			<div class="dl-slide a-opacity glow-pink">
				<div class="dl-abs">
					<div class="dl-title">Welcome to my blog</div>
					<div class="display-b"></div>
					<div class="dl-subt"><?php wfox_info('description'); ?></div>
					<div class="display-b"></div>
					<a href="#">VIEW NOW</a>
				</div>
			</div>
		</div>
		<div class="div-const">
			<div class="wrapper d-flex">
				<div class="dc-post d-flex-2">
					<?php
						$bc_posts = $pdo->prepare("SELECT * FROM `posts` WHERE `p_visibilidade`=?");
						$bc_posts->execute(array('V'));
						$linhaPost = $bc_posts->fetchAll(PDO::FETCH_OBJ);
					?>
					<div class="dc-sub-list">
						<ul>
							<?php foreach($linhaPost as $post): ?>
							<li>
								<div class="post-title"><?= $post->p_titulo; ?></div>
								<div class="post-info"><?= date('d/m/Y', strtotime($post->p_data) ); ?> por Nícholas André</div>
								<div class="post-content">Na próxima sexta-feira, 28, acontece mais uma edição da Black Friday Brasil, evento que oferece 24 horas de descontos no varejo. Para evitar golpes na internet, é recomendável redobrar a atenção: ficar atento a possíveis sites falsos e verificar a idoneidade das páginas são atitudes importantes na hora de realizar a compra.</div>
								<div class="post-more float-r">
									<a href="#">Leia Mais</a>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="dc-sidbar d-flex-07">12</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>