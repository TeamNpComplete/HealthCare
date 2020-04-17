<?php 
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:/login.php');
        exit();
    }

    $patient_id = $_SESSION['user_id'];
    require_once('conf.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json, charset=UTF-8');

        $request_payload = file_get_contents('php://input');
        $array_payload = json_decode($request_payload, true);

        if(isset($array_payload['appointment_id'])){
            $sql = "UPDATE Appointments SET status='scheduled', date_of_appointment=(SELECT STR_TO_DATE(?, '%d/%m/%Y %h:%i %p')), description=? WHERE appointment_id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$array_payload['date_of_appointment'], $array_payload['discription'], $array_payload['appointment_id']]);
            if($result) {
                echo "success";
            } else {
                echo "failed";
            }
            exit();
        }
        
        if(isset($array_payload['doctor_id']) && isset($array_payload['date']) && isset($array_payload['description'])){
            $appointment_id = sprintf("%010d", mt_rand(1, 9999999999));
            $sql = "INSERT INTO Appointments VALUES(?, ?, ?, STR_TO_DATE(?, '%d/%m/%Y %h:%i %p'), ?, 'unscheduled')";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$appointment_id, $patient_id, $array_payload['doctor_id'], $array_payload['date'], $array_payload['description']]);
            if($result) {
                echo json_decode($request_payload);
            } else {
                exit();
            }
        }

        echo json_encode($request_payload);
    } else if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET['appointment_id'])){

            $appointment_id = $_GET['appointment_id'];
            $sql = "UPDATE Appointments SET status='rejected' WHERE appointment_id=?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$appointment_id]);

            if($result)
                echo "success";
            else 
                echo "failed";
        }
    } else {
        var_dump(http_response_code([400]));
        exit();
    }
    
?>