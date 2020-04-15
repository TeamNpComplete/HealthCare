<?php

	session_start();

	if(!isset($_SESSION['user_id'])){
		header('Location:/login.php');
	}

	require_once('conf.php');
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM DoctorsProfile WHERE doctor_id='".$user_id."'";
    $result = $conn->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
	$row = $result->fetch();

?>

<html>
	<head>
		<title>Doctor Profile</title>
		<link rel="stylesheet" href="stylesheets/patient_profile.css">
		<script
		src="https://code.jquery.com/jquery-3.4.1.js"
		integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
		crossorigin="anonymous"></script>
		<script src="scripts/dyn_num.js"></script>
		<script src="scripts/patient_profile.js"></script>
	</head>
	<body>
	
		<header>
			<div class="head">
				<a href="" style="color: white">Profile</a>
			</div>
		</header>

		<div class="wrapper">
			<form name="parent_form" action="doctor_prof_data.php" method="post" onsubmit="return validateFields()">
				<div class="heading">
					<div class="title">Doctor Profile</div>
	
					
				</div>
	
				<br>
				<hr>
				<br>
	
				<section class="sect">
					<div class="sect_heading">
						<h4>
							Personal Information
						</h4>
					</div>	
					<div class="sect_info">
						<label>First Name:</label>
						<br>
						<input type="text" name="firstname" placeholder="Stephen" class="input" value="<?php echo ($row)?$row['firstname']:'' ?>">
						<br><br>
						<label>Middle name:</label>
						<br>
						<input type="text" name="middlename" placeholder="Vincent" class="input" value="<?php echo ($row)?$row['middlename']:'' ?>">
						<br><br>
						<label>Last name:</label>
						<br>
						<input type="text" name="lastname" placeholder="Strange" class="input" value="<?php echo ($row)?$row['lastname']:'' ?>">
						<br><br>
						<label>Date Of Birth:</label><br>
						<input type="date" name="dob" class="input">
						<br><br>
						<fieldset>
							<legend>Gender</legend>
							<div style="float: left;">
								<input type="radio" name="gender" value="male" <?php echo ($row)?($row['gender']=='male')?checked:'' :'' ?>>
								<label>Male</label>
							</div>
							<div style="float: right;">
								<input type="radio" name="gender" value="female" <?php echo ($row)?($row['gender']=='female')?checked:'' :'' ?>>
								<label>Female</label>
							</div>
						</fieldset>
						<br>
						<label>Email:</label><br>
						<input type="email" name="email" placeholder="dr.strange@mystics.com" class="input" value="<?php echo ($row)?$row['email']:'' ?>">
						<br><br>
						<fieldset>
							<legend>Primary Degree</legend>
							<div>
								<input type="checkbox" name="pri_degree[]" value="MBBS">
								<label>MBBS</label>
							</div>
							<div >
								<input type="checkbox" name="pri_degree[]" value="MD">
								<label>MD</label>
							</div>
							<div>
								<input type="checkbox" name="pri_degree[]" value="DO">
								<label>DO</label>
							</div>
						</fieldset>
						<br>
						<fieldset>
							<legend>Secondary Degree</legend>
							<div>
								<input type="checkbox" name="sec_degree[]" value="MD(Res)">
								<label>MD(Res)</label>
							</div>
							<div >
								<input type="checkbox" name="sec_degree[]" value="MMSc">
								<label>MMedSc</label>
							</div>
							<div>
								<input type="checkbox" name="sec_degree[]" value="MMed">
								<label>MMed</label>
							</div>
							<div>
								<input type="checkbox" name="sec_degree[]" value="MSurg">
								<label>MSurg</label>
							</div>
							<div>
								<input type="checkbox" name="sec_degree[]" value="MSc">
								<label>MSc</label>
							</div>
						</fieldset>
						<br>
						<label>Speciality:</label>
						<br>
						<div class="custom_select">
							<select id="occ_name" name="speciality">
								<option value="<?php echo ($row)?$row['speciality']:'' ?>"><?php echo ($row)?$row['speciality']:'--Select--' ?></option>
								<option value="Allergist">Allergist</option>
								<option value="Dermatologist">Dermatologist</option>
								<option value="Infectious disease doctor">Infectious disease doctor</option>
								<option value="Ophthalmologist">Ophthalmologist</option>
								<option value="Obstetrician/gynecologist">Obstetrician/gynecologist</option>
								<option value="Cardiologist">Cardiologist</option>
								<option value="Endocrinologist">Endocrinologist</option>
								<option value="Gastroenterologist">Gastroenterologist</option>
								<option value="Nephrologist">Nephrologist</option>
								<option value="Urologist">Urologist</option>
								<option value="Pulmonologist">Pulmonologist</option>
								<option value="ENT Specilist">ENT Specilist</option>
								<option value="Neurologist">Neurologist</option>
								<option value="Psychiatrist">Psychiatrist</option>
								<option value="Oncologist">Oncologist</option>
								<option value="Radiologist">Radiologist</option>
								<option value="General surgeon">General surgeon</option>
								<option value="Orthopedic surgeon">Orthopedic surgeon</option>
								<option value="Cardiac surgeon">Cardiac surgeon</option>
								<option value="Anesthesiologist">Anesthesiologist</option>
							</select>
						</div>
						<br>
						<label>Years of Experience:</label>
						<br>
						<input type="number" style="-webkit-appearance: none; -moz-appearance: textfield; appearance: none;" name="experience" placeholder="5+" class="input" value="<?php echo ($row)?$row['experience']:'' ?>">
						<br><br>
					</div>
				</section>
				<hr>
				<br>

				<section class="sect">
					<div class="sect_heading">
						<h4 >
							Clinic Address
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
								<option value="Gujrat">Gujrat</option>
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
							<p style="font-size: 17px; color: black">Please enter the number. This number will only be used by patients to contact the clinic.</p>
						</article>
						<label>Clinic Number:</label>
						<br>
						<input type="tel" name="cl_no" class="input" placeholder="123-12345678" value="<?php echo ($row)?$row['ph_no']:'' ?>">
						<br><br>

						<div id="home_phone">
							<label>
								Do you have a home landline?
                            </label>
							<br/><br/>
							<input type="radio" name="home" value="yes">Yes
							<input type="radio" name="home" value="no" style="margin-left: 25px;"> No<br>
						</div>
						<div id="inp_home"></div>
						<br>
					</div>
				</section>
				<hr>
	
				<a href="Useless/doctor_dashboard.html">BACK</a>
				<input type="submit" value="SAVE" class="btn">
				<br>
			</form>
		</div>

		<footer>
			<div class="footer_">
				<p style="margin: auto;">Copyright &copy; 2019-2020 healthplus.com, All rights reserved.</p>
				<p style="margin: auto;">Privacy Policy  |  Terms of Use  |  Legal  |  Site Map</p>
			</div>
		</footer>

	</body>
</html>
