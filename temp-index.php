<?php
$message = "Under construction…";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Demo</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="description" content="Demo project">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
		<style type="text/css">

.color-dark  	{ color: #1D1E20; }
.color-black 	{ color: #131415; }
.color-bg    	{ color: #FFD7D1; }
.color-green 	{ color: #93ECA4; }
.color-purple	{ color: #765BA7; }

.bg-bg  	  	{ background-color: #FFD7D1; }
			
body {
	height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	font-family: serif;
	font-size: 18px;
}
		</style>
	</head>
	<body class="bg">
		<p class="color-purple"><?= $message ?></p>
		<script type="text/javascript"></script>
	</body>
</html>