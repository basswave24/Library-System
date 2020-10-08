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
			<p><h3>Available Books to reserve </h3></p>
			<?php
			require_once "db.php";
			$query = mysqli_query($db,"Select * from Books where Reserved = 'N'");
			$row = mysqli_num_rows($query);
			while ( $row = mysqli_fetch_array($query) )
			{
				echo "<b>".$row['BookTitle']."</b><i> ".$row['ISBN']."</i><br>" ;

			}
			?>
			<p>If you'd like to reserve a book please enter it's ISBN number</p>
			<form method="POST">
				<b>Enter ISBN:</b>
				<input type="text" placeholder="Enter ISBN" name="isbn" required class="login">
				<button type="submit" class="registerbtn">Enter</button>
				<?php
				if(isset($_POST['isbn']))
				{
					$theisbn = mysqli_real_escape_string($db,$_POST['isbn']);
					$querytest = "SELECT ISBN from Books where ISBN = '$theisbn'";
					$thequery = mysqli_query($db,$querytest);
					$numberofrows = mysqli_num_rows($thequery);
					if($numberofrows > 0)
					{
						$myisbn = mysqli_real_escape_string($db,$_POST['isbn']);
						$date = date('Y-m-d');
						$sql = "UPDATE Books SET Reserved = 'Y' where ISBN = '$myisbn'";
						$sql2 = "INSERT into reservations(ISBN,Username,ReservedDate) values ('$myisbn','$user_check', '$date')";
						mysqli_query($db,$sql);	
						mysqli_query($db,$sql2);
						header("location:viewreserved.php");
					}
					else
					{
						echo "<p><font color='red'><b>ERROR: Please enter a valid input</b></font></p>";
					}
				}
				?>
			</form>
		</div>
		
		<footer>
			<p>Site made by Dan Pirlea &copy; 2019</p>
			<p><a href="logout.php">Log out</p>
		</footer>
	</body>
</html>