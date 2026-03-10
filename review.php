<?php
if (!isset($_SESSION['uid'])){
	header("Location: login.php");
	exit();
	
}

echo "you are logged in as: " . $_SESSION['uemail'];
?>
<html>
<head>
	<title> Review Page </title>

	<style> 
	body{ 
		font-family: Arial, sans-serif;
		max-width: 600px;
		margin: 40px;
		padding: 20px;
	}
	
	header {
			text-align: center;
			background: linear-gradient(135deg, #3498db);
			padding: 1.5rem 5%;
			position: sticky;
			top: 0;
			z-index: 100;
		}
	

	
	.review-box {
	  color:black;
	  font-family: Helvetica, Arial, sans-serif;
	  font-weight:500;
	  font-size: 18px;
	  border-radius: 5px;
	  line-height: 22px;
	  background-color: transparent;
	  border:2px solid #CC6666;
	  transition: all 0.3s ease;
	  padding: 20px 24px;
	  margin-bottom: 24px;
	  width:100%;
	  min-height: 220px;
	  height: auto;
	  max-width: 860px;
	  box-sizing: border-box;
	  outline:None;
	  resize: None;
	}
	
	
	button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
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

	</style>
	
</head>

<body>
	<header>
		<h1> Write a Review</h1>
		<nav>
			<a href="home.php">home</a>
			<a href="dashboard.php">dashboard</a>
		</nav>
	</header>
	
	<form action="submitreview.php" method="POST" enctype="multipart/form-data">
	<div>
	
	<textarea class= "review-box" name="review-text" placeholder= "write a review here" required></textarea>
	<input type="file" name="review-image" accept="image/*" >
	<button type="submit" name="submit-review">Submit Review</button>
	
	</div>
	</form>
</body>
</html>
