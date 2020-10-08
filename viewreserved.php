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
			<p><h3>These are the books currently reserved by you</h3></p>
			<?php
			require_once "db.php";
			$firstquery = mysqli_query($db,"SELECT * from reservations join books using (ISBN) where Username = '$user_check'");
			$row = mysqli_num_rows($firstquery);
	
			while ( $row = mysqli_fetch_array($firstquery) )
			{
				echo "<b>".$row['BookTitle']."</b><i> ".$row['ISBN']."</i><br>" ;
			}
			?>
			<p><h3>Would you like to give a book back?</h3></p>
			<form method="POST">
				<b>Enter ISBN:</b>
				<input type="text" placeholder="Enter ISBN" name="isbn" required class="login">
				<button type="submit" class="registerbtn">Enter</button>
				
				<?php
				if(isset($_POST['isbn']))
				{
					$myisbn = mysqli_real_escape_string($db,$_POST['isbn']);
					$query = mysqli_query($db,"SELECT ISBN from Books where ISBN = '$myisbn'");
					$rows = mysqli_num_rows($query);
					if($rows > 0 )
					{
					
						$date = date('Y-m-d');
						$sql = "UPDATE Books SET Reserved = 'N' where ISBN = '$myisbn'";
						$sql2 = "DELETE FROM reservations where ISBN = '$myisbn' and Username = '$user_check'";
						mysqli_query($db,$sql);	
						mysqli_query($db,$sql2);
						header("location:viewreserved.php");
					}
					else
					{
						echo "<p><font color='red'><b>ERROR:Please enter a valid input</b></font></p>";
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