<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:/login.php');
}
// $search_val =  $_COOKIE["search_param"] ;
$id = $_SESSION['user_id'];
require_once('conf.php');

// $sql = "SELECT speciality from DoctorsProfile";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $sp=array();
// while($row =  $stmt->fetch()) {
//     $s = $row["speciality"] ;
//     array_push($sp,$s);
   // array_push($a,$row["lastname"]);

// $servername = "remotemysql.com";
// $username = "AbT5ydOVVn";
// $password = "1nN7Vx4PQ3";
// $dbname = "AbT5ydOVVn";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// $stmt = "";
// $v = $_GET['search_val'];
// echo "vvvvvvvvvvvvvvvvvv   ".$v;
// if($search_val == "Speciality"){
//     $sql = "SELECT doctor_id,firstname,lastname FROM DoctorsProfile where speciality = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([$v]);
// }
// else if($search_val == "Name")
// {
//     $sql = "SELECT doctor_id,firstname,lastname FROM DoctorsProfile";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
// }
$sql = "";
if($id[0] == 'P'){
    $sql = "SELECT doctor_id,firstname,lastname FROM DoctorsProfile";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}
elseif($id[0] == 'D'){
    $sql = "SELECT patient_id, firstname, lastname, dob, gender, email FROM PatientsProfile WHERE patient_id IN (SELECT patient_id FROM Appointments WHERE doctor_id='".$id."' GROUP BY patient_id)" ;
    $stmt = $conn->prepare($sql);
    $stmt->execute();   
}
$a=array();

    // output data of each row
    while($row =  $stmt->fetch()) {
        $nm = $row["firstname"] . " " . $row["lastname"];
        array_push($a,$nm);
       // array_push($a,$row["lastname"]);
    }


echo json_encode($a);
// get th   e q parameter from URL
// $q = $_REQUEST["q"];

// $hint = ""; 

// // lookup all hints from array if $q is different from ""
// if ($q !== "") {
//     $q = strtolower($q);
//     $len=strlen($q);
//     foreach($a as $name) {
//         if (stristr($q, substr($name, 0, $len))) {
//             if ($hint === "") {
//                 $hint = $name;
//             } else {
//                 $hint .= ", $name";
//             }
//         }
//     }
// }

// // Output "no suggestion" if no hint was found or output correct values
// echo $hint === "" ? "no suggestion" : $hint;
?>