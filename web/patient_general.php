<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:/login.php');
}

require_once('conf.php');

$patient_id = $_GET['patient_id'];
$general_info;

if($patient_id) {
    $sql = "SELECT * FROM PatientsProfile WHERE patient_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$patient_id]);
    $general_info = $stmt->fetch();

    if($general_info){
        
    } else {
        die("Invalid ID");
    }
} else {
    die("ID is required !");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="stylesheets/patient_general.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <label>First Name</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['firstname']; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <label>Middle Name</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['middlename']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Last Name</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['lastname']; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <label>Patient ID</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $patient_id; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Gender</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['gender']; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <label>City</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['city']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Date of Birth</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['dob']; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <label>Occupation</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['occupation']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Phone</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['ph_no']; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <label>Email</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['email']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col">
                <label>Address</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['addressl1']." ".$general_info['addressl2']; ?>" readonly>
                </div>
            </div>
            <div class="col">
                <label>State</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['state']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col">
        		<label>Country</label>
                <div class="input-text">
                    <input type="text" value="<?php echo $general_info['country']; ?>" readonly style="width: 49%; float: left;">
                </div>
        	</div>
        </div>
    </div>
</body>
</html>