<p>Abaixo você deve digitar suas informações de conexão com o banco de dados. Se você não tem certeza quais são, contate sua hospedagem.</p>
<form id="connectServer" method="POST" action="">
	<div class="margBox">
		<table class="input-group">
			<tbody>
				<tr>
					<th><label for="database">Nome do Banco de Dados</label></th>
					<td><input type="text" name="database" required value="<?php echo $_SESSION['temp_db']; ?>"></td>
					<td><div class="desc-input">O nome do seu banco de dados que você deseja utilizar com o WFox.</div></td>
				</tr>
				<tr>
					<th><label for="user">Nome de usuário</label></th>
					<td><input type="text" name="user" required value="<?php echo $_SESSION['temp_user']; ?>"></td>
					<td><div class="desc-input">Usuário do seu banco de dados.</div></td>
				</tr>
				<tr>
					<th><label for="pass">Senha</label></th>
					<td><input type="text" name="pass" value="<?php echo $_SESSION['temp_pass']; ?>"></td>
					<td><div class="desc-input">Senha do seu banco de dados.</div></td>
				</tr>
				<tr>
					<th><label for="host">Servidor do banco de dados</label></th>
					<td><input type="text" name="host" required value="<?php echo $_SESSION['temp_host']; ?>"></td>
					<td><div class="desc-input">Você deve ser capaz de obter esta informação no seu servidor de hospedagem, caso <code>localhost</code> não funcione.</div></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="next-step">
		<input type="submit" class="cButton but-step" value="Conectar">
	</div>
	<input type="hidden" name="conn" value="connect">
</form>