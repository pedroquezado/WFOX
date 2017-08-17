<div class="pBox-right float-r">
	<div class="boxPost-newElement height-100">
		<div class="bp-import overflow-a shadow">
			<div class="page-desc float-l">
				Galeria
			</div>
			<div class="page-buttons float-r">
				<div class="but-list overflow-a">
					<div id="btn" class="cButton but-red"></div>
				</div>
			</div>
		</div>
		<div class="bp-scport-gallery">
			<div class="gly-list">
				<div class="gList">Arquivos</div>
				<div class="data-gList">
					<?php
						$bc_thumb = $pdo->prepare("SELECT * FROM `upload_thumb` ORDER BY `ut_id` DESC limit 20");
						$bc_thumb->execute();

						if($bc_thumb->rowCount() > 0){
							while($linhaThumb = $bc_thumb->fetch(PDO::FETCH_ASSOC)) {
					?>
					<div class="lg-margThumb" data-thumb-id="<?php echo $linhaThumb['ut_id']; ?>">
						<div id="<?php echo $linhaThumb['ut_id']; ?>" class="thumbBox" title="<?php echo $linhaThumb['ut_name']; ?>">
							<div class="thumbImg" style="background-image: url(<?php echo getThumb($pdo,$linhaThumb['ut_file']); ?>);"></div>
							<div class="thumbName">
								<div class="nh-temp">
									<img src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-image-type.svg">
								</div>
								<div class="tnTemp">
									<span><?php echo $linhaThumb['ut_name']; ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php 
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>