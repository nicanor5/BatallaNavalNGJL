<script src='<?=TMVC_BASEURL?>/js/admin.js'></script>
<div class="row">
	<div class="col-md-12">
		<p>  Administration menu </p> <br>
		<p> <?php if(isset($toView["mensaje"])) echo $toView["mensaje"]; ?> </p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="tabla">
			<table>
			<tr> <td>ID</td> <td>Username</td> <td>Enable/Disable</td> </tr>
			<?php
			
			foreach ($toView['users'] as $user)
			{
				if(intval($user['enabled'])==0)
						$enabledText="Enable";
				else
					$enabledText="Disable";
				
				$button='<button id="b' . $user['id'] . '" class="' . $enabledText . '" > ' . $enabledText . '</button>'; 
				echo "<tr>";
				echo "<td>" . $user['id'] . "</td><td>" . $user['user'] . "</td><td>" . $button . "</td>";
				echo "<tr>";
			
			}
			
			?>
			</table>
		</div>
	</div>
</div>
