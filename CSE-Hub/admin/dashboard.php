<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css" media="screen">
</head>
<body>
	<header>
        <h1>Welcome on Board , Admin !</h1>
        <?php
            //Uncomment when connected to auth.php for admin 
			//$user = $_POST['username'];
			//echo "<h1>Welcome on Board , $user !<h1>";
		 ?>
		<div class="sline"></div>
    	<div class="sline"></div>
	</header>
	<nav>
			<form action="sort.php" method="POST">
				<ul>
					<li><input class="button" type="submit" name="new_problem" value="Create Problem"></li>
					<li><input class="button" type="submit" name="host"   value="Host a Contest"></li>
					<li><input class="button" type="submit" name="solve"  value="solve"></li>
					<li><input class="button" type="submit" name="about"  value="About"></li>
					<li><input class="button" type="submit" name="logout" value="Log Out"></li>
				</ul>
			</form>
	</nav>
	
	<section class="outer-section">
		<aside class="left-pane">
			<p>
				Left Pane
			</p>
		</aside>
		<section class="middle-pane">
			<p>
				Main Content
			</p>
		</section>
		<aside class="right-pane">
			<p>
				Right Pane
			</p>
		</aside>
	</section>
	<footer>
		<p>Logged in as <b><i>Admin</i></b></p>
	</footer>
</body>
</html>