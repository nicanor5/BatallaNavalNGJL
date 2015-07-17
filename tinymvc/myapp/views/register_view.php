<h2 class="form-signin-heading">Registration</h2>
<!-- <p> <?php //echo $_SESSION["mensaje"]; ?> </p> -->
<form action='<?=TMVC_BASEURL?>/users/userRegistration' class="form-signin" method="POST" enctype="multipart/form-data">
	
	<h2 class="form-signin-heading">Registration fields</h2>

	<label for="inputUser" class="sr-only">User name</label>
	<input type="text" name="user" id="inputUser" class="form-control" placeholder="User Name" required  autofocus>

	<label for="inputPasswordReg" class="sr-only">Password</label>
	<input type="password" name="pass" id="inputPasswordReg" class="form-control" placeholder="Password" required>

	<label for="inputRepassword" class="sr-only">Re-type password</label>
	<input type="password" name="repass" id="inputRepassword" class="form-control" placeholder="Re-type password" >
	
	<label for="inputName" class="sr-only">Name</label>
	<input type="text" name="username" id="inputName" class="form-control" placeholder="Name"  autofocus>

	<label for="inputLastName" class="sr-only">Last Name</label>
	<input type="text" name="userlastname" id="inputName" class="form-control" placeholder="Last Name" >

	<label for="inputRepassword" class="sr-only">Email</label>
	<input type="email" name="email" id="inputRepassword" class="form-control" placeholder="Email" >
	
	<label for="fileToUpload" class="sr-only">Image</label>
	<input type="file" name="fileToUpload" accept="image/*" id="fileToUpload" class="form-control" placeholder="Image" required>
	<!-- <input type='file' name='archivo_up' id="archivo_up" multiple=""> -->

	<button class="btn btn-lg btn-primary btn-block" type="submit" name="Reg" value="true">Sign In</button>
</form>
<?php if(isset($msgerror)) echo $msgerror; ?>