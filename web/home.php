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
      <?php if($patient_id == "P723565") {?>
        <div class="doctor-info">

            <div class="card card-1">
                <div class="user-img"></div>
                <span class="name">Dr. Sanjay Rajkuntwar</span>
                <span class="position">ENT Specialist</span>
                <span class="workplace">Raj Clinic</span>

            </div>


            <div class="card card-1">
                <div class="user-img"></div>
                <span class="name">Dr. Sneha Walimbe</span>
                <span class="position">Opthamologist</span>
                <span class="workplace">Walimbe Clinic</span>
            </div>

            <div class="card card-1">
                <div class="user-img"></div>
                <span class="name">Dr. Aditya Modak  </span>
                <span class="position">Orthopedic</span>
                <span class="workplace"> Modak Clinic</span>
            </div>
        </div>
      <?php } ?>
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
                            public $mon;
                            public $time;
                            public $description;
                          
                            
                            function set_date($date) {
                              $this->date = $date;
                            }
                            function get_date() {
                              return $this->date;
                            }

                            function set_mon($mon) {
                              $this->mon = $mon;
                            }
                            function get_mon() {
                              return $this->mon;
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

                          $sql = "SELECT * FROM Appointments WHERE patient_id=? AND status='scheduled' ORDER BY date_of_appointment";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute([$patient_id]);
                          //$result = $stmt->fetch();
                          $a=array();
                          $months = array("01" => 'JAN', "02" => 'FEB', "03" => 'MAR', "04" => 'APR', "05" => 'MAY', "06" => 'JUN', "07" => 'JUL', "08" => 'AUG', "09" => 'SEP', "10" => 'OCT', "11" => 'NOV', "12" => 'DEC');
                          // Notice: Undefined index: date in /opt/lampp/htdocs/home.php on line 99
                            while($row = $stmt->fetch()) {
                                $app = new Appointment();
                                $date_time_str = $row["date_of_appointment"];
                                $d1 = explode (" ", $date_time_str);
                                $date2 = explode("-",$d1[0]);
                                $month =  $months[$date2[1]];
                                $time2 = substr($d1[1],0,5);
                                $app->set_time($time2);
                                $app->set_mon($month);
                                $app->set_date($date2[2]);
                                $app->set_description($row["description"]);
                                array_push($a,$app);
                                }   

                            foreach ($a as $value) {
                                $date1 = $value->get_date();
                                echo '<li> 
                                <div class="direction-r">
                                  <div class="flag-wrapper"> 
                                    <div class="flag">
                                      <div class="column"> 
                                        <div class="date"> 
                                          <label class="day">'.$value->get_date().'</label> 
                                          <label class="month">'.$value->get_mon().'</label>
                                        </div>
                                      </div>
                                      <div class="column1">
                                        <a href="#scroll" style="color: #000;  ">'.$value->get_description().'</a>
                                        <div style="margin-right: 10px">'.$value->get_time().'</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                </li>';
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
                               $med->set_medicine($row["medicine"]);
                                $med->set_dosage($row["dosage"]);
                                $med->set_days($row["days_no"]);
                                $med->set_time1($row["time_no"]);
                                array_push($m,$med);
                                }   
            
            ?>


            <div class="medicine-table">
                <div class="current-medication">
                    <p><i class="fas fa-pills"></i>Current Medications</p>
                </div>
                <table class="rwd-table">
                    <?php
                       echo '<th>'.'Medicine'.'</th>';
                       echo '<th>'.'Dosage'.'</th>';
                       echo '<th>'.'Days'.'</th>';
                       echo '<th>'.'Time'.'</th>';
                        foreach ($m as $mvalue) {
                            

                       
                        echo '<tr>';
                        echo '<td data-th="Medicine">'. $mvalue->get_medicine(). '</td>';
                            echo '<td data-th="Dosage">'.$mvalue->get_dosage().'</td>';
                            echo '<td data-th="Days">'.$mvalue->get_days().'</td>';
                            echo '<td data-th="Time">'.$mvalue->get_time1().'</td>';
                            echo '</tr>';
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