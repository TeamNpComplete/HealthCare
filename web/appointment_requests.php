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
        <?php while($result = $stmt->fetch()) {?>
        <div class="row">
            <div class="col-lg-12 mt-6">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-wrapper">
                            <img class="" style="height: 230px; width:230px;" src="https://images.wallpaperscraft.com/image/cosmonaut_space_suit_art_123372_1920x1080.jpg" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title"><b>Chinmay Joshi</b></h4>
                            </br>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Contact</div></div>
                                <div class="col-md-8"><p class="info-text">9834364767</p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Prefered Date</div></div>
                                <div class="col-md-8"><p class="info-text">11/04/2020 12:00 AM</p></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><div class="info-title">Set Date&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp &nbsp</div></div>
                                <div class="col-md-8">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" id="input-date"/>
                                        <span class="input-group-addon" style="height:20px">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><button class="btn btn-success">Accept</button></div>
                                <div class="col-md-4"><button class="btn btn-danger">Reject</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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

        $(function () {
            $('#datetimepicker1').datetimepicker({
                minDate: tomorrow
            }).on('changeDate', () => {
                $('#datepicker').datetimepicker('hide');
            });
        });
        
        $('#input-date').keydown(function (event) {
            event.preventDefault();
        });
    </script>
</body>
</html>