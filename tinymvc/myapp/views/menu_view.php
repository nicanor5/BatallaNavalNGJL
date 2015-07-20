<div class="row">
	<div class="col-md-12">
		<p>  Main menu </p> <br>
		<p> <?php if(isset($toView["mensaje"])) echo $toView["mensaje"]; ?> </p>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-12">
				<center>
					<h2> Welcome admiral <?php echo $data['lastname']; ?> </h2>
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
				<form method="post" action='<?=TMVC_BASEURL?>/users/statistics'>
					<button class="btn " type="submit" value="Stats">Statistics</button>
					<input type="hidden" name="activity" value="statistics">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/ranking'>
					<button class="btn " type="submit" value="Ranking">Ranking</button>
					<input type="hidden" name="activity" value="ranking">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/modifyUserData'>
					<button class="btn " type="submit" value="Modify">Modify register information</button>
					<input type="hidden" name="activity" value="modify_reg">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/logOut'>
					<button class="btn " type="submit" value="Logout">Log Out</button>
					<input type="hidden" name="activity" value="log_out">
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php 
				if ($data['type']==0) 
				{
					echo '<form method="post" action="<?=TMVC_BASEURL?>/admin/adminMenu">
							<button class="btn " type="submit" value="Admin">Administration menu</button>
							<input type="hidden" name="activity" value="admin_menu"></form>';
				}
				?>
			</div>
		</div>
		<br>
	</div>
</div>
