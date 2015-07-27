<form action='<?=TMVC_BASEURL?>/users/validar' class="form-signin" method="POST" >
				
	<h2 class="form-signin-heading">Please Login</h2>

	<label for="inputUser" class="sr-only">User</label>
	<input type="text" name="user" id="inputUser" class="form-control" placeholder="User Name" required autofocus>

	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required>
	
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="Login" value="true">Log in</button>
</form>
<form action='<?=TMVC_BASEURL?>/users/validar' class="form-signin" method="POST">
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="Register" value="true">Register</button>
</form>
<?php if(isset($msgerror)) echo $msgerror; ?>