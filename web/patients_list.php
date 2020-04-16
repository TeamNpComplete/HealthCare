<?php 
	session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient List</title>
    <link rel='stylesheet' type='text/css' href='stylesheets/patients_list.css'>
    <script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous"></script>
</head>
<body>
    
	<div class="parent">
	<div class="page">
	<div class="list_wrapper">

    <table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Email</th>
        <th>Details</th>
    </tr>

<?php

	require_once('conf.php');
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT patient_id, firstname, lastname, dob, gender, email FROM PatientsProfile WHERE patient_id IN (SELECT patient_id FROM Appointments WHERE doctor_id='".$user_id."' GROUP BY patient_id)";

    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
	// $_SESSION['user_id'] = $row['patient_id'];
	
	while($row = $result->fetch())
	{
	    echo "<tr>";
	    echo "<td>" . $row['patient_id'] . "</td>";
	    echo "<td>" . $row['firstname'] . "</td>";
	    echo "<td>" . $row['lastname'] . "</td>";
	    echo "<td>" . $row['gender'] . "</td>";
	    echo "<td>" . $row['dob'] . "</td>";
	    echo "<td>" . $row['email'] . "</td>";
	    echo "<td>
	            <a class='view_btn' href='patient_report.php?patient_id=". $row['patient_id'] ."' >View Profile</a>
	            </td>";
	    echo "</tr>";
	}
    echo "</table>";
    
    echo "</div></div></div>";

?>

</body>
</html>
