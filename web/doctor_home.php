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
    <script src="jquery.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section class="content-area">
        
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
                        
                          $sql = "SELECT * FROM Appointments WHERE doctor_id=?";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute([$doctor_id]);
                          $a=array();
    
                          while($row = $stmt->fetch()) {
                              $app = new Appointment();
                              $date_time_str = $row["date_of_appointment"];
                              $app->set_description($row["description"]);
                              array_push($a,$app);
                          }    

                            foreach ($a as $value) {
                                $date1 = $value->get_date();
                                echo '<li> <div class="direction-r"><div class="flag-wrapper"> <div class="flag"><div class="column"> <div class="date"> <label class="day">'.$value->get_description().'</label> <label class="month">MAR</label></div></div><h4>'.$value->get_description().'</h4><br><h2>'.$value->get_time().'</h2></h4></div></div></div></li>';
                               echo '<li>';
                        echo '<div class="direction-r">';
                        echo '<div class="flag-wrapper">';
                        echo '<div class="flag">';
                        echo '<div class="column">';
                        echo '<div class="date">';
                        echo '<label class="day">10</label>';
                        echo '<label class="month">MAR</label>';
                        echo '</div>';
                        echo '</div>';
                        echo '<h4>Appointment1</h4>';
                        echo '';
                        echo '</div>';
                        echo '';
                        echo '</div>';
                        echo '</div>';
                        echo '</li>';
                              }
                        ?>


                    </ul>
                </div>
            </div>

            <div class="cards">

                <div class="card" id="pinfo">
                  <div class="card__image-holder">
                   
                  </div>
                  <div class="card-title">
                    <a href="#" class="toggle-info btn" style="margin-bottom: 5%;">
                      <span class="left"></span>
                      <span class="right"></span>
                    </a>
                    <h2 class="patient-name" style="color: black;">Aditya Gunjal</h2>
                    <h3 class="patient-sex">Sex: Male</h3>
                    <h3 class="patient-age">Age : 20</h3>
                    <h3 class="patient-last-visit">Phone : 9158992883</h3>
                  </div>
                  <div class="card-flap flap1">
                    <div class="card-description">
                        <h2  style="font-size: 20px; color: #003d4d;   ">Last visited : 20/12/2019
                        </h2>
                        <h3 class="patient-sex" style=" color:black ;">Diagnosis : Viral Infection</h3>
                        <h3 class="patient-age" style=" color:black ;">Prescribed : Wikoryl</h3>
                    </div>
                    <div class="card-flap flap2">
                      <div class="card-actions">
                        <a href="development.html" class="btn" style="margin-left: 50%;">View Profile</a>
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