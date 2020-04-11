<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
        exit();
    }

    require_once('conf.php');

    $doctor_id = $_GET['doctor_id'];
    $general_info;

    if($doctor_id) {
        $sql = "SELECT * FROM DoctorsProfile WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$doctor_id]);
        $general_info = $stmt->fetch();

        if($general_info){

        } else {
            //die("Invalid ID");
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
    <title>Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="/stylesheets/doctor_profile.css">
    <style>
        .input-group .form-control {
            margin: 0px !important;
        }
    </style>
</head>
<body>
    
    <section class="container">
        <figure class="ps-profile-image">
            <img src="https://media.istockphoto.com/vectors/male-patient-profile-icon-with-circle-shape-flat-style-vector-eps-vector-id1125731438"
                height="100px"
                width="90px"
                alt="Image">
        </figure>
        <section class="ps-info">
            <section class="ps-info-block">
                <section class="ps-label">Name</section>
                <section class="ps-name">
                    Chinmay Vijay Joshi
                    <?php 
                        //echo $general_info['firstname']." ".$general_info['lastname'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Gender</section>
                <section class="ps-name">
                    Male
                    <?php 
                        //echo $general_info['gender'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Age</section>
                <section class="ps-name">18 Years 3 Months</section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Contact</section>
                <section class="ps-name">
                    9874888751
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Primary Degree</section>
                <section class="ps-name">
                    M.B.B.S
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Secondary Degree</section>
                <section class="ps-name">
                    M.S.
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Speciality</section>
                <section class="ps-name">
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Experience</section>
                <section class="ps-name">
                    Cardiology
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">Address</section>
                <section class="ps-name">
                    Flying Bird School, Trimurti Chauk, Dhankawadi
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
            <section class="ps-info-block">
                <section class="ps-label">City</section>
                <section class="ps-name">
                    Pune
                    <?php 
                        //echo $general_info['ph_no'];
                    ?>
                </section>
            </section>
        </section>
        <button class="appointment-btn" onclick="openForm()"><b>GET APPOINTMENT</b></button>
    </section>
    <div class="form-popup" id="myForm">
        <form class="form-container" id="appointment-form">
            <h1><b>Get Appointment</b></h1>
            </br></br>
            <div class="form-group">
                <label class="control-label">Prefered Appointment Date and Time</label>
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" id="input-date"/>
                    <span class="input-group-addon" style="height:20px">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            </br></br>
            <button type="button" class="btn" onclick="getAppointment()"><b>SUBMIT</b></button>
            <button type="button" class="btn cancel" onclick="closeForm()"><b>CLOSE</b></button>
        </form>
    </div>
    <div class="form-popup alert" id="form-status" style="height:18%; background:white; padding:20px;">
        <p id="alert-text" style="color:inherit;"></p>
        </br>
        <button class="close-btn" onclick="closeAlert()"><b>CANCEL</b></button>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/scripts/doctor_profile.js"></script>
    <script>
        $(function () {
            $('#datetimepicker1').datetimepicker();
         });
    </script>
</body>
</html>