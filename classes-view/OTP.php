<?php
    include('../includes/02classAutoLoader_for_controllers.php');

    if (isset ($_POST['otpEmail']) && isset ($_POST['otpCode']) ){
        $otpToUSer = new emailer($_POST['otpEmail'], 'NULLETPAYVALUE', $_POST['otpCode']);
        $stat = $otpToUSer->getstat();
        if (!$stat){
            echo 0;
        } else if($stat){
            echo 1;
        }
    }