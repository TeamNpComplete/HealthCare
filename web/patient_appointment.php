<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:/login.php');
}

require_once('conf.php');

$user_id = $_SESSION['user_id'];
$patient_id = $_GET['patient_id'];
$general_info;
$flag = 0;

if($patient_id) {
    $sql = "SELECT firstname, lastname, description, date_of_appointment, ph_no FROM Appointments NATURAL JOIN DoctorsProfile WHERE patient_id=?";
    if($user_id[0] == 'D')
        $sql = "SELECT firstname, lastname, description, date_of_appointment, ph_no FROM Appointments NATURAL JOIN DoctorsProfile WHERE patient_id=? AND doctor_id=?";

    $stmt = $conn->prepare($sql);

    if($user_id[0] == 'D')
        $stmt->execute([$patient_id, $user_id]);
    else
        $stmt->execute([$patient_id]);

        $result = $stmt->fetch();

    if($result){
        $flag = 1;
    } else {
        $flag = 0;
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

        *{
            margin: 0px;
            padding: 0px;
            font-family: 'Montserrat', sans-serif;
            box-sizing: border-box;
        }
        body {
            animation: fadeInEffect 1s;
            ;
        }

        @keyframes fadeInEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            while($result) {
        ?>
        <div class="row">
            <div class="col-lg-12 mt-6" style="margin-top:50px;">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <h3 class="card-title" style="color: #003d4d;"><b>Dr. <?php echo $result['firstname']." ".$result["lastname"];?></b></h3>
                            <div class="row">
                                <div class="col-md-6"><b>Appointment Date</b></div>
                                <div class="col-md-6"><?php echo $result['date_of_appointment']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><b>Description</b></div>
                                <div class="col-md-6"><?php echo $result['description']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"><b>Contact No.</b></div>
                                <div class="col-md-6"><?php echo $result['ph_no']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                $result = $stmt->fetch();
            }
        ?>
    </div>
    <div class="container" id="empty-msg-box" style="margin-top: 60px; <?php if($flag == 1) echo 'display:none';?>">
        <div class="jumbotron">
            <h1>No Appointments</h1>
            <p>There are currently no Appointments taken by patient.</p>
        </div>
    </div>
</body>
</html>