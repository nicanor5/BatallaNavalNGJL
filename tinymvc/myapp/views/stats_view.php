<div class="row">
	<div class="col-md-12">
		<h1>  Statistics </h1> <br>
		<p> <?php if(isset($toView["mensaje"])) echo $toView["mensaje"]; ?> </p>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h2> Admiral stats </h2>
		<br>
		<table border=1>
			<tr>
				<td>
					Finished 
				</td>
				<td>
					<center>
						<?php  echo $toView["finished"]; ?>
					</center>
				</td>
			</tr>
			<tr>
				<td>
					Won 
				</td>
				<td>
					<center>
						<?php echo $toView["won"]; ?>
					</center>
				</td>
			</tr>
			<tr>
				<td>
					Lost 
				</td>
				<td>
					<center>
						<?php echo $toView["lost"]; ?>
					</center>
				</td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<form method="post" action='<?=TMVC_BASEURL?>/users/menu'>
		<button class="btn btn-primary" type="submit" value="Menu">Menu</button>
	</form>
</div>
