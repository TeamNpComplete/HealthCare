<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:/login.php');
}

require_once('conf.php');

$user_id = $_SESSION['user_id'];
$patient_id = $_GET['patient_id'];
$general_info;

if($patient_id) {
    $sql = "SELECT * FROM Medications WHERE patient_id=?";
    if($user_id[0] == 'D')
        $sql = "SELECT * FROM Medications WHERE patient_id=? AND doctor_id=?";

    $stmt = $conn->prepare($sql);

    if($user_id[0] == 'D')
        $stmt->execute([$patient_id, $user_id]);
    else
        $stmt->execute([$patient_id]);

        $result = $stmt->fetch();

    if($result){
        
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        * {
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
    <div class="container" style="margin-top: 100px;">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Medicine</th>
                <th scope="col">Dosage</th>
                <th scope="col">Days</th>
                <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $count = 1;
                while($result){
            ?>
                <tr>
                <th scope="row"><?php echo $count;?></th>
                <td><?php echo $result['medicine'];?></td>
                <td><?php echo $result['dosage']?></td>
                <td><?php echo $result['days_no']?></td>
                <td><?php echo $result['time_no']?></td>
                </tr>
            <?php 
                    $result = $stmt->fetch();
                    $count++;
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>