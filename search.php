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
			<p>Normal search by book title and/or author</p>
				<form method="post">
					<input type="text" placeholder="Search a book..." name="search" class="login">
					<button type="submit" class= "registerbtn">Submit</button>
				</form>
				<?php
				require_once "db.php";
				if (isset($_POST['search']))
				{	
					$minlength = 1;
					$search = $_POST['search'];
					
					if (strlen($search) >= $minlength)
					{	
						$search = mysqli_real_escape_string($db,$search);
						$results = mysqli_query($db,"SELECT * FROM books WHERE BookTitle LIKE "."'%".$search."%'"."OR Author LIKE "."'%".$search."%'");
						
						if(mysqli_num_rows($results) > 0)
						{    
							echo "<ul>";
							while($finalresults = mysqli_fetch_array($results))
							{
									echo "<li>".$finalresults['BookTitle'].	" by ".$finalresults['Author']."</li>";      
							}
							echo "</ul>";
						}
						else
						{
							echo "<p><b>Sorry, we couldn't find any results based on your search</b></p>";
						}
					}
					else 
					{
						echo "<p><font color='red'><b>ERROR:You need to search for something</b></font></p>";
					}
				}
		
				?>
				
				<p>Or select from a category</p>
				<form method ="post">
					<select name="category">
						<?php
						$categoryselection = mysqli_query($db,"SELECT * from Categories");
						$row = mysqli_num_rows($categoryselection);
						echo "<option value=''>";
						while ($row = mysqli_fetch_array($categoryselection))
						{
							echo "<option value='". $row['CategoryDescription'] ."'>" .$row['CategoryDescription'] ."</option>" ;
						}
						?>
					</select>
					<?php
					if(isset($_POST['category']))
					{
						$_SESSION['finalcategory'] = mysqli_real_escape_string($db, $_POST['category']);
						$a = $_SESSION['finalcategory'];
						$query= mysqli_query($db,"SELECT BookTitle from Categories join books using (CategoryID) where CategoryDescription = '$a'");
						$row = mysqli_num_rows($query);
					
						echo "<ul>";
						if($row >0)
						{	
							while ( $row = mysqli_fetch_array($query) )
							{
								echo "<li>".$row['BookTitle']."</li>" ;
							}
							echo "</ul>";
						}
						else
						{
							echo "<p><b>Sorry, there are no books in this category</b></p>";
						}
					}
					?>
					<br>
					<button type="submit" name="submitcategory" class= "registerbtn">Submit</button>
			</form>
				
			<p>Wanna reserve a book?</p>
			<p><a href="reserved.php">Check the available books</p>
		</div>
				
		<footer>
			<p>Site made by Dan Pirlea &copy; 2019</p>
			<p><a href="logout.php">Log out</p>
		</footer>
	</body>
</html>