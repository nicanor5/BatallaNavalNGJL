<!doctype html>
<html lang="es">
	<head>
		<title> Navy Gunship Offensive </title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href='<?=TMVC_BASEURL?>/css/bootstrap.min.css'>
		<link rel="stylesheet" type="text/css" href='<?=TMVC_BASEURL?>/css/style.css'>
		<link rel="stylesheet" type="text/css" href='<?=TMVC_BASEURL?>/css/signin.css'>
		<script src='<?=TMVC_BASEURL?>/js/jquery-1.11.2.js'></script>
	</head>
	<body>
		<div class="container">
			<!-- <center> -->
			<div class="jumbotron">
				<h1> Navy Gunship Offensive  </h1> 
			</div>
			<div class="row">
				<div class="col-md-12"> 
					<p> <?php if (isset($msg)) echo $msg; ?> </p>
				</div>
			</div>
			<!-- </center> -->
			<?php if(isset($content)) echo $content; ?>
		</div> <!-- /container -->
	</body>
</html>
