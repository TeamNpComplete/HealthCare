<?php

session_start();

if(!isset($_SESSION['user_id'])){
	header('Location:/login.php');
}

require_once('conf.php');

$user_id = $_SESSION['user_id'];

$bld_grp = $_POST['bld_grp'];
echo $bld_grp;
$allergies = $_POST['allergies'];

if(isset($_POST['heart']) && $_POST['heart'] == 'yes') {
	$heart = "Yes";
}
else{
	$heart = "No";
}
if(isset($_POST['heart_rhyt']) && $_POST['heart_rhyt'] == 'yes') {
	$heart_rhyt = "Yes";
}
else{
	$heart_rhyt = "No";
}
if(isset($_POST['heart_valve']) && $_POST['heart_valve'] == 'yes') {
	$heart_valve = "Yes";
}
else{
	$heart_valve = "No";
}
if(isset($_POST['circ']) && $_POST['circ'] == 'yes') {
	$circ = "Yes";
}
else{
	$circ = "No";
}
if(isset($_POST['lungs']) && $_POST['lungs'] == 'yes') {
	$lungs = "Yes";
}
else{
	$lungs = "No";
}
if(isset($_POST['sleep_apnea']) && $_POST['sleep_apnea'] == 'yes') {
	$sleep_apnea = "Yes";
}
else{
	$sleep_apnea = "No";
}
if(isset($_POST['kidney']) && $_POST['kidney'] == 'yes') {
	$kidney = "Yes";
}
else{
	$kidney = "No";
}
if(isset($_POST['liver_pancreas']) && $_POST['liver_pancreas'] == 'yes') {
	$liver_pancreas = "Yes";
}
else{
	$liver_pancreas = "No";
}
if(isset($_POST['gi']) && $_POST['gi'] == 'yes') {
	$gi = "Yes";
}
else{
	$gi = "No";
}
if(isset($_POST['diabetes']) && $_POST['diabetes'] == 'yes') {
	$diabetes = "Yes";
}
else{
	$diabetes = "No";
}
if(isset($_POST['neurological']) && $_POST['neurological'] == 'yes') {
	$neurological = "Yes";
}
else{
	$neurological = "No";
}
if(isset($_POST['cancer']) && $_POST['cancer'] == 'yes') {
	$cancer = "Yes";
}
else{
	$cancer = "No";
}
if(isset($_POST['bones']) && $_POST['bones'] == 'yes') {
	$bones = "Yes";
}
else{
	$bones = "No";
}
if(isset($_POST['infections']) && $_POST['infections'] == 'yes') {
	$infections = "Yes";
}
else{
	$infections = "No";
}


$sql = "INSERT INTO PatientsMedProfile VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$result = $stmt->execute([$user_id, $bld_grp, $allergies, $heart, $heart_rhyt, $heart_valve, $circ, $lungs, $sleep_apnea, $kidney, $liver_pancreas, $gi, $diabetes, $neurological, $cancer, $bones, $infections]);

if($result){
    echo 'Inserted';
} else {
    echo 'Not Inserted';
}

// header("Location: Useless/patient_dashboard.html");
// exit();
?>

