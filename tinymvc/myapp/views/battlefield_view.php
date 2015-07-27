<div class="row">
	<div class="col-md-6">
		<h4> Your fleet </h4>
		<table border="1">
			<?php				
				for ($i=0;$i<6;$i++)
				{
					echo "<tr>";
					for ($j=0; $j<6;$j++)
					{
						switch ($toView["userFleet"][$i][$j])
						{
							case 0:
								$userImage='sea';
								break;
							case 1:
								$userImage='player_ship';
								break;
							case 2:
								$userImage='water_explotion';
								break;
							case 3:
								$userImage='ship_explotion';
								break;
								
						}
						echo '<td><img src="',TMVC_BASEURL,'/img/', $userImage,'.png" ></td>';
					}
					echo "</tr>";
				}
			?>
		</table> 
	</div>
	<div class="col-md-6">
		<form method="post" action='<?=TMVC_BASEURL?>/batallanaval/play'>
			<h4> Enemy fleet </h4>
			<table  border="1">
				<?php
					
					for ($i=0;$i<6;$i++)
					{
						echo "<tr>";
						for ($j=0; $j<6;$j++)
						{
							echo "<td>";
							switch ($toView["fired"][$i][$j])
							{
								case 0:
									$imageEnemy='sea';
									break;
								case 2:
									$imageEnemy='water_explotion';
									break;
								case 3:
									$imageEnemy='ship_explotion';
									break;
							}
							if ($toView["fired"][$i][$j]==0)
							{
								echo '<input type="radio" name="shotbox" class="styled" value="', $i, $j, '">';
							}
							else
							{
								echo '<img src="', TMVC_BASEURL,'/img/', $imageEnemy, '.png" >';
							}
							echo "</td>";
						}
						echo "</tr>";
					}
				?>
			</table> 
			<br>
			<button class="btn btn-primary btn-fire" type="submit" value="Fire!">Fire!</button>
			<input type="hidden" name="activity" value="play_game">
		</form>
	</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p> 
			<?php
				$mensaje=" ";
				if (isset($toView["userHit"]) && $toView["userHit"]==1)
				{
					$mensaje.="We have hit an enemy ship! <br>";
				}
				if (isset($toView["enemyHit"]) && $toView["enemyHit"]==1)
				{
					$mensaje.="The enemy has hit one of our ship! <br>";
				}
				echo $mensaje;
			?> </p>
		</div>
	</div>
</div>
<?php echo $msgerror; ?>
