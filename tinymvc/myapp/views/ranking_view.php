<div class="row">
	<div class="col-md-12">
		<h1>  Ranking </h1> <br>
		<p> <?php if(isset($toView["mensaje"])) echo $toView["mensaje"]; ?> </p>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h2> Admiral Ranking </h2>
		<br>
		<table>
			<?php
				foreach ($data as $key => $value) 
				{
					$order=$key+1;
					echo "<tr> <td>". $order . " </td> <td>". $value["user"] . " </tr>";
				}
			?>
		</table>
	</div>
</div>
<div class="row">
	<form method="post" action='<?=TMVC_BASEURL?>/users/menu'>
		<button class="btn " type="submit" value="Modify">Menu</button>
	</form>
</div>
