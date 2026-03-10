<?php

if (!isset($_SESSION['uid'])) {
	echo "you must be signed in to submit a review";
	exit();
}
	

if (isset($_POST['submit-review'])) {

$user_id = $_SESSION['uid'];
$email = $_SESSION['uemail'];

$review = $_POST['review-text']??'';
$image = $_FILES['review-image']?? null;

if (strlen($review) <5 || strlen($review) > 4000) ) {
	echo "Your review was invalid";
	exit();
}

$saveimage = null;
if(isset($image) && $image['error'] === UPLOAD_ERR_OK) {
	$allowed = ["jpg", "jpeg", "png", "gif"];
	$filename = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));

	if(!in_array($filename, $allowed)){
		echo "File must be image";
		exit();
}
		
$uploaddir = "uploads/";
	if(!is_dir($uploaddir)){
		mkdir($uploaddir, 0777, true);
	}
	$newfilename = uniqid() . "." . $filename;
	$targetpath= $uploaddir . $newfilename;

	if (move_uploaded_file($image["tmp_name"], $targetpath)){
		$saveimage = $targetpath;
	} else {
		echo "image upload failed";
		exit();
	}
}

$db = new mysqli('localhost', 'root', '', 'website');

if ($stmt = $db->prepare ("INSERT INTO review (email, review, image) VALUES (?,?,?)"))	
{
$stmt->bind_param("sss", $email, $review, $saveimage);

if ($stmt-> execute()){
	header("Location: home.php");
	exit();
} else{
	echo "Review not submitted" . $stmt->error;
}

$stmt->close();
}
}
?>
