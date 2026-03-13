<?php 

$conn = new mysqli("localhost", "root", "", "website");

$token = $_GET['token'];

// start database and get reset token

$query = "SELECT * FROM user WHERE reset_token='$token'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) == 0){
echo("Invalid token");
exit();
// kills the process invalid token found
}


if(isset($_POST['password'])){
$password = $_POST['password'];

// strong password
if (!preg_match('/[A-Z]/', $password)){
echo "password must contain at least one uppercase letter.";
exit();
}
else if (!preg_match('/[a-z]/', $password)){
echo "password must contain at least one lowercase letter.";

exit();
}
else if (!preg_match('/[0-9]/', $password)){
echo "password must contain at least one number.";
exit();
}
else if (!preg_match('/[^a-zA-Z0-9]/', $password))
{
echo "password must contain at least one special character.";
exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$update = "UPDATE user SET password='$hashed_password', reset_token=NULL WHERE reset_token='$token'";
mysqli_query($conn,$update);

echo "Password Changed succesfully";

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
    <h1>Reset Password</h1>
    <p>Please fill in this form to reset password</p>
    <hr>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <div class="clearfix">
      <button type="submit" class="resetpswbtn">Change Password</button>
    </div>
  </div>
</form>

</body>

</html>
