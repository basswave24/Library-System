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
					<li><a href="home.php">Search a book</a></li>
					<li><a href="reserved.php">Reserve a book</a></li>
					<li><a href="viewreserved.php">View books you reserved</a></li>
				</ul>
			</nav>
		</div>
		
		<div id="home">
			<h3>Please register first before using the website</h3>
			<form method="post">
				<b>Username</b>
				<input type="text" placeholder="Enter Username" name="username" required class="login">
				<br><br>
				<b>Password</b>
				<input type="password" placeholder="Enter Password" name="psw" required class="login">
				<br><br>
				<b>Confirm Password</b>
				<input type="password" placeholder="Confirm Password" name="pswconf" required class="login">
				<br><br>
				<b>First Name</b></label>
				<input type="text" placeholder="Enter First Name" name="firstname" required class="login">
				<br><br>
				<b>Surname</b></label>
				<input type="text" placeholder="Enter Surname" name="surname" required class="login">
				<br><br>
				<b>Address Line 1</b></label>
				<input type="text" placeholder="Enter address" name="addressline1" required class="login">
				<br><br>
				<b>Address Line 2</b></label>
				<input type="text" placeholder="Enter address" name="addressline2" required class="login">
				<br><br>
				<b>City</b></label>
				<input type="text" placeholder="Enter city" name="city" required class="login">
				<br><br>
				<b>Enter telephone</b></label>
				<input type="text" placeholder="Enter telephone number" name="telephone" required class="login">
				<br><br>
				<b>Enter phone number</b></label>
				<input type="text" placeholder="Enter phone number" name="phone" required class="login">
				<br><br>
				<button type="submit" class="registerbtn">Register</button>
				
		
			<?php
			require_once "db.php";
			if (isset($_POST['username']) && ($_POST['psw']) && ($_POST['firstname']) && ($_POST['surname']) && ($_POST['addressline1']) && 
			($_POST['addressline2']) && ($_POST['city']) && ($_POST['telephone']) && ($_POST['phone']) && ($_POST['pswconf']))
			{
				$a = mysqli_real_escape_string($db, $_POST['username']);
				$b = mysqli_real_escape_string($db, $_POST['psw']);
				$c = mysqli_real_escape_string($db, $_POST['firstname']);
				$d = mysqli_real_escape_string($db, $_POST['surname']);
				$e = mysqli_real_escape_string($db, $_POST['addressline1']);
				$f = mysqli_real_escape_string($db, $_POST['addressline2']);
				$g = mysqli_real_escape_string($db, $_POST['city']);
				$h = mysqli_real_escape_string($db, $_POST['telephone']);
				$i = mysqli_real_escape_string($db, $_POST['phone']);
				$e = mysqli_real_escape_string($db, $_POST['pswconf']);
				$condition1= false;
				$condition2= false;
				$condition3= false;
				$condition4= false;
				$condition5= false;
				$condition6= false;
				$condition7= false;
				$usernamecheck = "Select * from users where username = '$a'";
				$usernameresultcheck = mysqli_query($db, $usernamecheck);
				
				if (strlen($_POST['psw']) != 6)
				{
					echo "<p><font color='red'><b>Password must be exactly 6 characters long</b></font></p>";
				}
				else if (strlen($_POST['psw']) == 6)
				{
					$condition1 = true;
				}
				
				if ($_POST['psw'] !== $_POST['pswconf'])
				{
					echo "<p><font color='red'><b>Passwords must match</b></font></p>";
				}
				else if ($_POST['psw'] === $_POST['pswconf'])
				{
					$condition2 = true;
				}
				
				if (strlen($_POST['phone']) != 10)
				{
					echo "<p><font color='red'><b>Phone number must be 10 digits long</b></font></p>";
				}
				else if (strlen($_POST['phone']) == 10)
				{
					$condition3 = true;
				}
				
				if (is_numeric($_POST['phone']))
				{
					$condition6 = true;
				}
				else
				{
					echo "<p><font color='red'><b>Phone number can only contain numbers</b></font></p>";
				}	
					
				if (strlen($_POST['telephone']) != 10)
				{
					echo "<p><font color='red'><b>Telephone number must be 10 digits long</b></font></p>";
				}
				else if (strlen($_POST['telephone'] = 10))
				{
					$condition4 = true;
				}
				
				if (is_numeric($_POST['telephone']))
				{
					$condition7 = true;
				}
				else
				{
					echo "<p><font color='red'><b>Telephone number can only contain numbers</b></font></p>";
				}
				
				
				if (mysqli_num_rows($usernameresultcheck) > 0)
				{
					echo "<p><font color='red'><b>Username already taken</b></font></p>";
				}
				else if (mysqli_num_rows($usernameresultcheck) == 0)
				{
					$condition5 = true;
				}
				
				
				
				if (($condition1 == true) && ($condition2 == true)  && ($condition3 == true) && ($condition4 == true) && ($condition5 == true) 
					&& ($condition6 == true) && ($condition7 == true)) 
				{
					$sql= "Insert into users (Username, Password, FirstName, Surname, AddressLine1, AddressLine2, City, Telephone, Mobile) VALUES
					('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i')";
					mysqli_query($db,$sql);
					header("location:login.php");
				}	
			}
			?>
			<p>Already have an account? <a href="login.php">Log in now</a></p>		
		</form>
	</div>
		
		<footer><p>Site made by Dan Pirlea &copy; 2019</p></footer>
	</body>
</html>