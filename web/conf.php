<?php 
    $db_user = 'AbT5ydOVVn';
    $db_pass = '1nN7Vx4PQ3';
    $dbname = 'AbT5ydOVVn';
    $db_host = 'host=remotemysql.com';

    try{
        $conn = new PDO("mysql:$db_host;dbname=$dbname", $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Connection Failed : " . $e->getMessage();
        exit();
    }
?>