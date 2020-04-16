<?php 
    session_start();

    $user_id = $_SESSION['user_id'];
    require_once('conf.php');


    if($user_id[0] == 'D'){
        if(isset($_GET['search_val'])){
            $d1 = explode (" ", $_GET['search_val']);
    
            $sql = "SELECT patient_id FROM PatientsProfile WHERE firstname=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$d1[0]]);
            $result = $stmt->fetch();
            if($result) {
                header('Location:patient_report.php?patient_id='.$result['patient_id']);
            } else {
                header('Location:doctor_dashboard.php');
            }
        } else {
            header('Location:doctor_dashboard.php');
        }
    } else {
        if(isset($_GET['search_val'])){
            $d1 = explode (" ", $_GET['search_val']);
    
            $sql = "SELECT doctor_id FROM DoctorsProfile WHERE firstname=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$d1[0]]);
            $result = $stmt->fetch();
            if($result) {
                header('Location:doctor_profile.php?doctor_id='.$result['doctor_id']);
            } else {
                header('Location:patient_dashboard.php');
            }
        } else {
            header('Location:patient_dashboard.php');
        }
    }
?>