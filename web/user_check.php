<?php 
    require_once('conf.php');
    $q = $_REQUEST["q"];
    $sql = "SELECT * FROM Users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$q]);
    $result = $stmt->fetch();
    if($result){
        echo "yes";
    } else {
        echo "no";
    }
?>