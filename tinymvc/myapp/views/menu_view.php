<div class="row">
	<div class="col-md-12">
		<p>  Choose the battlefield dimensions </p> <br>
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
				<p>  Choose the battlefield dimensions </p> <br>
			</div>
		</div>		
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/batallanaval/init_field'>
					<button class="btn btn-fire" type="submit" value="Start">Set the fleet</button>
					<br>
					<select name="size">
						<option value="5"> A: 5x5 </option>
						<option value="6"> B: 6x6 </option>
					</select>
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/statistics'>
					<button class="btn " type="submit" value="Stats">Statistics</button>
					<input type="hidden" name="activity" value="modify_reg">
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action='<?=TMVC_BASEURL?>/users/ranking'>
					<button class="btn " type="submit" value="Ranking">Ranking</button>
					<input type="hidden" name="activity" value="modify_reg">
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


	</div>
</div>
