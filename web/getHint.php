<?php
	session_start();

	if(!isset($_SESSION['user_id'])){
		header('Location:/login.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

	$q = $_GET["str"];

	$servername = "localhost";
    $username = "dbms";
    $password = "123456";
    $dbname = "HealthcarePortal";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM patientsList";
    $result = $conn->query($sql);
    
	$hint = "";
    
    if ($q !== "") {
		$q = strtolower($q);
		$len=strlen($q);
		
		while($row = $result->fetch_assoc()) {
			if(stristr($q, substr($row['fname'], 0, $len)) || stristr($q, substr($row['lname'], 0, $len))) {
				if ($hint === "") {
		            $hint = $row['fname']. ' ' . $row['lname'];
		        } else {
		            $hint .= ", ". $row['fname']. ' ' . $row['lname'];
		        }
			}
		}
	}
	
	echo $hint === "" ? "Suggestions: Not Found" : 'Suggestions: '.$hint;

?>
</body>
</html>
