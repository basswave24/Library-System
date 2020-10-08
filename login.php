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
			<h1>Please log in</h1>
			<form method="post">
				<label for="username"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required class="login">
				
				<br><br>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required class="login">
				
				<br>
				
				<button type="submit" class="registerbtn">Login Now</button>
				
				<?php
				require_once "db.php";
				session_start();
				if ( isset($_POST["username"]) && isset($_POST["psw"]) )
				{	
					$username = mysqli_real_escape_string($db,$_POST['username']);
					$mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
					$sql = "SELECT username FROM users WHERE username = '$username' and password = '$mypassword'";
					$result = mysqli_query($db,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				  
					$count = mysqli_num_rows($result);
					
					if($count == 1) 
					{
						$_SESSION['login_user'] = $username;
					 
						header("location: home.php");
					}
					else 
					{
				echo "<p><font color='red'><b>That customer doesn't exist in our database.<a href='register.php'>Click here to register</a></b></font></p>";
					}
				}
				?>
				<p>Dont have an account? <a href="register.php">Register now</a></p>
			</form>
		</div>
		
		<footer><p>Site made by Dan Pirlea &copy; 2019</p></footer>
	</body>	
</html>