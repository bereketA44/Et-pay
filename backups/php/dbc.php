<?php
    $servername = 'localhost';
    $user_name = 'bereket';
    $password = '';
    $dbname = 'test_etpay_test';
    $conn='';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $user_name, $password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // echo "Connected successfully";
    }catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>