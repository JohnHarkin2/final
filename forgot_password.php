<?php 
// starts connection to the database
$conn =  new mysqli("localhost" , "root", "", "website");

if (isset($_POST['email'])){
	
$email = $_POST['email'];
// check for an email and saves it.
$prep_query = $conn->prepare("SELECT * FROM user WHERE email = ?");
$prep_query->bind_param("s", $email);
$prep_query->execute();
// statement pre prepared prevent Injection

$result = $prep_query->get_result();

// executes query to find email exists

if(mysqli_num_rows($result) >0){
	
$token = md5($email . time());
// generates token

$update = "UPDATE user SET reset_token='$token' WHERE email='$email'";
mysqli_query($conn,$update);


// updates database with current reset token

$link = "http://localhost/new-sec-main%20(1)/password_reset.php?token=".$token;

// Email details
$to = $email;
$subject = "Password Reset";
$message = "Use this link to reset your password: $link";
$header = "From: johnsjeffy389@gmail.com";

mail($to,$subject,$message,$header);

echo "Password Reset link sent to you email";
}
else{
echo"email not found";
}

}

?>

<html>
<style>
body {font-family: Arial, Helvetica, sans-serif; width:500px;}
* {box-sizing: border-box;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Float cancel and signup buttons and add an equal width */
.resetpswbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
	.resetpswbtn{
       width: 100%;
    }
}
</style>

<body>

<form method="POST" style="border:1px solid #ccc">
  <div class="container">
	<a href="home.php">Home</a>
    <h1>Forgot Password</h1>
    <p>Please enter your email to reset password</p>
    <input type="email" placeholder="Enter Email" name="email" required>
    <div class="clearfix">
      <button type="submit" class="resetemailbtn">Send Reset Link<button>
    </div>
  </div>
</form>

</body>
</html>