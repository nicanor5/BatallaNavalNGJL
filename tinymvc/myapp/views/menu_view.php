<div class="row">
	<div class="col-md-12">
		<h2>  Main menu </h2> <br>
		<p> <?php if(isset($toView["mensaje"])) echo $toView["mensaje"]; ?> </p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<center>
					<h3> Welcome admiral <?php echo htmlspecialchars($data['lastname'], ENT_QUOTES, 'UTF-8'); ?> </h3>
				</center>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center>
					<img src=<?php echo TMVC_BASEURL.'/img/'.$data['user'].'.png'; ?> class="img-rounded img-responsive" />	
				</center>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/batallanaval/init_field'>
					<button class="btn btn-primary btn-fire" type="submit" value="Start">Set the fleet</button>
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/statistics'>
					<button class="btn btn-primary" type="submit" value="Stats">Statistics</button>
					<input type="hidden" name="activity" value="statistics">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/ranking'>
					<button class="btn btn-primary" type="submit" value="Ranking">Ranking</button>
					<input type="hidden" name="activity" value="ranking">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/modifyUserData'>
					<button class="btn btn-primary" type="submit" value="Modify">Modify register information</button>
					<input type="hidden" name="activity" value="modify_reg">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/logOut'>
					<button class="btn btn-primary" type="submit" value="Logout">Log Out</button>
					<input type="hidden" name="activity" value="log_out">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<?php 
				if ($data['type']==0) 
				{
					echo '<form method="post" action="' . TMVC_BASEURL . '/admin/adminMenu">
							<button class="btn btn-primary" type="submit" value="Admin">Administration menu</button>
							<input type="hidden" name="activity" value="admin_menu"></form>';
				}
				?>
			</div>
		</div>
		<br>
	</div>
</div>
