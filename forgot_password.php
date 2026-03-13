<?php 
// starts connection to the database
$conn =  new mysqli("localhost" , "root", "", "website");

if (isset($_POST['email'])){
	
$email = $_POST['email'];
// check for an email and saves it.

$query = "SELECT * FROM user WHERE email='$email'";
$result = mysqli_query($conn,$query);

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

<form method="POST">

<h2>Forgot Password</h2>

<input type="email" name="email">

<button type="submit">Send reset link</button>


</form>