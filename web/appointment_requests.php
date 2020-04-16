<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
        exit();
    }

    require_once('conf.php');

    $doctor_id = $_SESSION['user_id'];

    $sql = "SELECT appointment_id, patient_id, firstname, middlename, lastname, ph_no, date_of_appointment
            FROM Appointments NATURAL JOIN PatientsProfile WHERE doctor_id=? AND status='unscheduled' ORDER BY
            date_of_appointment";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$doctor_id]);

    $count = 0;
    $appointmnents = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .card-horizontal {
            display: flex;
            flex: 1 1 auto;
            padding : 20px 20px;
            border : 2px solid grey;
            margin :10px;
        }

        .card-body {
            margin-left : 40px;
        }

        .image-wrapper{
            overflow:hidden;
        }

        .info-title {
            font-weight: bold;
            padding : 3px;
        }

        .info-text {
            padding : 3px;
        }

        .btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php while($result = $stmt->fetch()) {
            $appointmnents[$count] = $result['appointment_id'];
        ?>
        <div class="row">
            <div class="col-lg-12 mt-6">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-wrapper">
                            <img class="" style="height: 280px; width:280px;" src="https://media.istockphoto.com/vectors/male-patient-profile-icon-with-circle-shape-flat-style-vector-eps-vector-id1125731438" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><b><?php echo $result['firstname']." ".$result['middlename']." ".$result['lastname']; ?></b></h4>
                            </br>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Contact</div></div>
                                <div class="col-md-8"><p class="info-text"><?php echo $result['ph_no']; ?></p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Prefered Date</div></div>
                                <div class="col-md-8"><p class="info-text"><?php echo $result['date_of_appointment'];?></p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Set Date&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp</div></div>
                                <div class="col-md-8">
                                    <div class='input-group date' id='datetimepicker<?php echo $count;?>'>
                                        <input type='text' class="form-control" id="input-date-<?php echo $result['appointment_id'];?>"/>
                                        <span class="input-group-addon" style="height:20px">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Discription</div></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="appointment-discription-<?php echo $result['appointment_id'];?>" placeholder="Enter small description ...">
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-4"><button class="btn btn-success" onclick="acceptRequest(this);">Accept</button></div>
                                <div class="col-md-4"><button class="btn btn-danger" onclick="rejectRequest(this);">Reject</button></div>
                                <input type="hidden" id="appointment-id" value="<?php echo $result['appointment_id'];?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $count++;
        }
     ?>
    </div>
    <div class="container" id="empty-msg-box" style="margin-top: auto; margin-bottom:auto; <?php if($count > 0) echo 'display:none';?>">
        <div class="jumbotron">
            <h1>No Pending Appointment Requests</h1>
            <p>There are currently no pending appointment requests.</p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(0,0,0,0);
        var count =<?php echo $count;?>;
        console.log(count);
        <?php 
            for($i = 0; $i < $count; $i++){     
        ?>
            $(function () {
                $('#datetimepicker<?php echo $i;?>').datetimepicker({
                    minDate: tomorrow,
                    format:'DD/MM/YYYY hh:mm A'
                }).on('changeDate', () => {
                    $('#datepicker').datetimepicker('hide');
                });
            });
            
            $('#input-date-<?php echo $appointmnents[$i];?>').keydown(function (event) {
                event.preventDefault();
            });

        <?php
        } 
        ?>

        function acceptRequest(element) {

            var appointment_id = $(element).parent().parent().find('#appointment-id').val();

            if($('#appointment-discription-' + appointment_id).val() != "" && $('#input-date-' + appointment_id).val() != ""){
                var request = new XMLHttpRequest();

                request.onreadystatechange = () => {
                    if (request.readyState == 4 && request.status == 200) {
                        console.log(request.responseText);
                    }
                };

                request.open("POST", "get_appointment.php", true);
                request.setRequestHeader('content-type', 'application/json');
                request.send(JSON.stringify({
                    appointment_id : appointment_id,
                    date_of_appointment: $('#input-date-' + appointment_id).val(),
                    discription : $('#appointment-discription-' + appointment_id).val()
                }));

                $(element).parent().parent().parent().parent().parent().parent().parent().remove();
                count--;
                if(count <= 0)
                    $('#empty-msg-box').show();
            } else {
                alert('Missing required fields !');
            }

        }

        function rejectRequest(element) {
            var appointment_id = $(element).parent().parent().find('#appointment-id').val();

            var request = new XMLHttpRequest();
            request.onreadystatechange = () => {
                if (request.readyState == 4 && request.status == 200) {
                    console.log(request.responseText);
                }
		    };
            request.open("GET", "get_appointment.php?appointment_id=" + appointment_id, true);
            request.send();
            $(element).parent().parent().parent().parent().parent().parent().parent().remove();
            count--;
            if(count <= 0)
                $('#empty-msg-box').show();
        }

    </script>
</body>
</html>