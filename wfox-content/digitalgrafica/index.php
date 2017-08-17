<?php get_header(); ?>
	<div id="content">
		<!-- SLIDER -->
		<div class="slider">
			<div class="w3-content w3-display-container">
				<div class="slider_w slider-01 mySlides w3-animate-opacity">
					<div class="max_width slider_info si_right">
						<div class="f40 f_bold">Impressão digital e offset</div>
						<div class="f25">com os melhores preços do Brasil.</div>
						<div class="si_button">Confira aqui</div>
					</div>
				</div>

				<div class="slider_w slider-02 mySlides w3-animate-opacity">
					<div class="max_width slider_info si_left c_blue">
						<div class="f40 f_bold">Impressão digital e offset</div>
						<div class="f25">com os melhores preços do Brasil.</div>
						<div class="si_button c_blue">Confira aqui</div>
					</div>
				</div>

				<button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
				<button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
			</div>
		</div>

		<!-- DESCWORK -->
		<div class="dg_descWork">
			<div class="max_width display_flex">
				<div class="bloc1 d_flex1">
					<div class="b_image">
						<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/quality.svg">
					</div>
					<div class="b_desc">
						<div class="bd_title">Impressão de qualidade</div>
						<div class="bd_border"></div>
						<div class="bd_desc">Tintas. Papel grosso. Cortes precisos. Acreditamos que a impressão de qualidade é importante.</div>
					</div>
				</div>

				<div class="bloc1 d_flex1">
					<div class="b_image">
						<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/sale.svg">
					</div>
					<div class="b_desc">
						<div class="bd_title">Vendas selecionadas</div>
						<div class="bd_border"></div>
						<div class="bd_desc">O preço praticado pela Digital Gráfica é pensado para que você tenha uma boa margem.</div>
					</div>
				</div>

				<div class="bloc1 d_flex1">
					<div class="b_image">
						<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/timer.svg">
					</div>
					<div class="b_desc">
						<div class="bd_title">Melhor entrega</div>
						<div class="bd_border"></div>
						<div class="bd_desc">É rápida porque todo o processo da gráfica tem foco na otimização de tempo. Tudo pensado para agilizar a entrega do seu material.</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ALTA -->
		<div class="listIndex max_width">
			<div class="list_marg">
				<div class="l_words">
					<div id="lwOfer" class="lw_titulo active">Ofertas</div>
					<div id="lwProm" class="lw_titulo">Promoção</div>
				</div>

				<div class="_lw">
					<div class="l_offs _lwOfer w3-animate-fading_2 _view">
						<ul>
							<?php for($i=0; $i < 8; $i++){ ?>
							<li>
								<div class="lo_title">Cartão de visita</div>
								<div class="lo_image">
									<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/sales/fbcard.jpg">
								</div>
								<div class="lo_sale">
									<span class="sale_p">A partir de</span>
									<span class="sale_value">R$ 60,00</span>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>

					<div class="l_offs _lwProm w3-animate-fading_2 _viewNone">
						<ul>
							<?php for($i=0; $i < 8; $i++){ ?>
							<li>
								<div class="lo_title">Panfletos</div>
								<div class="lo_image">
									<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/sales/fflyeu.jpg">
								</div>
								<div class="lo_sale">
									<span class="sale_p">A partir de</span>
									<span class="sale_value">R$ 65,00</span>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="li_separator"></div>

			<div class="list_marg_post">
				<div class="lp_title">Notícias principais</div>
				<div class="lp_list">
					<ul>
						<?php for($i=0; $i < 2; $i++){ ?>
						<li style="background-image: url(<?= get_bloginfo('url_theme'); ?>/assets/images/posts/post_01.jpg);" >
							<div class="lpl_as">
								<div class="lpl_num">
									<div class="_lpTitle">Laminação fosca: o que é e para que serve</div>
									<div class="_lpDesc">Os impressos promocionais representam mais de 8% da produção gráfica no Brasil, enquanto..</div>
									<div class="_lpData">21/07/17</div>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="responseIndex">
			<div class="max_width">
				<div class="list_response">
					<div class="lp_title">
						<div class="min_lp">Depoimentos</div>
						<div>Dos nossos clientes</div>
						<div class="divisore_lp">
							<div class="divsor"></div>
							<div class="divsorGlobe">
								<div></div>
							</div>
						</div>
					</div>

					<div class="dep_list">
						<div class="dep_01">
							<div class="_dep">
								<span class="_asps">"</span>
								<span>Vejo a Digital Gráfica como uma grande parceira que me ajudou a crescer ao longo destes quatro anos de convivência. Parabéns a todos que construíram esta grande história.</span>
								<span class="_asps">"</span>
							</div>
							<div class="_depUser">
								<span>Marcos Araujo, </span>
								<a href="http://www.materceirizacoes.com.br/" target="_blank">MAT</a>
							</div>
						</div>
					</div>

					<div class="dep_formd">
						<ul>
							<?php
								for ($i=1; $i <= 6; $i++) { 
									echo '<li><img src="'.get_bloginfo('url_theme').'/assets/images/clientes/c_0'.$i.'.png" /></lu>';
								}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>