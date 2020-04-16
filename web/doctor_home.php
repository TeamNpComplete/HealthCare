<?php

  session_start();

  if(!isset($_SESSION['user_id'])){
      header('Location:/login.php');
      exit();
  }

  $doctor_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/5903f016d8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheets/doctor.css">
    <link rel="stylesheet" href="stylesheets/doctor_pinfo.css">
    <link rel="stylesheet" href="stylesheets/change_appointment.css">
   

    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
    <script src="scripts/jquery.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section class="content-area">
        
        <div class="current-info">
            <div class="appointments"   >
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

                          $sql = "SELECT * FROM Appointments WHERE doctor_id=? AND status='scheduled' ORDER BY date_of_appointment";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute([$doctor_id]);
                          //$result = $stmt->fetch();
                          $a=array();
                          
                          $months = array("01" => 'JAN', "02" => 'FEB', "03" => 'MAR', "04" => 'APR', "05" => 'MAY', "06" => 'JUN', "07" => 'JUL', "08" => 'AUG', "09" => 'SEP', "10" => 'OCT', "11" => 'NOV', "12" => 'DEC');
                          // Notice: Undefined index: date in /opt/lampp/htdocs/home.php on line 99
                            while($row = $stmt->fetch()) {
                              // echo "   ".$row["appointment_id"]. "        ";
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
                              }

                        ?>


                    </ul>
                </div>
            </div>

            <?php 
              foreach ($a as $value) {
                $value->get_description();
              }
            ?>

            <div class="appointments" style="border: 1px solid #007a99;">
              <div class="upcoming-appointments">
                    <p><i class="far fa-calendar-check"></i>Details</p>
                </div>
              
              <div class="cards" style="">

                  <div class="card" id="pinfo" style=" margin-top: -10%;">
                    <div class="card__image-holder">
                     
                    </div>
                    <div class="card-title">
                      <a href="#" class="toggle-info btn" style="margin-bottom: 5%;">
                        <span class="left"></span>
                        <span class="right"></span>
                      </a>
                      <p class="patient-name" style="color: black;"><strong>Name:</strong> Aditya Gunjal</p>
                      <p class="patient-sex"><strong>Gender:</strong> Male</p>
                      <p class="patient-age"><strong>Age:</strong> 22</p>
                      <p class="patient-last-visit"><strong>Phone:</strong> 8158392353</p>
                    </div>
                    <div class="card-flap flap1">
                      <div class="card-description">
                          <h3 style="color: #003d4d;"><strong>Last visited: 20/12/2019</strong></h3>
                          <p class="patient-sex" style=" color:black ;"><strong>Diagnosis:</strong> Viral Infection</p>
                          <p class="patient-age" style=" color:black ;"><strong>Prescribed:</strong> Wikoryl</p>
                      </div>
                      <div class="card-flap flap2">
                        <div class="card-actions">
                          <a href="patient_report.php?patient_id=P819562" class="btn" style="margin-left: 50%;">View Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="cards">

                  <div class="card" id="pinfo" style=" margin-top: -10%;">
                    <div class="card__image-holder">
                     
                    </div>
                    <div class="card-title">
                      <a href="#" class="toggle-info btn" style="margin-bottom: 5%;">
                        <span class="left"></span>
                        <span class="right"></span>
                      </a>
                      <p class="patient-name" style="color: black;"><strong>Name:</strong> Ishan Kunkolikar</p>
                      <p class="patient-sex"><strong>Gender:</strong> Male</p>
                      <p class="patient-age"><strong>Age:</strong> 26</p>
                      <p class="patient-last-visit"><strong>Phone:</strong> 7763452316</p>
                    </div>
                    <div class="card-flap flap1">
                      <div class="card-description">
                          <h3 style="color: #003d4d;"><strong>Last visited: 10/02/2019</strong></h3>
                          <p class="patient-sex" style=" color:black ;"><strong>Diagnosis:</strong> Common Cold</p>
                          <p class="patient-age" style=" color:black ;"><strong>Prescribed:</strong> Viscodyne</p>
                      </div>
                      <div class="card-flap flap2">
                        <div class="card-actions">
                          <a href="patient_report.php?patient_id=P450213" class="btn" style="margin-left: 50%;">View Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="cards" id="scroll">

                  <div class="card" id="pinfo" style=" margin-top: -10%;">
                    <div class="card__image-holder">
                     
                    </div>
                    <div class="card-title">
                      <a href="#" class="toggle-info btn" style="margin-bottom: 5%;">
                        <span class="left"></span>
                        <span class="right"></span>
                      </a>
                      <p class="patient-name" style="color: black;"><strong>Name:</strong> Rohan Deshpande</p>
                      <p class="patient-sex"><strong>Gender:</strong> Male</p>
                      <p class="patient-age"><strong>Age:</strong> 25</p>
                      <p class="patient-last-visit"><strong>Phone:</strong> 9254992483</p>
                    </div>
                    <div class="card-flap flap1">
                      <div class="card-description">
                          <h3 style="color: #003d4d;"><strong>Last visited: 11/12/2019</strong></h3>
                          <p class="patient-sex" style=" color:black ;"><strong>Diagnosis:</strong> Stomach Infection</p>
                          <p class="patient-age" style=" color:black ;"><strong>Prescribed:</strong> Sumo</p>
                      </div>
                      <div class="card-flap flap2">
                        <div class="card-actions">
                          <a href="patient_report.php?patient_id=P176265" class="btn" style="margin-left: 50%;">View Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="cards">

                  <div class="card" id="pinfo" style=" margin-top: -10%;">
                    <div class="card__image-holder">
                     
                    </div>
                    <div class="card-title">
                      <a href="#" class="toggle-info btn" style="margin-bottom: 5%;">
                        <span class="left"></span>
                        <span class="right"></span>
                      </a>
                      <p class="patient-name" style="color: black;"><strong>Name:</strong> Disha Sharma</p>
                      <p class="patient-sex"><strong>Gender:</strong> Female</p>
                      <p class="patient-age"><strong>Age:</strong> 29</p>
                      <p class="patient-last-visit"><strong>Phone:</strong> 8600102621</p>
                    </div>
                    <div class="card-flap flap1">
                      <div class="card-description">
                          <h3 style="color: #003d4d;"><strong>Last visited: 20/01/2020</strong></h3>
                          <p class="patient-sex" style=" color:black ;"><strong>Diagnosis:</strong> Viral Infction & Fever</p>
                          <p class="patient-age" style=" color:black ;"><strong>Prescribed:</strong> Wikoryl</p>
                      </div>
                      <div class="card-flap flap2">
                        <div class="card-actions">
                          <a href="patient_report.php?patient_id=P144944" class="btn" style="margin-left: 50%;">View Profile</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            

        </div>
    </section> 
    <script type="text/javascript" src="scripts/doctor_pinfo.js"></script>
</body>
</html>