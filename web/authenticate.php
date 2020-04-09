<?php 
    require_once('conf.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_pass = hash("sha512", $password);
    $sql = "SELECT * FROM Users WHERE username=? AND hash=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $hashed_pass]);
    $result = $stmt->fetch();

    if($result) {
        header('Location: /patient_report.php');
    } else {
        header('Location: /login.php?error=invalid_login');
    }
?>