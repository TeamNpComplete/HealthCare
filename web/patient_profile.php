<?php

	session_start();

	if(!isset($_SESSION['user_id'])){
		header('Location:/login.php');
	}

	require_once('conf.php');
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM PatientsProfile WHERE patient_id='".$user_id."'";
    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();
	
?>

<html>
	<head>
		<title>Patient Profile</title>
		<link rel="stylesheet" href="stylesheets/patient_profile.css">
		<script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous"></script>  
		<script src="scripts/dyn_num.js"></script> 
		<script src="scripts/patient_profile.js"></script>
	</head>
	<body>

		<!-- <header>
			<div class="head">
				<a href="" style="color: white">Profile</a>
			</div>
		</header> -->

		<div class="wrapper">
			<form name="parent_form" action="patient_prof_data.php" method="post" onsubmit="return validateFields()">
				<div class="heading">
					<div class="title">Patient Profile</div>
	
				</div>
	
				<br>
				<hr>
				<br>
	
				<section class="sect">
					<div class="sect_heading">
						<h4>
							Patient Information
						</h4>
					</div>	
					<div class="sect_info">
						<label>First Name:</label>
						<br>
						<input type="text" name="firstname" placeholder="Tony" class="input" value="<?php echo ($row)?$row['firstname']:'' ?>">
						<br><br>
						<label>Middle name:</label>
						<br>
						<input type="text" name="middlename" placeholder="Howard" class="input" value="<?php echo ($row)?$row['middlename']:'' ?>">
						<br><br>
						<label>Last name:</label>
						<br>
						<input type="text" name="lastname" placeholder="Stark" class="input" value="<?php echo ($row)?$row['lastname']:'' ?>">
						<br><br>
						<label>Date Of Birth:</label><br>
						<input type="date" name="dob" class="input" >
						<br><br>
						<fieldset>
							<legend>Gender</legend>
							<div style="float: left;">
								<input type="radio" name="gender" value="male" <?php echo ($row)?($row['gender']=='male')?'checked':'' :'' ?>>
								<label>Male</label>
							</div>
							<div style="float: right;">
								<input type="radio" name="gender" value="female" <?php echo ($row)?($row['gender']=='female')?'checked':'' :'' ?>>
								<label>Female</label>
							</div>
						</fieldset>
						<br>
						<label>Email:</label><br>
						<input type="email" name="email" placeholder="ironman@avengers.com" class="input" value="<?php echo ($row)?$row['email']:'' ?>">
						<br><br>
						<label>Occupation:</label>
						<br>
						<input type="text" name="occupation" placeholder="Avenger" class="input" value="<?php echo ($row)?$row['occupation']:'' ?>">
						<br><br>
					</div>
				</section>
				<hr>
				<br>
				
				<section class="sect">
					<div class="sect_heading">
						<h4 >
							Patient Address
						</h4>
					</div>
					<div class="sect_info">
						<label>Address 1:</label>
						<br>
						<input type="text" name="addr1" placeholder="Number, Building Name" class="input" value="<?php echo ($row)?$row['addressl1']:'' ?>">
						<br><br>
						<label>Address 2:</label>
						<br>
						<input type="text" name="addr2" placeholder="Street Name, Locality" class="input" value="<?php echo ($row)?$row['addressl2']:'' ?>">
						<br><br>
						<label>City:</label>
						<br>
						<input type="text" name="city" placeholder="Pune" class="input" value="<?php echo ($row)?$row['city']:'' ?>">
						<br><br>
						<label>State:</label>
						<br>
						<div class="custom_select">
							<select id="state_name" name="state">
								<option value="<?php echo ($row)?$row['state']:'' ?>"><?php echo ($row)?$row['state']:'--Select--' ?></option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="AP">AP</option>
								<option value="UP">UP</option>
								<option value="Gujarat">Gujarat</option>
							</select>
						</div>
						<br>
						<label>Country:</label>
						<br>
						<div class="custom_select">
							<select id="country_name" name="country">
								<option value="<?php echo ($row)?$row['country']:'' ?>"><?php echo ($row)?$row['country']:'--Select--' ?></option>
								<option value="India">India</option>
								<option value="USA">USA</option>
								<option value="UK">UK</option>
								<option value="Australia">Australia</option>
							</select>
						</div>
						<br>
						<label>Zip Code:</label>
						<br>
						<input type="text" name="zip" placeholder="410100" class="input" pattern="[0-9]{6}" value="<?php echo ($row)?$row['zip']:'' ?>">
						<br><br>
					</div>
				</section>
				<hr>
				<br>
	
				<section class="sect">
					<div class="sect_heading">
						<h4>
							Contact Numbers
						</h4>
					</div>	
					<div class="sect_info">
						<article>
							<p style="font-size: 17px; color: black">Please enter at least one phone number. This number will only be used by your healthcare team.</p>
						</article>
						<label>Mobile:</label>
						<br>
						<input type="tel" name="ph_no" class="input" maxlength="10" minlength="10" placeholder="9952123456" value="<?php echo ($row)?$row['ph_no']:'' ?>">
						<br><br>
						<div id="home_phone">
							<label>
								Do you have a landline?
                            </label>
							<br/><br/>
							<input type="radio" name="home" value="yes">Yes
							<input type="radio" name="home" value="no" style="margin-left: 25px;"> No
							<br><br>
						</div>
						<!-- below div is for dynamic addtion of input fields -->
						<div id="inp_home"></div>

						<br>
						<div id="work_phone">
							<label>
								Do you have a work phone?
                            </label>
							<br/><br/>
							<input type="radio" name="work" value="yes">Yes
							<input type="radio" name="work" value="no" style="margin-left: 25px;"> No
							<br><br>
						</div>
						<!-- below div is for dynamic addtion of input fields -->
						<div id="inp_work"></div>
						<br>
					</div>
				</section>
				<hr>
	 
				<a onclick="window.top.location='patient_dashboard.php'">BACK</a>
				<input type="submit" value="SAVE" class="btn">
				<br>
			</form>
		</div>

		<!-- <footer>
			<div class="footer_">
				<p style="margin: auto;">Copyright &copy; 2019-2020 healthplus.com, All rights reserved.</p>
				<p style="margin: auto;">Privacy Policy  |  Terms of Use  |  Legal  |  Site Map</p>
			</div>
		</footer> -->
	</body>
</html>
