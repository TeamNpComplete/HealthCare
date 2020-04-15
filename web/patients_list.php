<!DOCTYPE html>
<html>
<head>
    <title>Patient List</title>
    <link rel='stylesheet' type='text/css' href='stylesheets/patient_list.css'>
    <script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous"></script>
    <script>
		function showHint(str) {
			if (str.length == 0) {
				document.getElementById("txtHint").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
				        document.getElementById("txtHint").innerHTML = this.responseText;
				    }
				};
				xmlhttp.open("GET", "getHint.php?str=" + str, true);
				xmlhttp.send();
    }
}
</script>
</head>
<body>
    
	<div class="parent">
	<div class="pseudo_nav">
	<ul style="margin-top: 50px;">
	<li>Dashboard</li>
	<li style="background: #007a99;">Patients List</li>
	<li>Messages</li>
	<li>Settings</li>
	</ul>
	</div>
	<div class="page">
	<header class="head">
	<h2>Patient List</h2>
	</header>
	<div class="search_section">
	<input class="search_bar" type="text" placeholder="Search .." onkeyup="showHint(this.value)">
	<p style="margin-left: 10px"><span id="txtHint"></span></p>
	</div>
	<div class="list_wrapper">


    <table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Status</th>
        <th>Details</th>
    </tr>

<?php

	$servername = "localhost";
    $username = "dbms";
    $password = "123456";
    $dbname = "HealthcarePortal";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if (mysqli_connect_error()) {
		die("Database connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT * FROM patientsList";
    $result = $conn->query($sql);
	
	while($row = $result->fetch_assoc())
	{
	    echo "<tr>";
	    echo "<td>" . $row['id'] . "</td>";
	    echo "<td>" . $row['fname'] . "</td>";
	    echo "<td>" . $row['lname'] . "</td>";
	    echo "<td>" . $row['gender'] . "</td>";
	    echo "<td>" . $row['dob'] . "</td>";
	    echo "<td>" . $row['status'] . "</td>";
	    echo '<td>
	            <button class="view_btn">View More</button>
	            </td>';
	    echo "</tr>";
	}
    echo "</table>";

    $conn->close();
    
    echo "</div></div></div>";

?>

</body>
</html>
