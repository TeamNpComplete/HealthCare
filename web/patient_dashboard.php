<?php
    session_start();
    
    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
    }

    require_once('conf.php');
    
    $patient_id = $_SESSION['user_id'];

    $sql = "SELECT  firstname,lastname FROM PatientsProfile WHERE patient_id=?";
    $stmt = $conn->prepare($sql);
 
    $stmt->execute([$patient_id]);
    
    while($row =  $stmt->fetch()) {   
        $name = $row["firstname"] ." ". $row{"lastname"};
    }   
  
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/5903f016d8.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="stylesheets/main2.css">
    <link rel="stylesheet" href="stylesheets/profile.css">
    
    <link href="https://materialdesignicons.com/cdn/2.0.46/" rel="text/css">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <script src="scripts/jquery.js"></script>
        <script type="text/javascript" src="scripts/dashboard.js"></script>
        <script type="text/javascript" src="scripts/filer_doctor.js"></script>
    
    <title>Document</title>
    <style>
		iframe {
			width: 80%;
            height: 650px;
            margin-left: 20%;
        }
	</style>
</head>

<body>
    <div class="dashboard-content">
    <section class="sideMenu">
        <nav>
            <div class="logo">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" src="images/logo.png" >
                </div>
                <div class="user-info">
                    <span class="user-name">
                        <strong>Health Plus </strong>
                    </span>

                </div>
            </div>

           
            
            <a href="home.php" id='dashboard_tab' onclick="changeTab('dashboard')" target="myFrame"><i class="fas fa-home"></i>Dashboard</a>
            <a href="medical_history.php?scroll=true" id='history_tab' onclick="changeTab('history')" target="myFrame"><i class="fas fa-history"></i>History</a>
            <a href="about_us.xml" ><i class="fas fa-info-circle"></i></i>About Us</a>

        </nav>

    </section>

    <header>
        <div class="top-bar">
            <form class="search-container" id="search-frm" autocomplete="off" action="get_doctor.php" method="get">
                <div class="autocomplete" id="search_doctors">
                <input type="text" id="myInput" name="search_val" placeholder="Search">
                <div style="margin-left: -100px; " class="select_box"> </div> 
            </div>
        
<a href="#"><img class="search-icon"
                        src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png"></a>
                        
                            
            </form>

            
            
            <div class="profile-container" > 
                <div class="half" >
                  <label for="profile2" class="profile-dropdown " >
                    <input type="checkbox" id="profile2">
                    <!-- <img src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png"> -->
                    <img   src="images/profile_image.png" alt="" class="image--cover" style="color: white;
                    " />
                    <span style="font-size: medium; margin-right: -5px; "><?php echo $name?></span>
                    <label for="profile2"><i class="fas fa-bars" style="scale: 0.7;"></i></i></label>
                    <ul>
                      
                      <li><a href="patient_profile.php" target="myFrame"><i class="far fa-user-circle"></i></i>Profile</a></li>
                      
                      <li><a href="authenticate.php?logout=true"><i class="fas fa-sign-out-alt"></i></i>Logout</a></li>
                    </ul>
                  </label>
                </div>
              </div>
              
           
        </div>
        
        <!-- <?php
            $search_val = $_GET['filter'];  
            
           ?> -->
      
    </header>

    <iframe name="myFrame" src="home.php" id="frm" onload="iframeLoaded();"></iframe>
</div>

        <script>
            var currentTab = 'dashboard';
            document.getElementById('dashboard_tab').classList.add('active');

            var iFrameID = document.getElementById('frm');

            function iframeLoaded() {
                iFrameID = document.getElementById('frm');
                if (iFrameID) {
                    iFrameID.height = "";
                    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
                }
            }

            function changeTab(newTab) {
                if(newTab !== currentTab){
                    document.getElementById(newTab + '_tab').classList.add('active');
                    document.getElementById(currentTab + '_tab').classList.remove('active');
                    currentTab = newTab;
                }
            }

            iframeLoaded();
        </script>
        <script type="text/javascript" src="scripts/search.js"></script>
</body>

</html>