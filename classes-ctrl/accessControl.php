<?php
include('../includes/02classAutoLoader_for_controllers.php');

if (isset($_POST['email']) && isset($_POST['ATM']) && isset($_POST['Bank'])){
    $check = new check_user( "signup-fromAjax", trim($_POST['email']), trim($_POST['Bank']),trim($_POST['ATM']), 'NA', 'NA');
    $result = $check->getRowCount();
    echo $result;
}else if (isset($_POST['userName']) && isset($_POST['ATM']) && isset($_POST['Password'])){
    $username = $_POST['userName'];
    if ($_POST['ATM'][0]== '0')
        $ATM = $_POST['ATM'];
    else
        $ATM = number_format($_POST['ATM'], 0 ,'','');
    $password = $_POST['Password'];

    $new = new check_user ("logIn-fromAjax", 'NA', 'NA', $ATM, $username, $password);
    if($new->getLoginStatus()){
        echo 1; 
    }else {
        echo 0;
    }
}

