		<div class="cRight">
			<div class="clinGlowR">
				<div class="dividerBoxLine">
					<div class="targMonster">
						<?php
							$rand = rand(1,19);
							switch ($rand) {
								case '1': $randResult_monster = 'rat'; break;
								case '2': $randResult_monster = 'grey_rat'; break;
								case '3': $randResult_monster = 'crow'; break;
								case '4': $randResult_monster = 'wolf'; break;
								case '5': $randResult_monster = 'scorpion'; break;
								case '6': $randResult_monster = 'cobra'; break;
								case '7': $randResult_monster = 'worm'; break;
								case '8': $randResult_monster = 'goblin'; break;
								case '9': $randResult_monster = 'mummy'; break;
								case '10': $randResult_monster = 'pharaoh'; break;
								case '11': $randResult_monster = 'assassin'; break;
								case '12': $randResult_monster = 'yellow_assassin'; break;
								case '13': $randResult_monster = 'zombie'; break;
								case '14': $randResult_monster = 'skeleton'; break;
								case '15': $randResult_monster = 'skeleton_archer'; break;
								case '16': $randResult_monster = 'skeleton_warrior'; break;
								case '17': $randResult_monster = 'vampire'; break;
								case '18': $randResult_monster = 'red_vampire'; break;
								case '19': $randResult_monster = 'drow_assassin'; break;
								case '19': $randResult_monster = 'drow_ranger'; break;
							}
						?>
						<img class="monster" src="<?= get_bloginfo('url_theme'); ?>/assets/images/monster/<?= $randResult_monster; ?>.gif">
						<img class="boxMonster" src="<?= get_bloginfo('url_theme'); ?>/assets/images/bar/blok-monster-c.svg">
					</div>
					<div class="blok-top-box"></div>
					<div class="contBoxRight">
						<div class="_cmt01">
							<div class="_cmtDesc">
								<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Frucoyonlineofficial%2F&amp;tabs&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=false&amp;appId" width="100%" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true"></iframe>
							</div>
						</div>
					</div>
					<div class="blok-botton-box"></div>
				</div>
				<div class="dividerBoxLine">
					<div class="blok-top-box"></div>
					<div class="contBoxRight">
						<div class="_cmt01">
							<div class="_cmtDesc">
								<img src="<?= get_bloginfo('url_theme'); ?>/assets/images/layer/reddit-rucoy.png">
							</div>
						</div>
					</div>
					<div class="blok-botton-box"></div>
				</div>
			</div>
		</div>