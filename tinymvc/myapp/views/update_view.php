<div class="row">
	<h2 class="form-signin-heading">Update Your Data</h2>
</div>
<div class="row">
	<div class="col-md-6">
		<h3> Change your image </h3>
		<center>
			<img src=<?php echo TMVC_BASEURL.'/img/'.htmlspecialchars($data['user'], ENT_QUOTES, 'UTF-8').'.png'; ?> class="img-rounded img-responsive" />	
		</center>
		<form action='<?=TMVC_BASEURL?>/users/imageUpdate' class="form-signin" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" accept="image/*" id="fileToUpload" 
				class="form-control" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="Reg" value="true">Submit</button>
		</form>
	</div>
	<div class="col-md-6">
		<h3 class="form-signin-heading">Change your data</h3>
		<form action='<?=TMVC_BASEURL?>/users/userUpdate' class="form-signin" method="POST" enctype="multipart/form-data">
		
	<!-- 		<h2 class="form-signin-heading"> User Data </h2>

	 -->
			<input type="text" name="user" id="inputUser" class="form-control"
			value=<?php echo  htmlspecialchars($data['user'], ENT_QUOTES, 'UTF-8'); ?> autofocus required>
		
			<input type="text" name="username" id="inputName" class="form-control" placeholder="Name"  
			value=<?php echo  htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'); ?> >

			<input type="text" name="userlastname" id="inputName" class="form-control" 
			value=<?php echo  htmlspecialchars($data['lastname'], ENT_QUOTES, 'UTF-8'); ?> >

			<input type="email" name="email" id="inputRepassword" class="form-control" 
			value=<?php echo  htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?> >
		
		
			<br>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="Reg" value="true">Submit</button>
		</form>
		<?php if(isset($msgerror)) echo $msgerror; ?>
	</div>
</div>

<div class="row">
	
	<div class="col-md-6">
		<h3 class="form-signin-heading">Change your password</h3>
		<form action='<?=TMVC_BASEURL?>/users/passwordUpdate' class="form-signin" method="POST" enctype="multipart/form-data">
			<label for="inputPasswordReg" class="sr-only">Password</label>
			<input type="password" name="pass" id="inputPasswordReg" class="form-control" 
			placeholder="Password" <?php //echo "value=".$data['pass']; ?> required>

			<label for="inputRepassword" class="sr-only">Re-type password</label>
			<input type="password" name="repass" id="inputRepassword" class="form-control" 
			placeholder="Re-type password" <?php //echo "value=".$data['pass']; ?> required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="Reg" value="true">Submit</button>
		</form>
	</div>
</div>
<br>
<div class="row">
	<form method="post" action='<?=TMVC_BASEURL?>/users/menu'>
		<button class="btn " type="submit" value="Menu">Menu</button>
	</form>
</div>
