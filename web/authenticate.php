<?php 
    session_start();
    require_once('conf.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username && $password){
        $hashed_pass = hash("sha512", $password);
        $sql = "SELECT * FROM Users WHERE username=? AND hash=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $hashed_pass]);
        $result = $stmt->fetch();
        
        if($result) {
            $user_id = $result['user_id'];
            $_SESSION['user_id'] = $user_id;
            if($user_id[0] == 'P')
                header('Location: /patient_dashboard.php');
            else
                header('Location: /doctor_dashboard.php');
            die();
        }
    }

    session_unset();
    session_destroy();

    if(isset($_POST['logout']))
        header('Location: /login.php');

    header('Location: /login.php?error=invalid_login');

    
?>