<!doctype html>
<html>
	<head>
		<meta charset='utf8'>
		<link rel='stylesheet' href='<?=TMVC_BASEURL?>/css/rompecocos.css'>
	</head>
	<body>
		<form action='<?=TMVC_BASEURL?>/usuarios/validar' method='post'>
			<table>
				<tr>
					<td>Login:</td><td><input type='text' name='login'></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type='text' name='password'></td>
				</tr>
				<tr>
					<td></td><td><input type='submit' value='Ingresar'></td>
				</tr>
				<tr>
					<td colspan='2' class='centrado error'><?php if(isset($msgerror)) echo $msgerror;?></td>
				</tr>
			</table>
		</form>
	</body>
</html>