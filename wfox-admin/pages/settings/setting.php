<div class="pBox-right float-r">
	<div class="boxPost-newElement">
		<form method="post" action="<?php echo WFOX_SITE_URL; ?>/define_log.php">
			<div class="bp-import overflow-a shadow">
				<div class="page-desc float-l">
					Perfil do site
					<span class="load-reload"></span>
				</div>
				<div class="page-buttons float-r">
					<div class="but-list overflow-a">
						<input type="submit" class="cButton but-sav"  value="SALVAR CONFIGURAÇÕES">
					</div>
				</div>
			</div>
			<div class="bp-scport-conf">
				
				<div class="form-horizontal">
					<div class="form-group">
						<label for="s_nome" class="control-label">Título do site</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="s_nome" name="s_nome" value="<?php echo WFOX_SITE_NAME; ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="s_resumo" class="control-label">Resumo do site</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="s_resumo" name="s_resumo" value="<?php echo WFOX_SITE_RESUMO; ?>" required>
							<p class="form-setting no-select">Em poucas palavras, explique sobre o que é esse site.</p>
						</div>
					</div>

					<div class="divider-form-group"></div>

					<div class="form-group">
						<label for="s_endereco" class="control-label">Endereço do site</label>
						<div class="control-divider">
							<input type="text" class="input-control" id="s_endereco" name="s_endereco" value="<?php echo WFOX_SITE_URL; ?>" disabled required>
							<p class="form-setting no-select">Compre um domínio personalizado, mapeie um domínio existente ou redirecione esse site.</p>
						</div>
					</div>

					<div class="divider-form-group"></div>

					<div class="form-group">
						<label for="s_idioma" class="control-label">Idioma</label>
						<div class="control-divider">
							<select class="select-control" name="s_idioma" id="s_idioma">
							    <optgroup label="Idiomas populares">
							        <option value="en" <?php if(WFOX_SITE_IDIOMA == 'en'){echo 'selected'; } ?>>en - English</option>
							        <option value="es" <?php if(WFOX_SITE_IDIOMA == 'es'){echo 'selected'; } ?>>es - Español</option>
							        <option value="pt-br" <?php if(WFOX_SITE_IDIOMA == 'pt-br'){echo 'selected'; } ?>>pt-br - Português do Brasil</option>
							        <option value="de" <?php if(WFOX_SITE_IDIOMA == 'de'){echo 'selected'; } ?>>de - Deutsch</option>
							        <option value="fr" <?php if(WFOX_SITE_IDIOMA == 'fr'){echo 'selected'; } ?>>fr - Français</option>
							        <option value="he" <?php if(WFOX_SITE_IDIOMA == 'he'){echo 'selected'; } ?>>he - עִבְרִית</option>
							        <option value="ja" <?php if(WFOX_SITE_IDIOMA == 'ja'){echo 'selected'; } ?>>ja - 日本語</option>
							        <option value="it" <?php if(WFOX_SITE_IDIOMA == 'it'){echo 'selected'; } ?>>it - Italiano</option>
							        <option value="nl" <?php if(WFOX_SITE_IDIOMA == 'nl'){echo 'selected'; } ?>>nl - Nederlands</option>
							        <option value="ru" <?php if(WFOX_SITE_IDIOMA == 'ru'){echo 'selected'; } ?>>ru - Русский</option>
							        <option value="tr" <?php if(WFOX_SITE_IDIOMA == 'tr'){echo 'selected'; } ?>>tr - Türkçe</option>
							        <option value="id" <?php if(WFOX_SITE_IDIOMA == 'id'){echo 'selected'; } ?>>id - Bahasa Indonesia</option>
							        <option value="zh-cn" <?php if(WFOX_SITE_IDIOMA == 'zh-cn'){echo 'selected'; } ?>>zh-cn - 简体中文</option>
							        <option value="zh-tw" <?php if(WFOX_SITE_IDIOMA == 'zh-tw'){echo 'selected'; } ?>>zh-tw - 繁體中文</option>
							        <option value="ko" <?php if(WFOX_SITE_IDIOMA == 'ko'){echo 'selected'; } ?>>ko - 한국어</option>
							        <option value="ar" <?php if(WFOX_SITE_IDIOMA == 'ar'){echo 'selected'; } ?>>ar - العربية</option>
							        <option value="sv" <?php if(WFOX_SITE_IDIOMA == 'sv'){echo 'selected'; } ?>>sv - Svenska</option>
							    </optgroup>
							</select>
							<p class="form-setting no-select">Idioma em que esse blog é normalmente escrito.</p>
						</div>
					</div>

					<div class="form-group">
						<label for="s_postbypage" class="control-label">Post por página</label>
						<div class="control-divider">
							<select class="select-control" name="s_postbypage" id="s_postbypage">
								<option value="5" <?php if(WFOX_SITE_TOTALPAGE == '5'){echo 'selected'; } ?>>5</option>
								<option value="10" <?php if(WFOX_SITE_TOTALPAGE == '10'){echo 'selected'; } ?>>10</option>
								<option value="15" <?php if(WFOX_SITE_TOTALPAGE == '15'){echo 'selected'; } ?>>15</option>
								<option value="20" <?php if(WFOX_SITE_TOTALPAGE == '20'){echo 'selected'; } ?>>20</option>
								<option value="25" <?php if(WFOX_SITE_TOTALPAGE == '25'){echo 'selected'; } ?>>25</option>
							</select>
							<p class="form-setting no-select">Informe a quantidade de publicações por página.</p>
						</div>
					</div>
				</div>
				<input type="hidden" name="wfox_api" value="config">
				<input type="hidden" name="wfox_form" value="geral">
				
			</div>
		</form>
	</div>
</div>