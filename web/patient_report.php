<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
    }

    require_once('conf.php');

    $patient_id = $_GET['patient_id'];
    $general_info;

    if($patient_id) {
        $sql = "SELECT * FROM PatientsProfile WHERE patient_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$patient_id]);
        $general_info = $stmt->fetch();

        if($general_info){

        } else {
            die("Invalid ID");
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
    <link rel="stylesheet" href="stylesheets/patient_report.css">
</head>
<body>
    <input type="hidden" id="patient-id" value="<?php echo $patient_id;?>">
    <section class="container">
        <section class="content-holder">
            <section class="ps-card">
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
                            <?php 
                                echo $general_info['firstname']." ".$general_info['lastname'];
                            ?>
                        </section>
                    </section>
                    <section class="ps-info-block">
                        <section class="ps-label">Gender</section>
                        <section class="ps-name">
                            <?php 
                                echo $general_info['gender'];
                            ?>
                        </section>
                    </section>
                    <section class="ps-info-block">
                        <section class="ps-label">Date of Birth</section>
                        <section class="ps-name">
                            <?php 
                                echo $general_info['dob'];
                            ?>
                        </section>
                    </section>
                    <section class="ps-info-block">
                        <section class="ps-label">Contact</section>
                        <section class="ps-name">
                            <?php 
                                echo $general_info['ph_no'];
                            ?>
                        </section>
                    </section>
                </section>
            </section>

            <nav>
                <button class="tab-links" id="history" onclick="onTabChange('history')">History</button>
                <button class="tab-links active-tab" id="general" onclick="onTabChange('general')">General</button>
                <button class="tab-links" id="medications" onclick="onTabChange('medications')">Medications</button>
                <button class="tab-links" id="appointments" onclick="onTabChange('appointments')">Appointments</button>
            </nav>

            <section class="tab-content history">
                <iframe id="content-frame"></iframe>
            </section>
        </section>
    </section>
    <script src="scripts/patient_report.js"></script>
</body>
</html>