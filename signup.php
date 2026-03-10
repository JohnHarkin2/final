<?php
//start session to access stored session variables
session_start();


//collect post data
$email = $_POST['email'];
$password = $_POST['psw'];
$repeat = $_POST['psw-repeat'];

// validation email length
if (strlen($email) <1 || strlen($email) >250)
{
if(strlen($email) <1)
echo "Email length too short";
else
echo "Email length too long";
exit();
}

//if Email format is valid ensuing emails enters a ptoperly structured
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
echo "Email format invalid";
exit();
}

//password length
else if(strlen($password) <8)
{
echo "your password length is too short!";
exit();
}
// strong password
// must contain uppercase
else if (!preg_match('/[A-Z]/', $password)){
echo "password must contain at least one uppercase letter.";
exit();
}
  //must contain lowercase letter
else if (!preg_match('/[a-z]/', $password)){
echo "password must contain at least one lowercase letter.";
exit();
}
  //must contain number
else if (!preg_match('/[0-9]/', $password)){
echo "password must contain at least one number.";
exit();
}
  //must contain special character
else if (!preg_match('/[^a-zA-Z0-9]/', $password))
{
echo "password must contain at least one special character.";
exit();
}

// password match
//users entering the same password twice preventing account creation mistakes
if ($password !== $repeat)
{
echo "your passwords don't match";
exit();
}
//hash password
//stops passwords being stored in plain text
$hash = password_hash($password, PASSWORD_DEFAULT);


// connect to the database
$dbcreds = new mysqli('localhost', 'root', '', 'website');

// if email already exists

//prevents sql injection
if ($check = $dbcreds->prepare("SELECT id FROM user WHERE email = ?"))
{
//puts email saftly into querry
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

//stops duplicated accounts stops them using same emails
if ($check->num_rows > 0)
{
echo "Email already registered.";
$check->close();
$dbcreds->close();
exit();
}
$check->close();
}

// insert user into database
//sql injection protecion
if($stmt = $dbcreds->prepare ("INSERT INTO user (email, password) VALUES (?,?)")){

$stmt->bind_param("ss", $email, $hash);
$stmt->execute();
// sees if it worked
if ($dbcreds->insert_id == 0){

echo "Database error";
exit();
}
$stmt->close();
}

// close db connection
$dbcreds->close();
// redirect to login page after successful account creation
header("location: login.php?createaccount=success");
exit();
?>
