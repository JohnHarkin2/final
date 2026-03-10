<?php
//start session for login

//collects form data from login form
$email = $_POST['email'];
$password = $_POST['psw'];

// check email length 
if (strlen($email) <1 || strlen($email) >100)
{
 if(strlen($email) <1)
echo "Email length too short";
else
echo "Email length too long";
exit();
}

//Email format is structued properly
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
echo "Email format invalid";
exit();
}

//connects to database
$dbcreds = new mysqli('localhost', 'root', '', 'website');
//prepars sql query to saftly retrive user id and their password
// protection from sql injection attacks
if ($stmt = $dbcreds->prepare("SELECT `id`, `password` FROM `user` WHERE BINARY `email`  = ? LIMIT 1"))
{
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($uid, $uhash);
// check if user real
if ($stmt->num_rows === 0)
{
echo "invalid password or email!";
exit();
}

$stmt->fetch();
// verify passwords the same as hashed that stored in the database
if (password_verify($password, $uhash))
{
// regenet session id to prevent session fixation attacks
session_regenerate_id(true);
// stores user information in session varibles
$_SESSION['uemail'] = $email;
$_SESSION['uid'] = $uid;

// redirect to dashboard after a successful login
header("Location: dashboard.php");
exit();
}
else
{
echo "Invalid password or email!";
}
$stmt->close();
}
$dbcreds->close();

?>
