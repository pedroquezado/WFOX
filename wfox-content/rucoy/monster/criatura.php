<?php
	if(_get('ct')){
		$ct = $pdo->prepare("SELECT * FROM `ro_criaturas` WHERE `c_nome`=:c_nome");
		$ct->bindValue('c_nome',_get('ct'));
		$ct->execute();
		$listCT = $ct->fetch(PDO::FETCH_ASSOC);
?>
<div class="d-flex">
	<div class="d-flex-1">
		<div class="mt10"><?= $listCT['c_desc']; ?></div>
		<div class="articMaps">
			<div class="mTitle">Mapa</div>
			<div class="d-flex">
				<div class="d-flex-1 mGlowLine"><center><?= ro_mapsLocal($listCT['c_spawn']) ?></center></div>
				<div class="d-flex-1 mGlowLine"><?= '<img src="'. getThumb(null,ro_mapsImage($listCT['c_spawn'])) .'">'; ?></div>
			</div>
		</div>
	</div>
	<div class="d-flex-1 maxw-300">
		<div class="ib-bord">
			<div class="infoBoxLine">
				<h2><?= $listCT['c_nome'] ?></h2>
				<figure>
					<img src="<?= getThumb(null,$listCT['c_image']) ?>">
				</figure>
				<div class="ib-lineDesc">
					<h3>Level</h3>
					<div class="ib-h3"><?= $listCT['c_leve'] ?></div>
				</div>
				<div class="ib-lineDesc">
					<h3>Hitpoints</h3>
					<div class="ib-h3"><?= $listCT['c_hp'] ?></div>
				</div>
				<div class="ib-lineDesc">
					<h3>Exp.</h3>
					<div class="ib-h3"><?= $listCT['c_xp'] ?></div>
				</div>
				<div class="ib-lineDesc">
					<h3>Spawn</h3>
					<div class="ib-h3"><?= ro_mapsLocal($listCT['c_spawn']) ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php } else { ?>
<p class="pt-10">Vários <b>monstros</b> podem ser encontrados vagando pelo mundo, seja em cavernas, masmorras, desertos ou florestas. Após a morte, eles dropam <b>quantidades</b> variadas de <b>experiência</b>, <b>ouro</b> e <b>pilhagem</b>,  dependendo do monstro que está sendo combatido. Ser atacado por monstros aumenta sua <b>defesa</b> na classe que está sendo jogada atualmente. Além disso, os requisitos para matar um inimigo são dependentes do seu nível principal.</p>
<table class="criatura list_c">
	<thead>
		<tr>
			<th>Imagem</th>
			<th>Nome</th>
			<th>Level</th>
			<th>Pontos de vida</th>
			<th>Pontos de experiência</th>
			<th>Moeda derrubada</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$list = ro_listar_db('ro_criaturas');
			foreach ($list as $ro_query) {
				echo '<tr>';
				echo '<td><img src="'. getThumb(null,$ro_query->c_image) .'"></td>';
				echo '<td><a href="./monstros?value=criatura&ct='. $ro_query->c_nome .'">'. $ro_query->c_nome .'</td>';
				echo '<td>'. $ro_query->c_leve .'</td>';
				echo '<td>'. $ro_query->c_hp .'</td>';
				echo '<td>'. $ro_query->c_xp .'</td>';
				echo '<td>'. $ro_query->c_drop .'</td>';
				echo '</tr>';
			}
		?>
	</tbody>
</table>
<?php } ?>