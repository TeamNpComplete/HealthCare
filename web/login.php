<?php 
    session_start();
    require_once('conf.php');

    $registered = 0;
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM Users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
        $result = $stmt->fetch();

        if($result){
            $registered = 2;
        } else {
            $id = sprintf("%06d", mt_rand(1, 999999));
            
            if($_POST['role'] == 'doctor'){
                $id = "D".$id;
            } else {
                $id = "P".$id;
            }

            $sql = "INSERT INTO Users(user_id, username, hash, role) VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            $hashed_pass = hash("sha512", $password);

            $result = $stmt->execute([$id, $username, $hashed_pass, $_POST['role']]);
            
            if($result){
                echo "Registered";
                $registered = 1;
                $_SESSION['user_id'] = $id;
                if($id[0] == 'D')
                    header("Location:/doctor_registration.php");
                else 
                    header("Location:/patient_profile.php");
            } else {
                $registered = 2;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Health Care - Login</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .alert {
            padding: 10px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
        
        .user_check{
            margin-top: 10px;
            font-size: 12px;
            color: #f44336;
        }
    </style>
</head>
<body>
    <header>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a class="active">Login</a>
            </li>
            <li>
                <a href="faq.xml">FAQ's</a>
            </li>
            <li>
                <a href="about_us.xml">About</a>
            </li>
            <li>
            	<a style="font-size: 20px; margin-left: 350px;">HealthCare</a>
            </li>
        </ul>
    </header>
    <section class="container">
        <section class="box-1">
            <img src="/images/healthcare_logo.svg" height="150px" width="150px"
                alt="Logo" style="margin-top: 100px;">
            <strong> <p style="margin-bottom: 100px; font-size:22px;">HealthCare</p> </strong>
        </section>
        <section class="box-2">
            <section class="tabs">
                <section class="login-tab active-tab" onclick="onLoginTabClicked()">
                    <strong>LOGIN</strong>
                </section>
                <section class="signup-tab" onclick="onSignupTabClicked()">
                    <strong>SIGNUP</strong>
                </section>
            </section>
            <form class="login-form-container" id="login-form" action="authenticate.php" method="POST">
                <?php 
                    if(isset($_GET['error'])){
                ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?php if($_GET['error'] == 'invalid_login') {?>
                        <strong>Invalid Login Credentials !</strong>
                    <?php } else { ?>
                        <strong>Internal Server Error !</strong>
                    <?php }?>
                </div>
                <?php } ?>
                <section class="input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" id="login-username" name="username" placeholder="Username or Email">
                    <hr>
                </section>

                <section class="input">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" id="login-password" name="password" placeholder="Password">
                    <hr id="line">
                    <section class="forgot-password">
                        <p><a href="forgot_password.html">Forgot Password ?</a></p>
                    </section>
                </section>
                <button id="login-btn" style="margin-bottom: 40px;">
                    LOGIN
                </button>
            </form>
            <form class="signup-form-container" id="signup-form" action="login.php?tab=signup" method="POST">
            	<?php 
            	switch ($registered){
            	    case 1:
            	        ?>
            	        	<div class="alert" style="background-color: #4CAF50">
                    			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                        		<strong>Registered Successfully !</strong>
                			</div>
            	        <?php
            	        break;
            	    case 2:
            	        ?>
            	        	<div class="alert">
                    			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                        		<strong>Failed to Register !</strong>
                			</div>
            	        <?php
            	        break;
            	}
            	?>
                <section class="input">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" id="username" name="username" placeholder="Username or Email"
			onfocusout="validateEmail()">
                    <hr>
                    <section class="user_check">
                		Username alredy exists !
                	</section>
                </section>
                <section class="input">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" id="passwd"  name="password" placeholder="Password">
                    <hr>
                </section>
                <section class="input">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <input type="password" id="confirm-passwd" placeholder="Confirm Password">
                    <hr>
                </section>
                <section class="input" style="display:inline-block;">
                    <input type="radio" name="role" value="patient" checked="true"> Patient
                    <input type="radio" name="role" style="margin-left: 100px;" value="doctor"> Doctor
                </section>
                <button class="signup-btn" type="button" style="margin-bottom: 20px;">SIGN UP</button>
            </form>
        </section>
    </section>
    <footer>
        <br/>
        <p>Copyright ©2020 Healthcare portal. All right reserved.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="scripts/login.js"></script>
    <?php 
    if(isset($_GET['tab'])){
      echo '<script type="text/javascript"> onSignupTabClicked(); </script>';  
    }
    ?>
</body>
</html>