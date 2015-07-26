<center>
	<div class="row">
		<div class="col-md-12"> 
			<h2> The game has ended! </h2> 
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"> 
			<h2> 
			<?php
				switch ($toView["winner"]) 
				{
					case 1:
						$mensaje="Congratulations! You win admiral";
						break;
					case 2:
						$mensaje="You lose admiral! Better luck next time";
						break;
				}
			 echo $mensaje, "<br>";
			 ?>
			 </h2> 
		</div>
	</div>
	<div class="row row-centered">
		<div class="col-md-12"> 
			<table border=1>
				<tr>
					<td>
						<h3> Ships sunk by you </h3>
					</td>
					<td>
						<center>
							<h3><?php echo $toView["userHits"]; ?> </h3>
						</center>
					</td>
				</tr>
				<tr>
					<td>
						<h3>Ships sunk by the enemy </h3>
						
					</td>
					<td>
						<center>
							<h3><?php echo $toView["enemyHits"]; ?> </h3>
						</center>
					</td>
				</tr>
		</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4"> 
			<form method="post" action='<?=TMVC_BASEURL?>/batallanaval/restart'>
				<button class="btn btn-lg btn-primary btn-block" type="submit" value="Play again">Play again</button>
				<input type="hidden" name="activity" value="restart_game">
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4"> 
			<form method="post" action='<?=TMVC_BASEURL?>/user/logOut'>
				<button class="btn btn-lg btn-primary btn-block" type="submit" value="Logout">Logout</button>
				<input type="hidden" name="activity" value="end_game">
			</form>
		</div>
	</div>
</center>
<?php echo $msgerror; ?>
