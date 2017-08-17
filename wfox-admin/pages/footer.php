<?php if(isset($_SESSION['user_id'])) { ?>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
var editor = document.getElementById("editor");

function formatDoc(sCmd, sValue) {
		document.execCommand(sCmd, false, sValue);
		editor.focus();
};

var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
var forePalette = $('.fore-palette');
var backPalette = $('.back-palette');

for (var i = 0; i < colorPalette.length; i++) {
		forePalette.append('<a href="#" onchange="formatDoc(\'forecolor\',' + colorPalette[i] + ')" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
		backPalette.append('<a href="#" onchange="formatDoc(\'backcolor\','	+ colorPalette[i] + ')" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
}
</script>
<div id="myModal" class="modal">
	<!-- Modal content -->
	<div class="modal-content">
		<div class="modal-header">
			<span class="close">Cancelar</span>
			<span class="add-file">Inserir</span>
			<h2>Biblioteca de mídia</h2>
		</div>
		<div class="modal-body">
			<div class="divider-class-select">
				<ul>
					<li id="mBoxFilterGallery" but-date="upload">UPLOAD</li>
					<li id="mBoxFilterGallery" but-date="gallery">Imagens</li>
				</ul>
			</div>
			<div class="box-modal-gener">
				<div id="progress">
					<dt></dt>
					<dd></dd>
				</div>
				<div class="upload-new-file">
					<div class="respal-clear">
						<div class="unf-bord">
							<img src="<?php echo WFOX_SITE_ADM; ?>/assets/images/icons/icon-cloud.svg">
							<div class="unf-subtitle">Upload arquivo!</div>
						</div>
						<form id="formulario" method="post" enctype="multipart/form-data" action="<?php echo WFOX_SITE_URL; ?>/define_log.php">
							<input type="file" id="upGalerryImagem" name="imagem" accept="image/*">
							<input type="hidden" name="wfox_api" value="upload">
							<input type="hidden" name="wfox_form" value="thumb_profile">
						</form>
					</div>
				</div>
				<div class="gallery-viewBox"></div>
			</div>
		</div>
	</div>
</div>
<script>
var modal = document.getElementById('myModal');
var btn   = document.getElementById("myBtn");
var span  = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
    $('body').css('overflow','hidden');
}
span.onclick = function() {
    modal.style.display = "none";
    $('body').removeAttr('style');
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    	$('body').removeAttr('style'); 
    }
}
</script>
<?php } ?>
</body>
</html>