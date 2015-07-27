<div class="row">
	<div class="col-md-12">
		<center>
			<h2> 
				Welcome, admiral <?php if (isset($toView["username"])) echo htmlspecialchars($toView['username'], ENT_QUOTES, 'UTF-8'); ?>!
			</h2>
		</center>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<p>  Your fleet is ready to receive your orders. Position it at your discretion. </p>
		<p> <?php if (isset($toView["shipsFlag"]) && $toView["shipsFlag"]==1) echo "You must place exactly ", $toView["size"], " ships"; ?> </p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<form method="post" action='<?=TMVC_BASEURL?>/batallanaval/initialize'>
				<table style="width:20% " border="1">
				<?php
					for ($i=0;$i<$toView["size"];$i++)
					{
						echo '<tr>';
						for ($j=0; $j<$toView["size"];$j++)
						{
							echo '<td><input type="checkbox" name="box[', $i, '][', $j, ']" class="styled" value="1"> </td>';
						}
						echo '</tr>';
					}
				?>
				</table> 
			<br>
			<button class="btn btn-fire" type="submit" value="Fight!">Fight!</button>
			<input type="hidden" name="activity" value="init_game">
		</form>
	</div>
</div>
<?php echo $msgerror; ?>
