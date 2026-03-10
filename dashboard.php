<?php
//starts session

//session authencation protecting dashbard from unauthorized access
if (!isset($_SESSION['uid'])) {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>

    <nav>

    <a href="home.php">Home</a> |
    <a href="create.php">Create Account</a> |
    <a href="review.php">Review</a> |
    <a href="dashboard.php">Dashboard</a> 
    </nav>
    <hr>

    <h1>Dashboard</h1>

    <p>Welcome, you are now logged in.</p>
<!-- xss protection -->
    <p>Your ID: <?php echo htmlspecialchars($_SESSION['uid']); ?></p>
    <p>Your Email: <?php echo htmlspecialchars($_SESSION['uemail']); ?></p>
    <br>

    <p> <a href="logout.php"><button>Logout</button>
    </p>

    </body>
    </html>
