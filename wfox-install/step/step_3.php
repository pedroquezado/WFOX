<h1>Informações necessárias</h1>
<p>Por favor, forneça as seguintes informações. Não se preocupe, você poderá alterar essas configurações mais tarde.</p>
<form id="configServer" method="POST" action="./install.php?step=conn&api=installWFox">
	<div class="margBox">
		<table class="input-group">
			<tbody>
				<tr>
					<th><label for="siteTitle">Titulo do site</label></th>
					<td><input type="text" name="siteTitle" required></td>
					<td><div class="desc-input"></div></td>
				</tr>
				<tr>
					<th><label for="siteUrl">URL do site</label></th>
					<td><input type="text" name="siteUrl" required></td>
					<td><div class="desc-input"></div></td>
				</tr>
			</tbody>
		</table>
		<div class="div-margLine"></div>
		<table class="input-group">
			<tbody>
				<tr>
					<th><label for="nameAdmin">Nome</label></th>
					<td><input type="text" name="nameAdmin" required></td>
					<td><div class="desc-input"></div></td>
				</tr>
				<tr>
					<th><label for="snameAdmin">Sobrenome</label></th>
					<td><input type="text" name="snameAdmin" required></td>
					<td><div class="desc-input"></div></td>
				</tr>
				<tr>
					<th><label for="passAdmin">Senha</label></th>
					<td><input type="text" name="passAdmin" required></td>
					<td><div class="desc-input">A senha será gerada automaticamente caso deixe esse campo em branco.</div></td>
				</tr>
				<tr>
					<th><label for="emailAdmin">Seu e-mail</label></th>
					<td><input type="text" name="emailAdmin" required></td>
					<td><div class="desc-input">Verifique duas vezes seu e-mail antes de continuar.</div></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="next-step">
		<input type="submit" class="cButton but-step" value="Instalar WFox">
	</div>
	<input type="hidden" name="install" value="installWFox">
</form>