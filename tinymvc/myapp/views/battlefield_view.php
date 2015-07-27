<script src='<?=TMVC_BASEURL?>/js/client_events<?=$toView['playerID']?>.js'></script>
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
	<div class="col-md-6" id="battlefield">
		<h4> Enemy fleet </h4>
		<table  border="1">
			<?php
				for ($i=0;$i<6;$i++)
				{
					echo "<tr>";
					for ($j=0; $j<6;$j++)
					{
						echo "<td>";
						echo '<input type="radio" name="shotbox" id="b', $i, $j,'" class="styled battlefield" value="', $i, $j, '">';
						echo "</td>";
					}
					echo "</tr>";
				}
			?>
		</table> 
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
