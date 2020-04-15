<?php

session_start();

if(!isset($_SESSION['user_id'])){
	header('Location: login.php');
}

require_once('conf.php');

$user_id = $_SESSION['user_id'];

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$primary_degree = "";

if(!empty($_POST['pri_degree'])) {
	foreach($_POST['pri_degree'] as $selected){
		$primary_degree .= $selected."/";
	}
}

$secondary_degree = "";
if(!empty($_POST['sec_degree'])) {
	foreach($_POST['sec_degree'] as $selected){
		$secondary_degree .= $selected."/";
	}
}

$speciality = $_POST['speciality'];
$experience = $_POST['experience'];

$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$zip = $_POST['zip'];

$cl_no = $_POST['cl_no'];

if(isset($_POST['home']) && $_POST['home'] == 'yes') {
	$home_no = $_POST['home_no'];
}
else{
	$home_no = "";
}

$sql = "INSERT INTO DoctorsProfile VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$user_id, $firstname, $middlename, $lastname, $dob, $gender, $email, $primary_degree, $secondary_degree, $speciality, $experience, $addr1, $addr2, $city, $state, $country, $zip, $cl_no, $home_no]);

if($result){
	header("Location: Useless/patient_dashboard.html");
	exit();
} else {
	header("Location: doctor_profile.php");
	exit();
}

?>

