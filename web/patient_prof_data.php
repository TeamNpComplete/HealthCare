<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:/login.php');
}

require_once('conf.php');

$user_id = $_SESSION['user_id'];

$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$occupation = $_POST['occupation'];

$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$zip = $_POST['zip'];

$ph_no = $_POST['ph_no'];
if(isset($_POST['home']) && $_POST['home'] == 'yes') {
	// echo "Set";
	$home_no = $_POST['home_no'];
	// echo $home_no;
}
else{
	// echo "Not Set";
	$home_no = "";
}

if(isset($_POST['work']) && $_POST['work'] == 'yes') {
	// echo "Set";
	$work_no = $_POST['work_no'];
	// echo $work_no;
}
else{
	// echo "Not Set";
	$work_no = "";
}

$sql = "INSERT INTO PatientsProfile VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$user_id, $firstname, $middlename, $lastname, $dob, $email, $occupation, $gender, $addr1, $addr2, $city, $state, $country, $zip, $ph_no, $home_no, $work_no]);

// if($result){
//     echo 'Inserted';
// } else {
//     echo 'Not Inserted';
// }

header("Location: patient_dashboard.php");
exit();
?>

