<?php
if (isset($_SESSION['uemail'])){
	echo "you are logged in as: " . $_SESSION['uemail'];
} else{
	echo "you are not logged in";
}
	$siteName = "shop";
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $siteName; ?></title>
	
	<style>
		body {
			background-color: #f0f4f8;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			
		}
		
		header {
			text-align: center;
			background: linear-gradient(135deg, #3498db);
			padding: 1.5rem 5%;
			position: sticky;
			top: 0;
			z-index: 100;
		}
		
		nav {
			background: grey;
			display: flex;
			justify-content: center;
			gap: 20px;
			background-colour:#333;
			padding: 15px;
			border-radius: 16px;
			max-width: fit-content;
			margin: 0 auto;
			
		}
		
		nav a {
			text-decoration: none;
			padding:10px 20px;
			background-colour: #3498db;
			colour: white;
			border-radius: 8px;
			font-weight: bold;
			transition: 0.3s;
		}
		
		nav a:hover {
			background-colour: #2980b9;
			transform: translate(-3px);
		}
		
		button {
			background-colour: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
	
		
		footer {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			background-color: #f1f1f1;
			padding: 8px;
			text-align: center;
			z-index: 1000;
		}
	</style>
</head>
<body>

	<header>
		<h1><?php echo $siteName; ?></h1>
		<nav>
			<a href="create.php">Create Account</a>
			<a href="login.php">Login</a>
			<a href="review.php">Review</a>
			<a href="dashboard.php">Dashboard</a>
		</nav>
	</header>
	
	<main>
		<h1> Welcome to the shop page. </h1>
		<p> here you can review products and upload images of them </p>
	</main>
	
	<footer>
		<p> footer </p>
	</footer>

</body>
</html>
