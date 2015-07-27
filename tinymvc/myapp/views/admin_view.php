<script src='<?=TMVC_BASEURL?>/js/admin.js'></script>
<div class="row">
	<div class="col-md-12">
		<p>  Administration menu </p> <br>
		<p> <?php if(isset($toView["mensaje"])) echo $toView["mensaje"]; ?> </p>
	</div>
</div>
<div class="row">
	<form method="post" action='<?=TMVC_BASEURL?>/admin/volver_menu'>
		<button id="return" class="btn-primary btn-fire returnbutton" name="Return">Return to main menu</button>
	</form>
</div>
<div class="row">
	<div class="col-md-12">
		<div id="tabla">
			<table>
			<tr> <td>ID</td> <td>Username</td> <td>Enable/Disable</td> <td> Delete </td> </tr>
			<?php
			if (!isset($toView['users']))
			{
				$admin=new Admin_Model();
				$toView = $admin->adminMenu();
			}
			
			foreach ($toView['users'] as $user)
			{
				if(intval($user['enabled'])==0)
						$enabledText="Enable";
				else
					$enabledText="Disable";
				
				$button='<button id="b' . $user['id'] . '" class="' . $enabledText . '">' . $enabledText . '</button>'; 
				$delButton='<button id="bd' . $user['id'] . '" class="Delete">Delete</button>'; 
				echo '<tr id="r' . $user['id'] . '">';
				echo '<td>' .  $user['id'] . '</td><td>' . htmlspecialchars($user['user'], ENT_QUOTES, 'UTF-8') . '</td><td>' . $button . '</td> <td>' . $delButton . '</td>';
				echo '</tr>';
			
			}
			?>
			</table>
			<form method="post" action='<?=TMVC_BASEURL?>/admin/adicionar_menu'>
				<button id="adduser" class="addbutton" name="Register" value="true">Add user</button>
			</form>
		</div>
	</div>
</div>
