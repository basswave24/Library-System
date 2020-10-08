<?php
include('session.php');
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dan's Library</title>
		<link rel="stylesheet" type="text/css" href="Assets/site2.css">
	</head>
	
	<body>
		<header><h1>Dan's Library</h1></header>
		
		<div>
			<nav>
				<ul id="toplinks">
					<li><a href="search.php">Search a book</a></li>
					<li><a href="reserved.php">Reserve a book</a></li>
					<li><a href="viewreserved.php">View books you reserved</a></li>
				</ul>
			</nav>
		</div>
		
		<div id="home">
			<p>Welcome to my library. Please select one of the above options</p>
		</div>
		
		<footer>
			<p>Site made by Dan Pirlea &copy; 2019</p>
			<p><a href="logout.php">Log out</p>
		</footer>
	</body>
</html>