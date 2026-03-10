<?php
//start session
session_start();
//session secuity destroying sessions
session_unset();
session_destroy();
// redirect to home page
header("Location: home.php");
exit();
?>
