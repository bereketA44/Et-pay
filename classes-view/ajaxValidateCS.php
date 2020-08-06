<?php
    include('../includes/02classAutoLoader_for_controllers.php');
    // if (isset ($_SESSION ["ETSESSID_etpay_token"])){ 
    //     echo "<h1 style='display: block;'>Session and/or Cookie not found</h1>";
    // }
    if (!isset ($_COOKIE ["ETSESSID_etpay_token"]) 
         || !isset($_COOKIE["loggin_accessed_etpay"])){
            echo "<h1 style='display: none;'>Session and/or Cookie not found</h1>";
            $checkSession = new SessionsHandler(0,0,0);
            if (isset ($_COOKIE ["delSessFromDBforAjaxCalls"])){    
                $thisSession= $_COOKIE ["delSessFromDBforAjaxCalls"];
                $checkSession->destroySession($thisSession);
            }
            setcookie("delSessFromDBforAjaxCalls", $_COOKIE["ETSESSID_etpay_token"], time() - (1800 * 1800),"/"); 
            unset ($_SESSION['ETSESSID_etpay_token']);
            unset ($_SESSION['timeControlatLogin']);
            session_unset();
            session_destroy();
            die();
    }else{
        setcookie("loggin_accessed_etpay", "true", time() + 1800, "/"); //1800 is 30 minutes
        setcookie("ETSESSID_etpay_token", $_COOKIE["ETSESSID_etpay_token"], time() + 1800,"/");
    }
    $id = '';
    if (isset ($_COOKIE ["idForDashBoard"])){
        $id = $_COOKIE ["idForDashBoard"];
    }
    if (isset ($_COOKIE ["emailForDashBoard"])){
        $getEmail = $_COOKIE ["emailForDashBoard"];
    }
?>