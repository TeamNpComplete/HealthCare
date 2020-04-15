<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:/login.php');
}

if(isset($_POST['value'])){
    $filename = $_POST['value'];
 } 
 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "WTL";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT docID, docName FROM Doctors";
$result = $conn->query($sql);
$a=array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        array_push($a,$row["docName"]);
    }
} else {
   // echo "0 results";
}
$conn->close();
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