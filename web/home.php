<?php
  session_start();

	if(!isset($_SESSION['user_id'])){
		header('Location:/login.php');
  }
  
  $patient_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/5903f016d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheets/main2.css">
    <link rel="stylesheet" href="stylesheets/change_appointment.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section class="content-area">
        <div class="doctor-info">


            <div class="card card-1">
                <div class="user-img"></div>
                <span class="name">Dr. Chinmay Joshi</span>
                <span class="position">Family Doctor</span>
                <span class="workplace">Joshi Clinic</span>

            </div>


            <div class="card card-1">
                <div class="user-img"></div>
                <span class="name">Dr. Chinmay Joshi</span>
                <span class="position">Family Doctor</span>
                <span class="workplace">Joshi Clinic</span>
            </div>

            <div class="card card-1">
                <div class="user-img"></div>
                <span class="name">Dr. Chinmay Joshi</span>
                <span class="position">Family Doctor</span>
                <span class="workplace">Joshi Clinic</span>
            </div>
        </div>
        <div class="current-info">
            <div class="appointments">
                <div class="upcoming-appointments">
                    <p><i class="far fa-calendar-check"></i>Upcoming Appointments</p>
                </div>
                <div class="card card-2">

                    <ul class="timeline">
                        <?php
                        
                        require_once('conf.php');
                        class Appointment {
                            
                            public $date;
                            public $time;
                            public $description;
                          
                            
                            function set_date($date) {
                              $this->date = $date;
                            }
                            function get_date() {
                              return $this->date;
                            }

                            function set_time($time) {
                                $this->time = $time;
                              }
                              function get_time() {
                                return $this->time;
                              }

                              function set_description($description) {
                                $this->description = $description;
                              }
                              function get_description() {
                                return $this->description;
                              }
                          }

                          $sql = "SELECT * FROM Appointments WHERE patient_id=?";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute([$patient_id]);
                          //$result = $stmt->fetch();
                          $a=array();
    
                          // Notice: Undefined index: date in /opt/lampp/htdocs/home.php on line 99
                            while($row = $stmt->fetch()) {
                                $app = new Appointment();
                                $date_time_str = $row["date_of_appointment"];

                                $app->set_description($row["description"]);
                                array_push($a,$app);
                                }   

                            foreach ($a as $value) {
                                $date1 = $value->get_date();
                                echo '<li> <div class="direction-r"><div class="flag-wrapper"> <div class="flag"><div class="column"> <div class="date"> <label class="day">'.$value->get_description().'</label> <label class="month">MAR</label></div></div><h4>'.$value->get_description().'</h4><br><h2>'.$value->get_time().'</h2></h4></div></div></div></li>';
                        //        echo '<li>';
                        // echo '<div class="direction-r">';
                        // echo '<div class="flag-wrapper">';
                        // echo '<div class="flag">';
                        // echo '<div class="column">';
                        // echo '<div class="date">';
                        // echo '<label class="day">10</label>';
                        // echo '<label class="month">MAR</label>';
                        // echo '</div>';
                        // echo '</div>';
                        // echo '<h4>Appointment1</h4>';
                        // echo '';
                        // echo '</div>';
                        // echo '';
                        // echo '</div>';
                        // echo '</div>';
                        // echo '</li>';
                              }

                        
                  
                       
                        ?>

                              



                    </ul>
                </div>
            </div>

            <?php

            class Medications
            {
              public  $medicine;
              public  $dosage;
              public  $days;
              public  $time1;
                function set_medicine($medicine) {
                    $this->medicine = $medicine;
                  }
                  function get_medicine() {
                    return $this->medicine;
                  }
                  function set_dosage($dosage) {
                    $this->dosage = $dosage;
                  }
                  function get_dosage() {
                    return $this->dosage;
                  }
                  function set_days($days) {
                    $this->days = $days;
                  }
                  function get_days() {
                    return $this->days;
                  }
                function set_time1($time1) {
                    $this->time1 = $time1;
                  }
                  function get_time1() {
                    return $this->time1;
                  }
                }
                
                        $sql = "SELECT * FROM Medications WHERE patient_id=?";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute([$patient_id]);
                          $m=array();
    
                            while($row = $stmt->fetch()) {
                                $med = new Medications();
                                $app->set_medicine($row["medicine"]);
                                $app->set_dosage($row["dosage"]);
                                $app->set_days($row["days_no"]);
                                $app->set_time1($row["time_no"]);
                                array_push($m,$app);
                                }   
            
            ?>


            <div class="medicine-table">
                <div class="current-medication">
                    <p><i class="fas fa-pills"></i>Current Medications</p>
                </div>
                <table class="rwd-table">
                    <?php
                        foreach ($m as $mvalue) {
                            echo '<th>'. $mvalue->get_medicine(). '</th>';
                            echo '<th>'.$mvalue->get_dosage().'</th>';
                            echo '<th>'.$mvalue->get_days().'</th>';
                            echo '<th>'.$mvalue->get_time1().'</th>';
                        }
                    ?>
                    <!-- <tr>
                        <th>Medicine</th>
                        <th>Dosage</th>
                        <th>Days</th>
                        <th>Time</th>
                    </tr>
                    <tr>
                        <td data-th="Medicine">Rexcof DX/td>
                        <td data-th="Dosage">5 ml </td>
                        <td data-th="Days">4</td>
                        <td data-th="Time">M A N</td>
                    </tr>
                    <tr>
                        <td data-th="Medicine">Sumo</td>
                        <td data-th="Dosage">1 tablet</td>
                        <td data-th="Days">4</td>
                        <td data-th="Time">M A N</td>
                    </tr>
                    <tr>
                        <td data-th="Medicine">Wikoryl</td>
                        <td data-th="Dosage">1 tablet</td>
                        <td data-th="Days">3</td>
                        <td data-th="Time">M N</td>
                    </tr> -->
                </table>
            </div>

        </div>
    </section> 
</body>
</html>